<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\Json;
use api\modules\v1\components\Controller;
use common\CommonFunction;
use common\models\BlogMaster;
use yii\data\Pagination;
use common\models\BlogCategoryMaster;

class BlogsController extends Controller {

    public $modelClass = 'common\models\BlogMaster';

    public function actionTest() {
        echo "Job Apply APIs Working";
        exit;
    }

    public function actionGetList() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = [];
        try {
            $request = array_map("trim", Yii::$app->request->post());
            $search = (isset($request['filter']) && !empty($request['filter'])) ? $request['filter'] : '';
            $page = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $query = BlogMaster::find()->alias('blog')->where(['blog.status' => BlogMaster::IS_SUSPENDED_NO]);
            if ($search != '') {
                $query->andWhere(['OR',
                        ['like', 'blog.title', $search],
                        ['like', 'blog.short_description', $search],
                ]);
            }

            $blogList = [];

            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => Yii::$app->params['API_PAGINATION_RECORD_LIMIT']]);
            $pages->setPage($page - 1);


            $models = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            foreach ($models as $key => $model) {
                $blogList[] = [
                    'id' => (string) $model->id,
                    'reference_no' => $model->reference_no,
                    'title' => $model->title,
                    'short_description' => $model->short_description,
                    'description' => $model->description,
                    'category_id' => (string) $model->category_id,
                    'category_name' => $model->getCategoryName(),
                    'cover_image_url' => $model->getCoverImageUrl(),
                    'tags' => $model->tags,
                    'tag_list' => $model->getTagsList(),
                ];
            }
            $code = 200;
            $msg = "Success";
            $data = $blogList;
        } catch (\Exception $exc) {
            $code = 500;
            $msg = "Internal server error";
            $data = ['message' => $exc->getMessage(), 'line' => $exc->getLine(), 'file' => $exc->getFile()];
        }

        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function actionDetail() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = [];
        try {
            $request = array_map("trim", Yii::$app->request->post());
            $model = BlogMaster::find()->alias('blog')->where(['reference_no' => $request['reference_no'], 'blog.status' => BlogMaster::IS_SUSPENDED_NO])->one();
            if ($model !== null) {
                $popularBlog = [];
                $categoryList = [];
                $otherBlogs = BlogMaster::find()->alias('blog')->where(['blog.status' => BlogMaster::IS_SUSPENDED_NO])->andWhere(['<>', 'id', $model->id])->orderBy(['created_at' => SORT_DESC])->limit(3)->all();
                $categories = BlogCategoryMaster::find()->where(['status' => BlogCategoryMaster::STATUS_ACTIVE])->orderBy(['created_at' => SORT_DESC])->limit(7)->all();
                foreach ($otherBlogs as $key => $otherBlog) {
                    $popularBlog[] = $otherBlog->getAPIDetails();
                }
                foreach ($categories as $key => $category) {
                    $categoryList[] = ['category_name' => $category->name, 'count' => $category->getBlogMastersCnt()];
                }
                $blogDeail = $model->getAPIDetails();
                $blogDeail['category_list'] = $categoryList;
                $blogDeail['popular_blogs'] = $popularBlog;
                $code = 200;
                $msg = "Success";
                $data = $blogDeail;
            } else {
                $code = 201;
                $msg = "Blog with such reference does not exists.";
            }
        } catch (\Exception $exc) {
            $code = 500;
            $msg = "Internal server error";
            $data = ['message' => $exc->getMessage(), 'line' => $exc->getLine(), 'file' => $exc->getFile()];
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

}
