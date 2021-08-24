<?php

namespace frontend\controllers;

use Yii;
use common\models\NewsletterMaster;
use common\models\NewsletterMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * NewsletterController implements the CRUD actions for NewsletterMaster model.
 */
class NewsletterController extends Controller
{
    public function actionList() {
        $search = trim(Yii::$app->request->get('search'));
        $query = NewsletterMaster::find()->alias('newsletter')->where(['newsletter.status' => NewsletterMaster::IS_SUSPENDED_NO]);
        if ($search != '') {
            $query->andWhere(['OR',
                    ['like', 'newsletter.title', $search],
                    ['like', 'newsletter.short_description', $search],
            ]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 21]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('list', [
                    'newsletterList' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionDetail($reference_no) {
        $model = NewsletterMaster::find()->alias('newsletter')->where(['reference_no' => $reference_no, 'newsletter.status' => NewsletterMaster::IS_SUSPENDED_NO])->one();
        if ($model !== null) {

            $popularNewsletter = NewsletterMaster::find()->alias('newsletter')->where(['newsletter.status' => NewsletterMaster::IS_SUSPENDED_NO])->andWhere(['<>','id',$model->id])->orderBy(['created_at' => SORT_DESC])->limit(3)->all();
            return $this->render('detail', [
                        'model' => $model,
                        'popularNewsletter' => $popularNewsletter
            ]);
        } else {
            throw  new \yii\web\NotFoundHttpException("");
        }
    }

}
