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
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\WorkExperience;
use common\models\Documents;
use common\models\Licenses;
use common\models\Certifications;
use common\models\Education;
use common\models\References;
use common\models\UserDetails;
use common\models\JobPreference;
use common\models\LeadMaster;
use yii\base\DynamicModel;
use yii\web\NotFoundHttpException;
use common\models\Banner;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use common\models\CertificateMaster;
/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'job-seeker'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['job-seeker'],
                        'allow' => true,
                        'roles' => isset(Yii::$app->user->identity) ? ['@'] : ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $today = date('Y-m-d');
        $advertisments = \common\models\Advertisement::find()->where(['is_active' => '1'])->andWhere("'$today' BETWEEN active_from AND active_to")->orderBy(['id' => SORT_DESC])->limit(6)->all();
        $banner = Banner::find()->where(['status' => '1'])->all();
        $query = LeadMaster::find()->joinWith(['benefits', 'disciplines', 'specialty', 'branch'])->where(['lead_master.status' => LeadMaster::STATUS_APPROVED, 'lead_master.is_suspended' => LeadMaster::IS_SUSPENDED_NO]);
        $query->groupBy(['lead_master.id']);
        $query->orderBy(['lead_master.created_at' => SORT_DESC]);
        $leadModels = $query->limit(8)->all();
        return $this->render('index', [
                    'advertisments' => $advertisments, 'leadModels' => $leadModels, 'banner' => $banner
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionJobSeeker() {


//        if (isset(\Yii::$app->user->identity->id) && isset(\Yii::$app->user->identity->type) && \Yii::$app->user->identity->type == \common\models\User::TYPE_JOB_SEEKER) {
        $workExperience = WorkExperience::find()->where(['user_id' => Yii::$app->user->id])->joinWith('discipline')->asArray()->all();
        $certification = Certifications::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $documents = Documents::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $license = Licenses::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $education = Education::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $references = References::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        $userDetails = UserDetails::findOne(['user_id' => Yii::$app->user->id]);
        $jobPreference = JobPreference::find()->where(['user_id' => Yii::$app->user->id])->all();
        $certificationList = ArrayHelper::map(CertificateMaster::find()->all(), 'id', 'name');

        return $this->render('job-seeker', [
                    'workExperience' => $workExperience,
                    'certification' => $certification,
                    'documents' => $documents,
                    'license' => $license,
                    'education' => $education,
                    'references' => $references,
                    'userDetails' => $userDetails,
                    'jobPreference' => $jobPreference,
                    'certificationList' => $certificationList
        ]);
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token) {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail() {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
                    'model' => $model
        ]);
    }

    public function actionContactUs() {
        $postData = Yii::$app->request->post();
        $model = new DynamicModel(['name', 'email', 'subject', 'message']);

        $model->addRule(['name', 'email', 'subject', 'message'], 'string')
//                ->addRule(['name', 'match', 'pattern' => '/^[a-zA-Z0-9 ]*$/', 'message' => 'Only number and alphabets allowed for {attribute} field'])
                ->addRule(['name', 'email', 'subject', 'message'], 'required')
                ->addRule('email', 'email');

        if ($model->load(Yii::$app->request->post())) {
            if (ContactForm::sendContactUsEmail($postData)) {
                Yii::$app->session->setFlash("success", "Thank you for contacting. We will right back to you soon.");
                return $this->redirect(['site/contact-us']);
            }
        }

        return $this->render('contact-us',['model'=>$model]);
    }

    public function actionAboutUs() {
        return $this->render('about-us');
    }
    public function actionPrivacyPolicy() {
        return $this->render('privacy-policy');
    }
    public function actionTearmsCondition() {
        return $this->render('terms-condition');
    }

    public function actionAdvertise() {
        return $this->render('advertise');
    }
    
    public function actionGetCities($page, $q = null, $id = null) {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'name' => '']];
        if (!is_null($q) && !empty($q)) {
            $query = new \yii\db\Query;
            $query->select(['id', 'state as name'])
                    ->from('states')
                    ->where(['like', 'state', $q])
                    ->offset($offset)
                    ->limit($limit);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
            $out['pagination'] = ['more' => !empty($data) ? true : false];
        } elseif ($id > 0) {
            $query = new \yii\db\Query;
            $query->select(['id', 'state as name'])
                    ->from('states')
                    ->where(['in', 'state', $id])
                    ->offset($offset)
                    ->limit($limit);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
            $out['pagination'] = ['more' => !empty($data) ? true : false];
        }
        return $out;
    }

}
