<?php

namespace frontend\controllers;

use Yii;
use common\models\UserDetails;
use common\models\UserDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\WorkExperience;
use yii\helpers\ArrayHelper;
use common\models\Speciality;
use common\models\Discipline;
use common\models\Education;
use common\models\Licenses;
use common\models\Certifications;
use common\models\Documents;
use common\models\References;
use common\models\JobPreference;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\models\CompanyBranch;
use common\models\CompanyMaster;
use common\CommonFunction;
use common\models\Cities;

/**
 * UserDetailsController implements the CRUD actions for UserDetails model.
 */
class UserDetailsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        if ($action->id == 'get-profile-percentage') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all UserDetails models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDetails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $uid = base64_decode($id);
        return $this->render('view', [
                    'model' => $this->findModel($uid),
        ]);
    }

    /**
     * Creates a new UserDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new UserDetails();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->user_id = \Yii::$app->user->id;
            $model->created_at = time();
            $model->updated_at = time();
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "User details updated successfully.");
                return json_encode(['error' => 0, 'message' => 'User details updated successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "User details failed to update.");
                return json_encode(['error' => 1, 'message' => 'something went wrong.', 'date' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $uid = base64_decode($id);
        $postData = Yii::$app->request->post();
        $model = UserDetails::findOne(['user_id' => $uid]);
        $model->scenario = 'profile';
        $model->updated_at = CommonFunction::currentTimestamp();
        if (isset($model->dob) && !empty($model->dob)) {
            $model->dob = date('M-d-Y', strtotime($model->dob));
        } else {
            $model->dob = date('d-m-Y');
        }
        if (isset($model->city) && !empty($model->city)) {
            $selectedLocations = ArrayHelper::map(Cities::find()->where(['id' => $model->city])->all(), 'id', function ($data) {
                        return $data->city . "-" . $data->state_code;
                    });
        } else {
            $selectedLocations = [];
        }
        $old_profile_image = isset($model->profile_pic) && !empty($model->profile_pic) ? $model->profile_pic : NULL;
        $document_upload_flag = '';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

            $model->city = isset($_POST['city']) && !empty($_POST['city']) ? $_POST['city'] : '';
            $model->dob = date('Y-m-d', strtotime($model->dob));

            $document_file = UploadedFile::getInstance($model, 'profile_pic');

            $folder = CommonFunction::getProfilePictureBasePath();
            if (!file_exists($folder)) {
                FileHelper::createDirectory($folder, 0777);
            }

            if ($document_file) {
                $model->profile_pic = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $document_file->getExtension();
                $document_upload_flag = $document_file->saveAs($folder . '/' . $model->profile_pic);
            }

            if (isset($old_profile_image) && !empty($old_profile_image) && file_exists($folder . '/' . $old_profile_image)) {
                if ($document_upload_flag) {
                    unlink($folder . '/' . $old_profile_image);
                } else {
                    $model->profile_pic = $old_profile_image;
                }
            }

            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "User details updated successfully.");
                return json_encode(['error' => 0, 'message' => 'User details updated successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "User details failed to update.");
                return json_encode(['error' => 1, 'message' => 'something went wrong.', 'errors' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('update', [
                    'model' => $model, 'selectedLocations' => $selectedLocations
        ]);
    }

    public function actionProfile($id) {
        if ($id == \Yii::$app->user->identity->id) {
            $postData = Yii::$app->request->post();
            $model = UserDetails::findOne(['user_id' => $id]);

            $model->scenario = 'profile';
            $model->updated_at = CommonFunction::currentTimestamp();
            $old_document_file = isset($model->profile_pic) && !empty($model->profile_pic) ? $model->profile_pic : NULL;
            $document_upload_flag = '';
            $branch = CompanyBranch::findOne(['id' => CommonFunction::getLoggedInUserBranchId()]);
            $companyDetail = CompanyMaster::findOne(['id' => CommonFunction::getLoggedInUserCompanyId()]);

            if (isset($model->dob) && !empty($model->dob)) {
                $model->dob = date('M-d-Y', strtotime($model->dob));
            }

            $states = ArrayHelper::map(\common\models\States::find()->where(['country_id' => 226])->all(), 'id', 'state');
            $city = ArrayHelper::map(Cities::findAll(['state_id' => $model->state]), 'id', 'city');
            if (isset($model->city) && !empty($model->city)) {
                $model->state = $model->cityRef->state_id;
                $states = ArrayHelper::map(\common\models\States::find()->where(['id' => $model->cityRef->state_id])->all(), 'id', 'state');
                $city = ArrayHelper::map(Cities::findAll(['state_id' => $model->cityRef->state_id]), 'id', 'city');
            }
            if ($model->load(Yii::$app->request->post())) {
//                $model->city = isset($_POST['city']) && !empty($_POST['city']) ? $_POST['city'] : '';
                $model->dob = date('Y-m-d', strtotime($model->dob));

                $document_file = UploadedFile::getInstance($model, 'profile_pic');

                $folder = \Yii::$app->basePath . "/web/uploads/user-details/profile/";
                if (!file_exists($folder)) {
                    FileHelper::createDirectory($folder, 0777);
                }

                if ($document_file) {
                    $model->profile_pic = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $document_file->getExtension();
                    $document_upload_flag = $document_file->saveAs($folder . '/' . $model->profile_pic);
                }

                if (isset($old_document_file) && !empty($old_document_file) && file_exists($folder . $old_document_file)) {
                    if ($document_upload_flag) {
                        unlink($folder . $old_document_file);
                    } else {
                        $model->profile_pic = $old_document_file;
                    }
                }

                if ($model->save() && $model->validate()) {
                    Yii::$app->session->setFlash('success', "User details updated successfully.");
                    return $this->redirect(['profile', 'id' => $id]);
                } else {
                    Yii::$app->session->setFlash('error', "User details failed to update.");
                    return $this->redirect(['profile', 'id' => $id]);
                }
            }
        } else {
            Yii::$app->session->setFlash('error', "You are not valid user.");
            return $this->redirect(['site/index']);
        }

        return $this->render('profile', [
                    'model' => $model,
                    'companyDetail' => $companyDetail,
                    'branch' => $branch, 'states' => $states, 'city' => $city
        ]);
    }

    public function actionGetCities($id) {
        $cities = ArrayHelper::map(Cities::find()->where(['state_id' => $id])->all(), 'id', 'city');
        $options = '';
        if (!empty($cities)) {
            foreach ($cities as $key => $city) {
                $options .= "<option value=$key>$city</option>";
            }
        }
        echo $options;
        exit;
    }

    /**
     * Deletes an existing UserDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $uid = base64_decode($id);
        $this->findModel($uid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $uid = base64_decode($id);
        if (($model = UserDetails::findOne($uid)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    public function actionAddJobPrefernce() {
//        $id = \Yii::$app->request->get('id');
//        $postData = Yii::$app->request->post();
//
//        if ($id !== null) {
//            $model = JobPreference::findOne($id);
//        } else {
//            $model = new JobPreference();
//        }
//
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//
//            $model->location = $postData['location'];
//            $model->user_id = \Yii::$app->user->id;
//
//            if ($model->validate()) {
//                if ($model->save()) {
//                    Yii::$app->session->setFlash('success', "Job Prefernce Updated successfully.");
//                    return json_encode(['error' => 0, 'message' => 'Job Prefernce Updated successfully.']);
//                }
//            } else {
//                Yii::$app->session->setFlash('success', "Job Prefernce Updated failed.");
//                return json_encode(['error' => 0, 'message' => 'Work Experience Updated failed.', 'data' => $model->getErrors()]);
//            }
//        }
//
//        return $this->renderAjax('add-job-prefernce', [
//                    'model' => $model
//        ]);
//    }

    public function actionWorkExperience() {
        $postData = Yii::$app->request->post();
        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $message = '';
        if ($id !== null) {
            $model = WorkExperience::findOne($id);
            $message = 'updated';
            $model->updated_at = CommonFunction::currentTimestamp();
            $model->start_date = date('m-Y', strtotime($model->start_date));

            if ($model->currently_working != '1') {
                $model->end_date = date('m-Y', strtotime($model->end_date));
            } else {
                $model->end_date = null;
            }
        } else {
            $model = new WorkExperience();
            $message = 'added';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }
        if (isset($model->city) && !empty($model->city)) {
            $selectedLocations = ArrayHelper::map(Cities::find()->where(['id' => $model->city])->all(), 'id', function ($data) {
                        return $data->city . "-" . $data->state_code;
                    });
        } else {
            $selectedLocations = [];
        }
        $speciality = ArrayHelper::map(Speciality::find()->all(), 'id', 'name');
        $discipline = ArrayHelper::map(Discipline::find()->all(), 'id', 'name');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->user_id = \Yii::$app->user->id;
            $model->start_date = date('Y-m-d', strtotime("01-" . $model->start_date));
            $model->city = isset($_POST['city']) && !empty($_POST['city']) ? $_POST['city'] : '';
            $model->currently_working = isset($_POST['currently_working']) && !empty($_POST['currently_working']) ? $_POST['currently_working'] : '';
            if ($model->currently_working != '1') {
                $model->end_date = date('Y-m-d', strtotime("01-" . $model->end_date));
            }


            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "Work Experience " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'Work Experience ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('work-experience', [
                    'model' => $model,
                    'discipline' => $discipline, 'selectedLocations' => $selectedLocations,
                    'speciality' => $speciality,
        ]);
    }

    public function actionAddEducation() {
        $postData = Yii::$app->request->post();
        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $message = '';

        if ($id !== null) {
            $model = Education::findOne($id);
            $message = 'Updated';
            $model->updated_at = CommonFunction::currentTimestamp();
            $model->year_complete = date('m-Y', strtotime($model->year_complete));
        } else {
            $model = new Education();
            $message = 'added';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }

        if (isset($model->location) && !empty($model->location)) {
            $selectedLocations = ArrayHelper::map(Cities::find()->where(['id' => $model->location])->all(), 'id', function ($data) {
                        return $data->city . "-" . $data->state_code;
                    });
        } else {
            $selectedLocations = [];
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->user_id = \Yii::$app->user->id;
            $model->year_complete = date('Y-m-d', strtotime("01-" . $model->year_complete));
            $model->location = isset($_POST['location']) && !empty($_POST['location']) ? $_POST['location'] : '';

            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "Education details " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'Education details ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('add-education', [
                    'model' => $model, 'selectedLocations' => $selectedLocations,
        ]);
    }

    public function actionAddLicence() {
        $postData = Yii::$app->request->post();
        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $isRecordFlag = false;
        $document_upload_flag = '';
        $message = '';

        if ($id !== null) {
            $model = Licenses::findOne($id);
            $message = 'updated';
            $model->updated_at = CommonFunction::currentTimestamp();
            $model->expiry_date = date('m-Y', strtotime($model->expiry_date));
            $old_document_file = isset($model->document) && !empty($model->document) ? $model->document : NULL;
            $isRecordFlag = true;
        } else {
            $model = new Licenses();
            $message = 'added';
            $model->scenario = 'create';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }
        if (isset($model->issuing_state) && !empty($model->issuing_state)) {
            $selectedLocations = ArrayHelper::map(Cities::find()->where(['id' => $model->issuing_state])->all(), 'id', function ($data) {
                        return $data->city . "-" . $data->state_code;
                    });
        } else {
            $selectedLocations = [];
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

            $model->user_id = \Yii::$app->user->id;
            $model->expiry_date = date('Y-m-d', strtotime("01-" . $model->expiry_date));
//            $model->issuing_state = isset($_POST['issuing_state']) && !empty($_POST['issuing_state']) ? $_POST['issuing_state'] : '';
            $model->compact_states = isset($_POST['Licenses']['compact_states']) && !empty($_POST['Licenses']['compact_states']) ? '1' : '';
            $document_file = UploadedFile::getInstance($model, 'document');

            $folder = CommonFunction::getLicensesBasePath();
            if (!file_exists($folder)) {
                FileHelper::createDirectory($folder, 0777);
            }

            if ($document_file) {
                $model->document = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $document_file->getExtension();
                $document_upload_flag = $document_file->saveAs($folder . '/' . $model->document);
            }

            if (isset($old_document_file) && !empty($old_document_file) && file_exists($folder . '/' . $old_document_file)) {
                if ($document_upload_flag) {
                    unlink($folder . "/" . $old_document_file);
                } else {
                    $model->document = $old_document_file;
                }
            } else {
                if (!$document_upload_flag) {
                    $model->document = NULL;
                }
            }


            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "License details " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'License details ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('add-licence', [
                    'model' => $model, 'selectedLocations' => $selectedLocations,
                    'isRecordFlag' => $isRecordFlag
        ]);
    }

    public function actionAddCertification() {
        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $postData = Yii::$app->request->post();
        $isRecordFlag = false;
        $document_upload_flag = '';
        $message = '';

        if ($id !== null) {
            $model = Certifications::findOne($id);
            $message = 'updated';
            $model->updated_at = CommonFunction::currentTimestamp();
            if (isset($model->expiry_date) && !empty($model->expiry_date)) {
                $model->expiry_date = date('m-Y', strtotime($model->expiry_date));
            }
            if (isset($model->certification_active) && !empty($model->certification_active)) {
                $model->certification_active = $model->certification_active;
            }
            $old_document_file = isset($model->document) && !empty($model->document) ? $model->document : NULL;
            $isRecordFlag = true;
        } else {
            $model = new Certifications();
            $message = 'added';
            $model->scenario = 'create';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }

        if (isset($model->issuing_state) && !empty($model->issuing_state)) {
            $selectedLocations = ArrayHelper::map(Cities::find()->where(['id' => $model->issuing_state])->all(), 'id', function ($data) {
                        return $data->city . "-" . $data->state_code;
                    });
        } else {
            $selectedLocations = [];
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->issuing_state = isset($_POST['issuing_state']) && !empty($_POST['issuing_state']) ? $_POST['issuing_state'] : '';
            $model->user_id = \Yii::$app->user->id;
            if (isset($model->expiry_date) && !empty($model->expiry_date)) {
                $model->expiry_date = date('Y-m-d', strtotime("01-" . $model->expiry_date));
            }

            if (isset($postData['certification_active']) && !empty($postData['certification_active'])) {
                $model->certification_active = $postData['certification_active'];
            }

            $document_file = UploadedFile::getInstance($model, 'document');

            $folder = CommonFunction::getCertificateBasePath();

            if (!file_exists($folder)) {
                FileHelper::createDirectory($folder, 0777);
            }

            if ($document_file) {
                $model->document = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $document_file->getExtension();
                $document_upload_flag = $document_file->saveAs($folder . '/' . $model->document);
            }

            if (isset($old_document_file) && !empty($old_document_file) && file_exists($folder . '/' . $old_document_file)) {
                if ($document_upload_flag) {
                    unlink($folder . '/' . $old_document_file);
                } else {
                    $model->document = $old_document_file;
                }
            } else {
                if (!$document_upload_flag) {
                    $model->document = NULL;
                }
            }

            if ($model->save() && $model->validate()) {
                Yii::$app->session->setFlash('success', "Certification details " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'Certification details ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('add-certification', [
                    'model' => $model,
                    'isRecordFlag' => $isRecordFlag, 'selectedLocations' => $selectedLocations
        ]);
    }

    public function actionAddDocument() {

        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $isRecordFlag = false;
        $document_upload_flag = '';
        $message = '';

        if ($id !== null) {
            $model = Documents::findOne($id);
            $message = 'updated';
            $model->updated_at = CommonFunction::currentTimestamp();
            $old_document_file = isset($model->path) && !empty($model->path) ? $model->path : NULL;
            $isRecordFlag = true;
        } else {
            $model = new Documents();
            $message = 'added';
            $model->scenario = 'create';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {


            $model->user_id = \Yii::$app->user->id;
            $document_file = UploadedFile::getInstance($model, 'path');

            $folder = CommonFunction::getDocumentBasePath();
            if (!file_exists($folder)) {
                FileHelper::createDirectory($folder, 0777);
            }

            if ($document_file) {
                $model->path = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $document_file->getExtension();
                $document_upload_flag = $document_file->saveAs($folder . '/' . $model->path);
            }

            if (isset($old_document_file) && !empty($old_document_file) && file_exists($folder . "/" . $old_document_file)) {
                if ($document_upload_flag) {
                    unlink($folder . "/" . $old_document_file);
                } else {
                    $model->path = $old_document_file;
                }
            } else {
                if (!$document_upload_flag) {
                    $model->path = NULL;
                }
            }

            if ($model->save() && $model->validate()) {
                Yii::$app->session->setFlash('success', "Document was " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'Document was ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('add-document', [
                    'model' => $model,
                    'isRecordFlag' => $isRecordFlag
        ]);
    }

    public function actionAddReference() {

        $id = !empty(\Yii::$app->request->get('id')) ? base64_decode(\Yii::$app->request->get('id')) : null;
        $message = '';
        if ($id !== null) {
            $model = References::findOne($id);
            $message = 'updated';
            $model->updated_at = CommonFunction::currentTimestamp();
        } else {
            $model = new References();
            $message = 'added';
            $model->created_at = CommonFunction::currentTimestamp();
            $model->updated_at = CommonFunction::currentTimestamp();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

            $model->user_id = \Yii::$app->user->id;

            if ($model->save() && $model->validate()) {
                Yii::$app->session->setFlash('success', "Reference details " . $message . " successfully.");
                return json_encode(['error' => 0, 'message' => 'Reference details ' . $message . ' successfully.']);
            } else {
                Yii::$app->session->setFlash('error', "Something went wrong.");
                return json_encode(['error' => 0, 'message' => 'Something went wrong.', 'data' => $model->getErrors()]);
            }
        }

        return $this->renderAjax('add-reference', [
                    'model' => $model
        ]);
    }

    public function actionDeleteDocument() {
        $id = \Yii::$app->request->get('id');
        $postData = \Yii::$app->request->post();
        $deleteFlag = false;
        $uploadPath = '';
        $file = '';


        $model = Documents::findOne($id);

        $uploadPath = CommonFunction::getDocumentBasePath() . '/';
        $file = $model->path;


        if (file_exists($uploadPath . $file)) {
            unlink($uploadPath . $file);
        }

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', "Document was deleted successfully.");
            $deleteFlag = true;
        }

        echo $deleteFlag;
    }

    public function actionGetProfilePercentage() {
        echo CommonFunction::getProfilePercentage();
    }

}
