<?php

namespace console\controllers;

use Yii;
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
        $model = \common\models\CompanySubscription::find()->andWhere(['>', 'expiry_date', date('Y-m-d', strtotime('now'))])->all();
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

    public function actionIncompleteProfile() {
        $models = \common\models\User::findAll(['is_suspend' => 0, 'status' => 1]);
        $success = 0;
        if (isset($models) && !empty($models)) {
            foreach ($models as $model) {
                if ($model->type == \common\models\User::TYPE_JOB_SEEKER) {
                    $per = \common\CommonFunction::getProfilePercentage();
                    if ($per < 90) {
                        $success++;
                        $sent = Yii::$app->mailer->compose('incomplete-profile', ['fullName' => $model->fullName])
                                ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                                ->setTo($model->email)
                                ->setSubject("You're at $per% Update your profile and get the most out of RN500")
                                ->send();
                    }
                } else {
                    $per = \common\CommonFunction::getProfilePercentage();
                    if ($per < 85) {
                        $success++;
                        $sent = Yii::$app->mailer->compose('incomplete-profile', ['fullName' => $model->fullName])
                                ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                                ->setTo($model->email)
                                ->setSubject("You're at $per% Update your profile and get the most out of RN500")
                                ->send();
                    }
                }
            }
            echo $success . " Mail sent successfully.";
        } else {
            echo "No records found";
            exit;
        }
    }

    public function actionWeeklyJobs() {
        $to_date = Date('Y-m-d');
        $from_date = Date('Y-m-d', strtotime("-7 Days")); //get before 7 days date    
        $models = \common\models\LeadMaster::find()->where("created_at BETWEEN '$from_date' AND '$to_date'")->andWhere(['status' => 1])->all();
        $jobseekers = \common\models\User::findAll(['type' => \common\models\User::TYPE_JOB_SEEKER, 'is_suspend' => 0, 'status' => 1]);
        $success = 0;
        if (isset($models) && !empty($models) && isset($jobseekers) && !empty($jobseekers)) {
            foreach ($jobseekers as $jobseeker) {
                $success++;
                $sent = Yii::$app->mailer->compose('weekly-job', ['models' => $models])
                        ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                        ->setTo($jobseeker->email)
                        ->setSubject("This Week's top jobs")
                        ->send();
            }
            echo $success . " Mail sent successfully.";
        } else {
            echo "No records found";
            exit;
        }
    }

}
