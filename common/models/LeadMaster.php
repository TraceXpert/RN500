<?php

namespace common\models;

use Yii;
use common\CommonFunction;

/**
 * This is the model class for table "lead_master".
 *
 * @property int $id
 * @property string $title
 * @property string $reference_no
 * @property string|null $description
 * @property int $jobseeker_payment salary
 * @property int $payment_type 1:hourly,2:weekly,3:monthly
 * @property int $job_type 1:part_time,2:permanante,3:travel,4:on call
 * @property int $shift 1:all 2:morning 3:evening 4:night 5:flatulate
 * @property int $start_date
 * @property int|null $end_date
 * @property int $recruiter_commission agancy commision
 * @property int $recruiter_commission_type 1:percentage 0: amount
 * @property int $recruiter_commission_mode 0:one time 1:monthly 2 Yearly
 * @property int|null $price admin or master admin decide lead price
 * @property int|null $status 0:pending 1:approve 2:reject
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $branch_id
 * @property string|null $comment
 * @property int $is_suspended
 */
class LeadMaster extends \yii\db\ActiveRecord {

    public $disciplines;
    public $benefits;
    public $specialities;
    public $emergency;
    public $state;

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const IS_SUSPENDED_NO = 0;
    const IS_SUSPENDED_YES = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'lead_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['branch_id'], 'required', 'message' => 'Location cannot be blank.', 'on' => 'post-job'],
                [['street_no', 'state', 'street_address', 'city', 'recruiter_commission', 'recruiter_commission_type', 'recruiter_commission_mode', 'title', 'reference_no', 'jobseeker_payment', 'payment_type', 'job_type', 'shift', 'start_date', 'created_at', 'updated_at', 'created_by', 'updated_by', 'description', 'branch_id'], 'required'],
                [['description', 'apt', 'zip_code'], 'string'],
                [['payment_type', 'job_type', 'shift', 'recruiter_commission_type', 'recruiter_commission_mode', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer', 'message' => '{attribute} must be a numeric only'],
                [['recruiter_commission', 'price'], 'number', 'message' => 'Please enter valid {attribute}.'],
                [['jobseeker_payment',], 'number'],
                [['title'], 'string', 'max' => 250],
                [['reference_no'], 'string', 'max' => 50],
                [['comment'], 'string', 'max' => 500],
                [['reference_no'], 'unique'],
                [['zip_code'], 'match', 'pattern' => '/^([0-9]){5}?$/', 'message' => 'Please enter a valid 5 digit numeric {attribute}.'],
//            [['street_no'], 'match', 'pattern' => '/^([0-9])?$/', 'message' => 'Please enter a digit numeric for {attribute}.'],
            [['comment', 'visible_to'], 'safe', 'on' => 'approve'],
                [['price'], 'required', 'on' => 'approve'],
                [['end_date', 'start_date'], 'checkEndDate', 'on' => 'post-job'],
                [['is_suspended'], 'checkSuspendDependency', 'on' => 'post-job'],
                [['approved_at', 'branch_id', 'state', 'comment', 'disciplines', 'benefits', 'specialities', 'end_date', 'start_date', 'emergency', 'is_suspended'], 'safe'],
                [['title',  'apt', 'zip_code', 'comment'], 'match', 'not' => true, 'pattern' => Yii::$app->params['NO_HTMLTAG_PATTERN'], 'message' => Yii::t('app', Yii::$app->params['HTMLTAG_ERR_MSG'])],
        ];
    }

    public function checkEndDate($attr) {
        $startDate = CommonFunction::getAPIDateDisplayFormat($this->start_date, 'Y-m-d');
        $end_date = CommonFunction::getAPIDateDisplayFormat($this->end_date, 'Y-m-d');

        if ($startDate != '' && $end_date != '' && strtotime($startDate) > strtotime($end_date)) {
            return $this->addError('end_date', $this->getAttributeLabel('end_date') . ' can not be bigger than ' . $this->getAttributeLabel('start_date'));
        }
    }

    public function checkSuspendDependency($attr) {
        if (!$this->isNewRecord && $this->is_suspended != '' && ($this->is_suspended == '1' || $this->is_suspended == true)) {
            $isAppliedLeadExist = LeadRecruiterJobSeekerMapping::find()->where(['lead_id' => $this->id])
                    ->andWhere(
                            [
                                'OR',
                                    ['rec_status' => LeadRecruiterJobSeekerMapping::STATUS_PENDING, 'employer_status' => LeadRecruiterJobSeekerMapping::STATUS_PENDING],
                                    ['rec_status' => LeadRecruiterJobSeekerMapping::STATUS_APPROVED, 'employer_status' => LeadRecruiterJobSeekerMapping::STATUS_PENDING]
                    ])
                    ->one();
            if ($isAppliedLeadExist != null) {
                $errorMsg = "You cannot suspend this post as the Jobseker has already applied and his/her job was in in-progress state.";
                Yii::$app->session->setFlash("warning", "$errorMsg");
                return $this->addError('is_suspended', "$errorMsg");
                
            }
        }
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['approve'] = ['comment', 'price', 'visible_to'];
        return $scenarios;
    }

    /**
     * {@inhxeritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Job Title',
            'reference_no' => 'Reference No',
            'description' => 'Description',
            'jobseeker_payment' => 'Salary',
            'payment_type' => 'Payment Type',
            'job_type' => 'Job Type',
            'shift' => 'Shift',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'recruiter_commission' => 'Recruiter Commission',
            'recruiter_commission_type' => 'Recruiter Commision Type',
            'recruiter_commission_mode' => 'Recruiter Commision Mode',
            'visible_to' => 'Visible To',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'branch_id' => 'Branch',
            'comment' => 'Comment',
            'street_no' => 'Street No.',
            'apt' => 'Suit/Apt.',
            'specialities' => 'Speciality',
            'zip_code' => 'Zipcode',
            'emergency' => 'Urgent',
            'is_suspended' => 'Is Suspended'
        ];
    }

    public function getUniqueReferenceNumber() {
        $code = CommonFunction::generateRandomString(15);
        $exits = self::find()->where(['reference_no' => $code])->one();
        if ($exits) {
            $this->getUniqueReferenceNumber();
        } else {
            return $code;
        }
    }

    public function getBenefits() {
        return $this->hasMany(LeadBenefit::className(), ['lead_id' => 'id']);
    }

    public function getDisciplines() {
        return $this->hasMany(LeadDiscipline::className(), ['lead_id' => 'id']);
    }

    public function getSpecialty() {
        return $this->hasMany(LeadSpeciality::className(), ['lead_id' => 'id']);
    }

    public function getEmergency() {
        return $this->hasMany(LeadEmergency::className(), ['lead_id' => 'id']);
    }

    public function getBranch() {
        return $this->hasOne(CompanyBranch::className(), ['id' => 'branch_id']);
    }

    public function getCities() {
        return $this->hasOne(Cities::className(), ['id' => 'city']);
    }

    public function getCitiesName() {
        $names = "";
        if (isset($this->cities) && !empty($this->cities)) {
            $names = $this->cities->city . "-" . $this->cities->stateRef->state;
        }
        return $names;
    }

    public function getBenefitsNames() {
        $names = "";
        if (isset($this->benefits) && !empty($this->benefits)) {
            $benefits = [];
            foreach ($this->benefits as $value) {
                $benefits[] = $value->benefits->name;
            }
            $names = implode(',', $benefits);
        }
        return $names;
    }

    public function getDisciplineNames() {
        $names = "";
        if (isset($this->disciplines) && !empty($this->disciplines)) {
            $benefits = [];
            foreach ($this->disciplines as $value) {
                $benefits[] = $value->disciplines->name;
            }
            $names = implode(',', $benefits);
        }
        return $names;
    }

    public function getSpecialtyNames() {
        $names = "";
        if (isset($this->specialty) && !empty($this->specialty)) {
            $benefits = [];
            foreach ($this->specialty as $value) {
                $benefits[] = $value->speciality->name;
            }
            $names = implode(',', $benefits);
        }
        return $names;
    }

    public function getAvgRating() {
        $avgRating = $this->hasMany(LeadRating::className(), ['lead_id' => 'id'])
                ->select(['ROUND(AVG(`rating`),1) AS average_rate'])
                ->groupBy(['lead_id'])
                ->scalar();
        return ($avgRating != '') ? $avgRating : '0';
    }

    public function getSharableUrl() {
        return Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/view', 'id' => $this->reference_no]);
    }

    // CITY , STATE FOR EMAIL PURPOSE
    public function getLocation() {
        $cityStateName = '';
        if ($this->cities) {
            $cityName = isset($this->cities->city) ? $this->cities->city : '';
            if ($this->cities && $this->cities->stateRef) {
                $stateName = isset($this->cities->stateRef) ? ', ' . $this->cities->stateRef->state : '';
            }
            $cityStateName = $cityName . $stateName;
        }
        return $cityStateName;
    }

    public function getLeadTitleWithRef() {
        $title = $this->title . " (" . $this->reference_no . ") ";
        return $title;
    }

    /* SENDS MAIL TO JOB POSTING BRANCH ABOUT ACKNOWLEDGEMENT OF JOB */

    public function sendMailForPostedJobAck() {
        $flag = false;
        try {
            $htmlLayout = '@common/mail/job-posting-acknowledgement';
            $subject = 'Acknowledgement of posted job ' . $this->title . '(' . $this->reference_no . ')';
            $postingBranch = $this->branch;
            $postingCompany = isset($postingBranch->company) ? $postingBranch->company : [];
            if (!empty($postingBranch) && !empty($postingCompany)) {
                $flag = Yii::$app->mailer->compose(['html' => $htmlLayout,], ['lead' => $this, 'postingBranch' => $postingBranch, 'postingCompany' => $postingCompany])
                        ->setFrom([Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                        ->setTo($postingBranch->email)
                        ->setSubject($subject)
                        ->send();
            }
        } catch (\Exception $ex) {
            $flag = false;
        } finally {
            return $flag;
        }
    }

}
