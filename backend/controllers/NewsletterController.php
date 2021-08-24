<?php

namespace backend\controllers;

use Yii;
use common\models\NewsletterMaster;
use common\models\NewsletterMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\BlogCategoryMaster;
use common\models\BlogCategoryMasterSearch;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\CommonFunction;

/**
 * NewsletterController implements the CRUD actions for NewsletterMaster model.
 */
class NewsletterController extends Controller {

    public $title = "Newsletter";
    public $activeBreadcrumb, $breadcrumb;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index', 'add', 'update', 'view', 'suspend',
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'update', 'view', 'suspend'],
                        'allow' => true,
                        'roles' => isset(Yii::$app->user->identity) ? (CommonFunction::checkAccess('newsletter-create', Yii::$app->user->identity->id) || CommonFunction::checkAccess('newsletter-update', Yii::$app->user->identity->id)) ? ['@'] : ['*'] : ['*'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => isset(Yii::$app->user->identity) ? CommonFunction::checkAccess('newsletter-view', Yii::$app->user->identity->id) ? ['@'] : ['*'] : ['*'],
                    ],
                    [
                        'actions' => ['index', 'suspend', 'view'],
                        'allow' => true,
                        'roles' => isset(Yii::$app->user->identity) ? CommonFunction::checkAccess('newsletter-suspend', Yii::$app->user->identity->id) ? ['@'] : ['*'] : ['*'],
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
            $this->title => Yii::$app->urlManagerAdmin->createAbsoluteUrl(['newsletter/index']),
        ];
    }

    /**
     * Lists all NewsletterMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NewsletterMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsletterMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $this->activeBreadcrumb = "Detail View";
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NewsletterMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd() {
        $this->activeBreadcrumb = "Add";
        $model = new NewsletterMaster();
        $model->setScenario(NewsletterMaster::SCENARIO_ADD);
        $model->status = NewsletterMaster::IS_SUSPENDED_NO;
        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES['NewsletterMaster']['name']['coverImageFile']) && $_FILES['NewsletterMaster']['name']['coverImageFile'] != '') {
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
                Yii::$app->session->setFlash("success", "Newsletter was added.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
            }
        }

        return $this->render('_form', [
                    'model' => $model
        ]);
    }

    /**
     * Updates an existing NewsletterMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->tagsList = $model->getTagsList();
        $oldCoverImage = $model->conver_image_name;
        $isCoverImageUpdated = false;
        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES['NewsletterMaster']['name']['coverImageFile']) && $_FILES['NewsletterMaster']['name']['coverImageFile'] != '') {
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
                Yii::$app->session->setFlash("success", "Newsletter was updated.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
            }
        }

        return $this->render('_form', [
                    'model' => $model
        ]);
    }

    public function actionSuspend($id, $status) {

        $model = $this->findModel($id);
        $model->status = $status;
        $model->setScenario(NewsletterMaster::SCENARIO_SUSPEND);
        $flashMessage = ($status == NewsletterMaster::IS_SUSPENDED_YES) ? "Newsletter was suspended." : "Removed from suspension.";
        if ($model->beforeSaveInit() && $model->save(false)) {
            Yii::$app->session->setFlash("success", $flashMessage);
        } else {
            Yii::$app->session->setFlash("warning", "Something went wrong, please try after some time.");
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing NewsletterMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the NewsletterMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsletterMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = NewsletterMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
