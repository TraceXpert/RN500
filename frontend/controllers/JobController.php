<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LeadMaster;
use common\CommonFunction;
use common\models\CompanyBranch;
use common\models\Benefits;
use common\models\Speciality;
use common\models\Discipline;
use yii\helpers\ArrayHelper;
use common\models\LeadDiscipline;
use common\models\LeadBenefit;
use common\models\LeadSpeciality;
use common\models\Cities;
use common\models\Emergency;
use common\models\LeadEmergency;
use common\models\LeadMasterSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class JobController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['post', 'list'],
                'rules' => [
                        [
                        'actions' => ['post', 'list'],
                        'allow' => true,
                        'roles' => (CommonFunction::isEmployer() || CommonFunction::isRecruiter()) ? ['@'] : ['*'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function actionList() {
        $searchModel = new LeadMasterSearch();
        $searchModel->loggedInUserId = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->searchMyPostedJob(Yii::$app->request->queryParams);
        return $this->render('list', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionPost($ref = '') {
        $isEditForm = ($ref != '') ? true : false;
        $cities = [];
        if ($isEditForm) {
            $model = LeadMaster::find()->alias('lead')->where(['reference_no' => $ref]);
            if (CommonFunction::isHoAdmin(Yii::$app->user->id)) {
                $model->andWhere(['IN', 'branch_id', CommonFunction::getAllBranchIdsOfComapny(CommonFunction::getLoggedInUserCompanyId())]);
            } else {
                $model->andWhere(['lead.branch_id' => CommonFunction::getLoggedInUserBranchId()]);
            }
            $model = $model->one();
            if ($model != null) {

                $model->benefits = ArrayHelper::getColumn(LeadBenefit::findAll(['lead_id' => $model->id]), 'benefit_id');
                $model->specialities = ArrayHelper::getColumn(LeadSpeciality::findAll(['lead_id' => $model->id]), 'speciality_id');
                $model->disciplines = ArrayHelper::getColumn(LeadDiscipline::findAll(['lead_id' => $model->id]), 'discipline_id');
                $model->emergency = ArrayHelper::getColumn(LeadEmergency::findAll(['lead_id' => $model->id]), 'emergency_id');
                $model->state = (isset($model->cities->state_id)) ? $model->cities->state_id : '';
                if ($model->state != '') {
                    $cities = Cities::getAllCities($model->state);
                }
            } else {
                throw new NotFoundHttpException("Something went wrong");
            }
        } else {
            $model = new LeadMaster();
            $model->reference_no = $model->getUniqueReferenceNumber();
        }


        $model->scenario = 'post-job';
        $disciplineList = ArrayHelper::map(Discipline::getAllDiscipline(), 'id', 'name');
        $benefitList = ArrayHelper::map(Benefits::getAllBenefits(), 'id', 'name');
        $specialityList = ArrayHelper::map(Speciality::getAllSpecialities(), 'id', 'name');
        $emergencyList = ArrayHelper::map(Emergency::getAllEmergency(), 'id', 'name');
        $branchList = ArrayHelper::map(CompanyBranch::getAllBranchesOfLoggedInUser(), 'id', 'branch_name');
        $states = ArrayHelper::map(\common\models\States::find()->where(['country_id' => 226])->all(), 'id', 'state');

        if ($model->load(Yii::$app->request->post())) {
            if (!CommonFunction::isLoggedInUserDefaultBranch()) {
                $model->branch_id = CommonFunction::getLoggedInUserBranchId();
            }
            $transaction = Yii::$app->db->beginTransaction();


            $model->start_date = CommonFunction::getStorableDate($model->start_date);
            $model->end_date = CommonFunction::getStorableDate($model->end_date);
            if (!$isEditForm) {
                $model->created_at = $model->updated_at = CommonFunction::currentTimestamp();
                $model->created_by = $model->updated_by = Yii::$app->user->identity->id;
            } else {
                $model->updated_at = CommonFunction::currentTimestamp();
                $model->updated_by = Yii::$app->user->identity->id;
            }
            if ($model->validate() && $model->save()) {
                try {
                    $lead_id = $model->id;
                    if (CommonFunction::isRecruiter() && !$isEditForm) {
                        $subscription = new \common\models\CompanySubscription();
                        $subscription->company_id = CommonFunction::getLoggedInUserCompanyId();
                        $subscription->package_id = \common\models\PackageMaster::PAY_AS_A_GO;
                        $subscription->status = 1;
                        $subscription->created_at = $subscription->updated_at = CommonFunction::currentTimestamp();
                        if ($subscription->save()) {
                            $paymentModel = new \common\models\CompanySubscriptionPayment();
                            $paymentModel->subscription_id = $subscription->id;
                            $paymentModel->amount = 0;
                            $paymentModel->lead_id = $lead_id;
                            $paymentModel->status = 1;
                            $paymentModel->is_free = 1;
                            $paymentModel->created_at = $paymentModel->updated_at = CommonFunction::currentTimestamp();
                            $paymentModel->save();
                        }
                    }
                    if (isset($model->disciplines) && !empty($model->disciplines)) {
                        LeadDiscipline::deleteAll(['lead_id' => $lead_id]);
                        foreach ($model->disciplines as $key => $discipline_id) {
                            $leadDiscipline = new LeadDiscipline();
                            $leadDiscipline->lead_id = $lead_id;
                            $leadDiscipline->discipline_id = $discipline_id;
                            $leadDiscipline->save();
                        }
                    }

                    if (isset($model->benefits) && !empty($model->benefits)) {
                        LeadBenefit::deleteAll(['lead_id' => $lead_id]);
                        foreach ($model->benefits as $key => $benefit_id) {
                            $leadBenefit = new LeadBenefit();
                            $leadBenefit->lead_id = $lead_id;
                            $leadBenefit->benefit_id = $benefit_id;
                            $leadBenefit->save();
                        }
                    }

                    if (isset($model->specialities) && !empty($model->specialities)) {
                        LeadSpeciality::deleteAll(['lead_id' => $lead_id]);
                        foreach ($model->specialities as $key => $specialt_id) {
                            $leadSpeciality = new LeadSpeciality();
                            $leadSpeciality->lead_id = $lead_id;
                            $leadSpeciality->speciality_id = $specialt_id;
                            $leadSpeciality->save();
                        }
                    }

                    if (isset($model->emergency) && !empty($model->emergency)) {
                        LeadEmergency::deleteAll(['lead_id' => $lead_id]);
                        foreach ($model->emergency as $key => $emergency_id) {
                            $leadEmergency = new LeadEmergency();
                            $leadEmergency->lead_id = $lead_id;
                            $leadEmergency->emergency_id = $emergency_id;
                            $leadEmergency->save();
                        }
                    }

                    $transaction->commit();
                    if ($isEditForm) {
                        Yii::$app->session->setFlash("success", "Job detail updated successfully.");
                    } else {
                        $mailSent = $model->sendMailForPostedJobAck();
                        if ($mailSent) {

                            Yii::$app->session->setFlash("success", "Job posted successfully.");
                        } else {
                            Yii::$app->session->setFlash("warning", "Job posted successfully, but there is a issue with mail server.");
                        }
                    }
                } catch (\Exception $ex) {

                    Yii::$app->session->setFlash("warning", "Something went wrong.");
                    $transaction->rollBack();
                } finally {
                    return $this->redirect(['list']);
                }
            }
        }
        $model->start_date = CommonFunction::getAPIDateDisplayFormat($model->start_date, Yii::$app->params['date.format.display.php']);
        $model->end_date = CommonFunction::getAPIDateDisplayFormat($model->end_date, Yii::$app->params['date.format.display.php']);
        return $this->render('post', [
                    'model' => $model,
                    'disciplinesList' => $disciplineList,
                    'benefitList' => $benefitList, 'emergencyList' => $emergencyList,
                    'specialityList' => $specialityList, 'cities' => $cities,
                    'branchList' => $branchList, 'states' => $states,
        ]);
    }

    public function actionGetCities($id) {
        $cities = ArrayHelper::map(Cities::find()->where(['state_id' => $id])->all(), 'id', 'city');
        $options = '';
        if (!empty($cities)) {
            foreach ($cities as $key => $city) {
                $options .= "<option value=$key>$city</option>";
            }
        }
        echo $options;
        exit;
    }

}
