<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\WorkExperience;
use common\models\Documents;
use common\models\Licenses;
use common\models\Certifications;
use common\models\Education;
use common\models\References;
use common\models\UserDetails;
use common\models\JobPreference;
use common\models\LeadMaster;
use yii\base\DynamicModel;
use yii\web\NotFoundHttpException;
use common\models\Banner;
use common\models\Advertisement;

/**
 * Site controller
 */
class AdvertisementController extends Controller {

    public function actionAll() {
        $perPageLimt = Yii::$app->params['PAGE_LENGTH'];
        $today = date('Y-m-d');
        $advertismentsTotalCnt = Advertisement::find()->where(['is_active' => '1'])->andWhere("'$today' BETWEEN active_from AND active_to")->orderBy(['id' => SORT_DESC])->count();
        $total_pages = (ceil($advertismentsTotalCnt / $perPageLimt)) ? ceil($advertismentsTotalCnt / $perPageLimt) : 1;

        return $this->render('all', ['total_pages' => $total_pages]);
    }

    public function actionLoad($page = 1, $location = '') {
        $perPageLimt = Yii::$app->params['PAGE_LENGTH'];
        $today = date('Y-m-d');
        $advertisments = Advertisement::find()->where(['is_active' => '1'])->andWhere("'$today' BETWEEN active_from AND active_to")->orderBy(['id' => SORT_DESC])->limit($perPageLimt)->offset(($page - 1) * $perPageLimt)->all();
        return $this->renderAjax('_load_ads', ['advertisments' => $advertisments]);
    }

}
