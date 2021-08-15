<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\BlogMaster;
use yii\data\Pagination;

class BlogsController extends Controller {

    public function behaviors() {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['list', 'detail-view'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                    [
//                        'actions' => ['job-seeker'],
//                        'allow' => true,
//                        'roles' => isset(Yii::$app->user->identity) ? ['@'] : ['*'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function actionList() {
        $search = trim(Yii::$app->request->get('search'));

        $query = BlogMaster::find()->alias('blog')->where(['blog.status' => BlogMaster::STATUS_ACTIVE]);
        if ($search != '') {
            $query->andWhere(['OR',
                    ['like', 'blog.title', $search],
                    ['like', 'blog.short_description', $search],
            ]);
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 21]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('list', [
                    'blogList' => $models,
                    'pages' => $pages,
        ]);
    }

}
