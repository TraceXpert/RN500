<?php

namespace console\controllers;

use yii\console\Controller;

class CronController extends Controller {

    /**
     * This command echo what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionTest() {
        echo "Test cron job"; // your logic for deleting old post goes here
        exit();
    }

    public function actionFailPayment() {
        $model = \common\models\CompanySubscriptionPayment::find()->where(['status' => 0])->andWhere(['!=', 'from_unixtime(created_at,"%Y-%m-%d")', date('Y-m-d', strtotime('now'))])->all();
        $count = 0;
        foreach ($model as $value) {
            $value->status = 2;
            $value->updated_at = \common\CommonFunction::currentTimestamp();
            $value->save(false);
            $count++;
        }
        echo "success count " . $count;
        exit;
    }
    
    public function actionExpireSubscription() {
        $model = \common\models\CompanySubscription::find()->andWhere(['>','expiry_date',date('Y-m-d', strtotime('now'))])->all();
        $count = 0;
        foreach ($model as $value) {
            $value->status = 2;
            $value->updated_at = \common\CommonFunction::currentTimestamp();
            $value->save(false);
            $count++;
        }
        echo "success count " . $count;
        exit;
    }

}
