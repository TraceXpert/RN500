<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\BlogMaster;
use yii\data\Pagination;
use common\models\BlogCategoryMaster;

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
        $query = BlogMaster::find()->alias('blog')->where(['blog.status' => BlogMaster::IS_SUSPENDED_NO]);
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

    public function actionDetail($reference_no) {
        $model = BlogMaster::find()->alias('blog')->where(['reference_no' => $reference_no, 'blog.status' => BlogMaster::IS_SUSPENDED_NO])->one();
        $popularBlogs = BlogMaster::find()->alias('blog')->where(['blog.status' => BlogMaster::IS_SUSPENDED_NO])->orderBy(['created_at' => SORT_DESC])->limit(3)->all();
        $categories = BlogCategoryMaster::find()->where(['status' => BlogCategoryMaster::STATUS_ACTIVE])->orderBy(['created_at' => SORT_DESC])->limit(7)->all();
        return $this->render('detail', [
                    'model' => $model,
                    'popularBlogs' => $popularBlogs,
                    'categories' => $categories
        ]);
    }

}
