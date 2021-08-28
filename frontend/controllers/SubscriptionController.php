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
use yii\base\DynamicModel;
use common\models\PackageMaster;

/**
 * Site controller
 */
class SubscriptionController extends Controller {

    public function actionList() {
        $model = PackageMaster::find()->where(['status' => 1])->andWhere(['!=', 'id', 1])->all();

        return $this->render('list', ['model' => $model]);
    }
}
