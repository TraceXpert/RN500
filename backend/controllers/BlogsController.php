<?php

namespace backend\controllers;

use Yii;
use common\models\BlogMaster;
use common\models\BlogMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\BlogCategoryMaster;
use common\models\BlogCategoryMasterSearch;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * BlogsController implements the CRUD actions for BlogMaster model.
 */
class BlogsController extends Controller {

    public $title = "Blogs";
    public $activeBreadcrumb, $breadcrumb;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'add', 'update', 'delete',
                    'categories', 'category-view', 'category-add', 'category-update', 'category-delete'
                ],
                'rules' => [
                        [
                        'actions' => ['index', 'view', 'add', 'update', 'delete',
                            'categories', 'category-view', 'category-add', 'category-update', 'category-delete'
                        ],
                        'allow' => true,
//                        'roles' => isset(Yii::$app->user->identity) ? CommonFunction::checkAccess('blog-manage', Yii::$app->user->identity->id) ? ['@'] : ['*'] : ['*'],
                        'roles' => isset(Yii::$app->user->identity) ? ['@'] : ['*'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['POST'],
                    'suspend' => ['POST'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->breadcrumb = [
            'Home' => Url::base(true),
            $this->title => Yii::$app->urlManagerAdmin->createAbsoluteUrl(['blogs/index']),
        ];
    }

    public function actionIndex() {
        $searchModel = new BlogMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        $this->activeBreadcrumb = "Detail View";
        return $this->render('view', [
                    'model' => $this->findBlogModel($id),
        ]);
    }

    public function actionAdd() {
        $this->activeBreadcrumb = "Add";
        $model = new BlogMaster();
        $model->setScenario(BlogMaster::SCENARIO_ADD);
        $model->status = BlogMaster::IS_SUSPENDED_NO;
        $categories = BlogCategoryMaster::getBlogCategories(true);
        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES['BlogMaster']['name']['coverImageFile']) && $_FILES['BlogMaster']['name']['coverImageFile'] != '') {
                $model->coverImageFile = UploadedFile::getInstance($model, 'coverImageFile');
                if (!$model->saveCoverImage()) {
                    Yii::$app->session->setFlash("warning", "Something went wrong while saving cover image.");
                    return $this->render('_form', [
                                'model' => $model,
                                'categories' => $categories,
                    ]);
                }
            }

            if ($model->validate(['title', 'short_description', 'description', 'category_id']) && $model->beforeSaveInit() && $model->save(false)) {
                Yii::$app->session->setFlash("success", "Blog was added.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
            }
        }

        return $this->render('_form', [
                    'model' => $model,
                    'categories' => $categories,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findBlogModel($id);
        $model->tagsList = $model->getTagsList();
        $oldCoverImage = $model->conver_image_name;
        $isCoverImageUpdated = false;
        $categories = BlogCategoryMaster::getBlogCategories(true);
        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES['BlogMaster']['name']['coverImageFile']) && $_FILES['BlogMaster']['name']['coverImageFile'] != '') {
                $model->coverImageFile = UploadedFile::getInstance($model, 'coverImageFile');
                if (!$model->saveCoverImage()) {
                    Yii::$app->session->setFlash("warning", "Something went wrong while saving cover image.");
                    return $this->render('_form', [
                                'model' => $model,
                                'categories' => $categories,
                    ]);
                }
                $isCoverImageUpdated = true;
            }

            if ($model->beforeSaveInit() && $model->save(false)) {
                ($isCoverImageUpdated) ? $model->deleteCoverImage($oldCoverImage) : "";
                Yii::$app->session->setFlash("success", "Blog was updated.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
            }
        }

        return $this->render('_form', [
                    'model' => $model,
                    'categories' => $categories,
        ]);
    }

    public function actionSuspend($id, $status) {

        $model = $this->findBlogModel($id);
        $model->status = $status;
        $model->setScenario(BlogMaster::SCENARIO_SUSPEND);
        $flashMessage  = ($status == BlogMaster::IS_SUSPENDED_YES) ? "Blog was suspended." :"Removed from suspension.";
        if ($model->beforeSaveInit() && $model->save(false)) {
            Yii::$app->session->setFlash("success", $flashMessage);
        } else {
            echo "<pre>";
            print_r($model->getErrors());
            exit;
            Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
        }
        return $this->redirect(['index']);
    }

//    
//    public function actionDelete($id) {
//        $this->findBlogModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    protected function findBlogModel($id) {
        if (($model = BlogMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 
     * FOR BLOG CATEGORY
     * 
     */
    protected function findBlogCategoryModel($id) {
        if (($model = BlogCategoryMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCategories() {
        $this->title = "Categories";
        $this->breadcrumb = [
            'Home' => Url::base(true),
        ];
        $this->activeBreadcrumb = $this->title;
        $searchModel = new BlogCategoryMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('categories-list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategoryAdd() {
        $this->title = "Categories";
        $this->breadcrumb = [
            'Home' => Url::base(true),
            $this->title => Yii::$app->urlManagerAdmin->createAbsoluteUrl(['blogs/categories']),
        ];
        $this->activeBreadcrumb = "Add";
        $model = new BlogCategoryMaster();
        $model->status = BlogCategoryMaster::STATUS_ACTIVE;

        if ($model->load(Yii::$app->request->post()) && $model->beforeSaveInit() && $model->save()) {
            Yii::$app->session->setFlash("success", "Category was added.");
            return $this->redirect(['categories']);
        }

        return $this->render('_category_form', [
                    'model' => $model,
        ]);
    }

    public function actionCategoryUpdate($id) {
        $this->title = "Categories";
        $this->breadcrumb = [
            'Home' => Url::base(true),
            $this->title => Yii::$app->urlManagerAdmin->createAbsoluteUrl(['blogs/categories']),
        ];
        $this->activeBreadcrumb = "Update";
        $model = $this->findBlogCategoryModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->beforeSaveInit() && $model->save()) {
            Yii::$app->session->setFlash("success", "Category was updated.");
            return $this->redirect(['categories']);
        }

        return $this->render('_category_form', [
                    'model' => $model,
        ]);
    }

    public function actionCategoryDelete($id) {
        $this->findBlogCategoryModel($id)->delete();

        return $this->redirect(['index']);
    }

}
