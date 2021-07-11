<?php

namespace common;

use Yii;
use common\models\User;
use common\models\CompanyBranch;
use common\models\CompanyMaster;
use common\models\CompanySubscription;
use common\models\CompanySubscriptionPayment;
use yii\helpers\Html;
use common\models\LeadMaster;
use yii\helpers\ArrayHelper;
use common\models\ApiLog;
use common\models\UserDetails;
use common\models\WorkExperience;
use common\models\Education;
use common\models\Licenses;
use common\models\Certifications;
use common\models\Documents;
use common\models\References;

class CommonFunction {

    // GENERATE RANDOM DIGITS, ACCORDING TO LENGTH PASSED OTHERWISE 6 DIGITS
    public static function generateOTP($digits = 6) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $digits; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function currentTimestamp() {
        return time();
    }

    public static function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomNo = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNo .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomNo;
    }

    public static function logger($apiUrl, $request, $response) {
        $logMessage = new ApiLog();
        $logMessage->url = $apiUrl;
        $logMessage->request = $request;
        $logMessage->response = $response;
        $logMessage->created_at = CommonFunction::currentTimestamp();
        $logMessage->save();
    }

    // RETURN LOGGED_IN USER NAME ELSE EMPTY
    public static function getLoggedInUserFullname() {
        $name = "";
        if (isset(Yii::$app->user->identity->type)) {
            $name = Yii::$app->user->identity->getFullName();
        }
        return $name;
    }

    // RETURN LOGGED-IN USER BRANCH ID
    public static function getLoggedInUserBranchId() {
        $branchId = "";
        if (isset(Yii::$app->user->identity->branch)) {
            $branchId = Yii::$app->user->identity->branch->id;
        }
        return $branchId;
    }

    // RETURN LOGGED-IN USER COMPANY ID
    public static function getLoggedInUserCompanyId() {
        $companyId = "";
        if (isset(Yii::$app->user->identity->branch)) {
            $companyId = Yii::$app->user->identity->branch->company_id;
        }
        return $companyId;
    }

    // RETURN LOGGED-IN USER COMPANY ID
    public static function getLoggedInUserCompanyPriority() {
        $priority = "";
        if (isset(Yii::$app->user->identity->branch)) {
            $priority = Yii::$app->user->identity->branch->company->priority;
        }
        return $priority;
    }

    // RETURN TRUE IF LOGGED-IN USER BELONGS TO DEFAULT BRANCH, GENERALLY "HO"
    public static function isLoggedInUserDefaultBranch() { 
        $isDefaultBranchUser = false;
        if (isset(Yii::$app->user->identity->branch) && Yii::$app->user->identity->branch->is_default == CompanyBranch::IS_DEFAULT_YES) {
            $isDefaultBranchUser = true;
        }
        return $isDefaultBranchUser;
    }

    // RETURN TRUE IF LOGGED_IN USER IS RECRUITER ELSE FALSE
    public static function isRecruiter() {
        return (isset(Yii::$app->user->identity->type) && Yii::$app->user->identity->type == User::TYPE_RECRUITER) ? true : false;
    }

    // RETURN TRUE IF LOGGED_IN USER IS EMPLOYER ELSE FALSE
    public static function isEmployer() {
        return (isset(Yii::$app->user->identity->type) && Yii::$app->user->identity->type == User::TYPE_EMPLOYER) ? true : false;
    }

    // RETURN TRUE IF LOGGED_IN USER IS Jobseeker ELSE FALSE
    public static function isJobSeeker() {
        return (isset(Yii::$app->user->identity->type) && Yii::$app->user->identity->type == User::TYPE_JOB_SEEKER) ? true : false;
    }

    // RETURN TRUE IF LOGGED_IN USER assign permission ELSE FALSE
    public static function checkAccess($permission, $user_id) {
        $flag = false;
        $auth = Yii::$app->authManager;
        $user = User::findOne(['id' => $user_id]);
        $isAdmin = $user->is_master_admin;
        $permissions = [];
        if (!$isAdmin) {
            if (!empty($user->role_id)) {
                $permissions = array_keys($auth->getAssignments($user->role_id));
            }
            $flag = in_array($permission, $permissions);
        } else {
            $flag = true;
        }
        return $flag;
    }

    // RETURN TRUE IF LOGGED_IN USER IS Super Admin ELSE FALSE
    public static function isMasterAdmin($user_id) {
        $user = User::findOne(['id' => $user_id]);
        $isAdmin = $user->is_master_admin;
        return $isAdmin;
    }

    // RETURN TRUE IF LOGGED_IN USER IS HO Admin ELSE FALSE
    public static function isHoAdmin($user_id) { // HO OWNER
        $user = User::findOne(['id' => $user_id]);
        $isHoAdmin = $user->branch->is_default == 1 && $user->is_owner == 1 ? true : false;
        return $isHoAdmin;
    }

    // send Welcome mail
    public static function sendWelcomeMail($user) {
        $htmlLayout = '@common/mail/welcomeMail-html';
        $subject = 'Welcome To RN500';
        $name = isset($user->fullName) ? $user->fullName : "";
        return \Yii::$app->mailer->compose(['html' => $htmlLayout], ['user' => $user, 'name' => $name])
                        ->setFrom([Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                        ->setTo($user->email)
                        ->setSubject($subject)
                        ->send();
    }

    public static function dateDiffInDays($date1) {
        $date2 = strtotime('now');
        // Calculating the difference in timestamps
        $diff = $date2 - $date1;

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }

    public static function isExpired() {
        $flag = true;
        $company_id = CommonFunction::getLoggedInUserCompanyId();
        if (isset(Yii::$app->user->identity) && !empty($company_id)) {
            $subscription = CompanySubscription::find()->where(['>=', 'start_date', date('Y-m-d', strtotime('now'))])->andWhere(['>=', 'start_date', date('Y-m-d', strtotime('now'))])->one();
            if (!empty($subscription)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function getAllPurchasedLead() {
        $leads = [];
        $company_id = CommonFunction::getLoggedInUserCompanyId();
        if (isset(Yii::$app->user->identity) && !empty($company_id)) {
            $subscription_lead = CompanySubscriptionPayment::find()->select('company_subscription_payment.lead_id')->innerJoin('company_subscription', 'company_subscription.id=company_subscription_payment.subscription_id')->where(['company_subscription.company_id' => $company_id])->andWhere('company_subscription_payment.lead_id IS NOT NULL')->asArray()->all();
            $leads = array_column($subscription_lead, 'lead_id');
        }
        return $leads;
    }

    public static function isVisibleLead($approved_at) {
        $flag = false;
        $priority = CommonFunction::getLoggedInUserCompanyPriority();
        $approved_date = date('Y-m-d H:i:s', $approved_at);
        if (!empty($priority)) {
            if ($priority == CompanyMaster::PRIORITY_HIGH) {
                $flag = true;
            } else if ($priority == CompanyMaster::PRIORITY_MODRATE) {
                $new_time = date("Y-m-d H:i:s", strtotime($approved_date . '+24 hours'));
                $time = date("Y-m-d H:i:s", strtotime('now'));
                if ($new_time <= $time) {
                    $flag = true;
                }
            } else if ($priority == CompanyMaster::PRIORITY_SEMIMODRATE) {
                $new_time = date("Y-m-d H:i:s", strtotime($approved_date . '+36 hours'));
                $time = date("Y-m-d H:i:s", strtotime('now'));
                if ($new_time <= $time) {
                    $flag = true;
                }
            } else {
                $new_time = date("Y-m-d H:i:s", strtotime($approved_date . '+42 hours'));
                $time = date("Y-m-d H:i:s", strtotime('now'));
                if ($new_time <= $time) {
                    $flag = true;
                }
            }
        }
        return $flag;
    }

    public static function htmlEncodeLabel($str) {
        $var = Html::encode($str);
        return str_replace("&amp;", "&", $var);
    }

    // RETURN BASE PATH OF PROFILE PICTURE FOLDER
    public static function getProfilePictureBasePath() {
        return Yii::getAlias('@frontend') . "/web/uploads/user-details/profile";
    }

    // RETURN BASE PATH OF DOCUMENTS FOLDER
    public static function getDocumentBasePath() {
        return Yii::getAlias('@frontend') . "/web/uploads/user-details/document";
    }

    // RETURN BASE PATH OF LICENSES FOLDER
    public static function getLicensesBasePath() {
        return Yii::getAlias('@frontend') . "/web/uploads/user-details/license";
    }

    // RETURN BASE PATH OF LICENSES FOLDER
    public static function getCertificateBasePath() {
        return Yii::getAlias('@frontend') . "/web/uploads/user-details/certification";
    }

    public static function getAdvertisementBasePath() {
        return Yii::getAlias('@frontend') . "/web/uploads/advertisement";
    }

    public static function getAdvertisementBaseUrl() {
//        return Yii::getAlias('@frontend') . "/web/uploads/advertisement";
        return \yii\helpers\Url::to(Yii::$app->urlManagerFrontend->createUrl(["/uploads/advertisement"]), true);
    }

    /*
     * lead_master TABLE's branch_id WILL BE CONSIDERED AS EMPLOYER BRANCH OR LEAD POSTED BRANCH
     * 
     */

    public static function isLeadAppliedBranchAndPostedBranchSame($leadId, $appliedBranchId) {
        $flag = false;
        try {
            $leadMaster = LeadMaster::findOne($leadId);
            if ($leadMaster !== null) {
                $flag = (string) $leadMaster->branch_id == (string) $appliedBranchId;
            }
        } catch (\Exception $ex) {
            $flag = false;
        } finally {
            return $flag;
        }
    }

    public static function getAPIDateDisplayFormat($date, $format = 'm-d-Y') {
        if ($date != '' && $date != '0000-00-00' && date('Y-m-d', strtotime($date)) != '1970-01-01') {
            return date($format, strtotime($date));
        }
        return '';
    }

//    $actualDate = explode('-', $postDateMMDDYY);
//            $convertedDate = "$actualDate[2]-$actualDate[0]-$actualDate[1]";
//
//            if ($postDateMMDDYY != '' && $postDateMMDDYY != '0000-00-00' && date('Y-m-d', strtotime($date)) != '1970-01-01') {
//                return date($format, strtotime($date));
//            }
    public static function getStorableDate($postDateMMDDYY) {
        $storable_date = null;
        try {

            $actualDate = explode('-', $postDateMMDDYY);
            $convertedDate = "$actualDate[2]-$actualDate[0]-$actualDate[1]";

            if ($postDateMMDDYY != '' && $postDateMMDDYY != '0000-00-00' && date('Y-m-d', strtotime($convertedDate)) != '1970-01-01') {
                $storable_date =$convertedDate;
            }
        } catch (\Exception $e) {
            $storable_date = null;
        } finally {
            return $storable_date;
        }
    }

    public static function getProfilePercentage() {

        $totalPercentage = 100;

        $totalPer = 0;
//        $hasCompletedUserDetails = 0;
//        $hasCompletedWE = 0;
//        $hasCompletedEducation = 0;
//        $hasCompletedLicense = 0;
//        $hasCompletedCertification = 0;
//        $hasCompletedDocuments = 0;
//        $hasCompletedReference = 0;

        $userDetails = UserDetails::findOne(['user_id' => \Yii::$app->user->id]);
        $workExperience = WorkExperience::findOne(['user_id' => \Yii::$app->user->id]);
        $education = Education::findOne(['user_id' => \Yii::$app->user->id]);
        $license = Licenses::findOne(['user_id' => \Yii::$app->user->id]);
        $certification = Certifications::findOne(['user_id' => \Yii::$app->user->id]);
        $documents = Documents::findOne(['user_id' => \Yii::$app->user->id]);
        $reference = References::findOne(['user_id' => \Yii::$app->user->id]);
        if (CommonFunction::isJobSeeker()) {
            if (isset($userDetails) && !empty($userDetails) && !empty($userDetails->ssn)) {
                $totalPer += 16;
            }

            if (isset($workExperience) && !empty($workExperience)) {
                $totalPer += 14;
            }
            if (isset($education) && !empty($education)) {
                $totalPer += 14;
            }
            if (isset($license) && !empty($license)) {
                $totalPer += 14;
            }
            if (isset($certification) && !empty($certification)) {
                $totalPer += 14;
            }
            if (isset($documents) && !empty($documents)) {
                $totalPer += 14;
            }
            if (isset($reference) && !empty($reference)) {
                $totalPer += 14;
            }
        } else {
            if (isset($userDetails) && !empty($userDetails->first_name)) {
                $totalPer = 15;
            }
            if (isset($userDetails) && !empty($userDetails->last_name)) {
                $totalPer = 15;
            }
            if (isset($userDetails) && !empty($userDetails->mobile_no)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->email)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->apt)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->street_no)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->street_address)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->city)) {
                $totalPer = 10;
            }
            if (isset($userDetails) && !empty($userDetails->dob)) {
                $totalPer = 10;
            }
        }
//        if (isset($workExperience) && !empty($workExperience) && isset($userDetails) && !empty($userDetails) && isset($education) && !empty($education) && isset($license) && !empty($license) && isset($certification) && !empty($certification) && isset($documents) && !empty($documents) && isset($reference) && !empty($reference)) {
//            $percentage = 100;
//        } else {
//        echo $totalPercentage;exit;
        $percentage = $totalPer * $totalPercentage / 100;
//        }
        return round($percentage, 0);
    }

    public static function getAllShiftsCommaSeprated() {
        $shifts = Yii::$app->params['job.shift'];
        array_shift($shifts);
        return implode(", ", $shifts);
    }
    
    public static function getAllBranchIdsOfComapny($companyId) {
        return $branchIds = ArrayHelper::getColumn(CompanyBranch::find()->select("id")->where(['company_id'=>$companyId])->all(),'id');
    }

}
