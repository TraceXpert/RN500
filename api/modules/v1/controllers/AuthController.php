<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use yii\helpers\Json;
use api\modules\v1\components\Controller;
use Firebase\JWT\JWT;
use common\models\OtpRequest;
use common\models\LoginForm;
use frontend\models\JobseekerForm;
use common\models\UserDetails;
use common\models\PasswordResetRequestForm;
use common\CommonFunction;
use yii\helpers\Url;

class AuthController extends Controller {

    public $modelClass = 'common\models\User';

    public function actionLogin() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            if (isset($request["email"]) && isset($request['password']) && !empty($request["email"]) && !empty($request["password"])) {
                $user = User::findOne(['email' => $request["email"], 'status' => User::STATUS_APPROVED, 'type' => User::TYPE_JOB_SEEKER, 'is_suspend' => 0]);
                if (!empty($user) && $user->validatePassword($request['password'])) {
                    $model = new LoginForm();
                    $model->username = $user->email;
                    $model->password = $request["password"];
                    if (isset($request['otp']) && !empty($request['otp'])) {
                        $model->otp = $request['otp'];
                        if ($model->OTPVerified()) {
                            $jwtToken = $this->generateJWTtoken($user);
                            $code = 200;
                            $msg = "You have successfully Logged In!";
                            $data = [
                                'token' => $jwtToken,
                                'first_name' => $user->details->first_name,
                                'last_name' => $user->details->last_name,
                                'email' => $user->email,
                                'profile_image' => (isset($user->details->profile_pic) && !empty($user->details->profile_pic) && file_exists(CommonFunction::getProfilePictureBasePath() . "/" . $user->details->profile_pic) ) ? Url::to(Yii::$app->urlManagerFrontend->createUrl(["/uploads/user-details/profile/" . $user->details->profile_pic]), true) : ''
                            ];
                        } else {
                            $code = 202;
                            $msg = "Invalid OTP.";
                        }
                    } else {
                        $model->sendOTP();
                        $code = 301;
                        $msg = "We have sent an OTP to your registered email.";
                    }
                } else {
                    $code = 202;
                    $msg = "Invalid email or password";
                }
            }
        } catch (\Exception $exc) {
            $code = 500;
            $msg = "Internal server error";
            $data = ['message' => $exc->getMessage(), 'line' => $exc->getLine(), 'file' => $exc->getFile()];
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        \common\CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function actionResendOtp() {
        $data = [];
        $code = 201;
        $msg = "Required parameter missing";
        $request = Yii::$app->request->post();
        try {
            if (isset($request["email"]) && isset($request['password']) && !empty($request["email"]) && !empty($request["password"])) {
                $user = User::findOne(['email' => $request["email"], 'status' => User::STATUS_APPROVED, 'type' => User::TYPE_JOB_SEEKER, 'is_suspend' => 0]);
                if (!empty($user) && $user->validatePassword($request['password'])) {
                    $sent_otp_detail = OtpRequest::find()->where(['user_id' => $user->id, 'is_verified' => OtpRequest::STATUS_NOT_VERIFIED])->orderBy("id desc")->one();
                    if (!empty($sent_otp_detail)) {
                        $sent = \Yii::$app->mailer->compose('login-otp', ['otp' => $sent_otp_detail->otp, 'user' => $user])
                                ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                                ->setTo($user->email)
                                ->setSubject('RN500 Verification Code')
                                ->send();
                        $code = 200;
                        $msg = "Success";
                    } else {
                        $code = 200;
                        $msg = "OTP Not Found";
                    }
                } else {
                    $code = 202;
                    $msg = "Invalid email or password";
                }
            }
        } catch (\Exception $exc) {
            $code = 500;
            $msg = "Internal server error";
            $data = ['message' => $exc->getMessage(), 'line' => $exc->getLine(), 'file' => $exc->getFile()];
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        \common\CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function generateJWTtoken($user) {
        $key = Yii::$app->params['jwtTokenInfo']["key"];
        $token = array(
            "id" => $user->id,
            "email" => $user->email,
            "encPID" => (string) $user->id,
            "randomString" => \common\CommonFunction::generateRandomString(32),
            "iat" => time(),
            "exp" => strtotime(Yii::$app->params['session_expire'], strtotime('now')),
        );
        return JWT::encode($token, $key);
    }

    public function actionRegistration() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        if (isset($request["email"]) && isset($request['first_name']) && isset($request['last_name']) && !empty($request["email"]) && !empty($request["first_name"]) && !empty($request["last_name"])) {
            $model = new JobseekerForm();
            $model->email = $request["email"];
            $model->first_name = $request["first_name"];
            $model->last_name = $request['last_name'];
            if ($model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $user = new User();
                    $user->email = $model->email;
                    $user->type = User::TYPE_JOB_SEEKER;
                    $user->status = User::STATUS_APPROVED;
                    if ($user->save()) {
                        $userDetails = New UserDetails();
                        $userDetails->scenario = 'registration';
                        $userDetails->email = $model->email;
                        $userDetails->first_name = $model->first_name;
                        $userDetails->last_name = $model->last_name;
                        $userDetails->user_id = $user->id;
                        $userDetails->unique_id = $model->getUniqueId();
                        $userDetails->created_at = $userDetails->updated_at = CommonFunction::currentTimestamp();
                        if ($userDetails->save(false)) {
                            $transaction->commit();
                            $resetPasswordModel = new PasswordResetRequestForm();
                            $resetPasswordModel->email = $user->email;
                            $resetPasswordModel->unique_id = $userDetails->unique_id;
                            $is_welcome_mail = 1;
                            $resetPasswordModel->sendEmail($is_welcome_mail);
                            CommonFunction::sendWelcomeMail($user);
                            $code = 200;
                            $msg = "You have registered successfully. Please check your email for verification.";
                        } else {
                            $transaction->rollBack();
                            $code = 202;
                            $msg = "Something went wrong.";
                        }
                    } else {
                        $transaction->rollBack();
                        $code = 202;
                        $msg = "Something went wrong.";
                    }
                } catch (\Exception $exc) {
                    $transaction->rollBack();
                    $code = 500;
                    $msg = "Internal server error";
                    $data = ['message' => $exc->getMessage(), 'line' => $exc->getLine(), 'file' => $exc->getFile()];
                }
            }
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        \common\CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function actionForgotpassword() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();

        if (isset($request["email"]) && !empty($request["email"])) {
            $model = new PasswordResetRequestForm();
            $user = User::find()->where(['email' => $model->email, 'is_suspend' => 0])->andWhere(['!=', 'status', User::STATUS_REJECTED])->one();
            $model->unique_id = $user->details->unique_id;
            $model->email = trim($request["email"]);
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    $code = 200;
                    $msg = "Password reset link sent successfully. Please check your inbox.";
                } else {
                    $code = 404;
                    $msg = "something went wrong, while sending the mail.";
                    Yii::$app->session->setFlash('error', "");
                }
            } else {
                $code = 404;
                $msg = $model->getFirstError('email');
            }
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function actionChangepasswordvalidate() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();

        if (isset($request["password"]) && !empty($request["password"]) && isset($request["new_password"]) && !empty($request["new_password"]) && isset($request["confirm_password"]) && !empty($request["confirm_password"])) {

            $password = $request["password"];
            $new_password = $request["new_password"];
            $confirm_password = $request["confirm_password"];
            $model = new \frontend\models\ChangePasswordForm([], $this->user_id);

            $model->password = $password;
            $model->new_password = $new_password;
            $model->confirm_password = $confirm_password;

            if ($model->validate(['password', 'new_password', 'confirm_password'])) {
                if ($model->sendOTP()) {
                    $code = 200;
                    $msg = "Otp was sent, please check your inbox.";
                } else {
                    $code = 404;
                    $msg = "something went wrong.";
                }
            } else {
                $modelErrors = $model->getErrorSummary(true);
                $code = 404;
                $msg = $modelErrors[0];
            }
        } else {
            $code = 201;
            $msg = "Required Data Missing in Request : password, new_password  or confirm_password";
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

    public function actionChangepassword() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();

        if (isset($request["password"]) && !empty($request["password"]) && isset($request["new_password"]) && !empty($request["new_password"]) && isset($request["confirm_password"]) && !empty($request["confirm_password"]) && isset($request["otp"]) && !empty($request["otp"])) {

            $password = $request["password"];
            $new_password = $request["new_password"];
            $confirm_password = $request["confirm_password"];
            $otp = $request["otp"];
            $model = new \frontend\models\ChangePasswordForm([], $this->user_id);

            $model->password = $password;
            $model->new_password = $new_password;
            $model->confirm_password = $confirm_password;
            $model->is_otp_sent = true;
            $model->otp = $otp;

            if ($model->validate(['password', 'new_password', 'confirm_password', 'otp'])) {

                if ($model->OTPVerified()) {
                    $user = User::findOne($this->user_id);
                    $user->password = Yii::$app->security->generatePasswordHash($model->new_password);
                    $user->original_password = $model->new_password;
                    if ($user->save(false)) {
                        $code = 440;
                        $msg = "Password changed successfully.";
                    } else {
                        $code = 404;
                        $msg = "something went wrong.";
                    }
                } else {
                    $modelErrors = $model->getErrorSummary(true);
                    $code = 404;
                    $msg = $modelErrors[0];
                }
            } else {
                $modelErrors = $model->getErrorSummary(true);
                $code = 404;
                $msg = $modelErrors[0];
            }
        } else {
            $code = 201;
            $msg = "Required Data Missing in Request : password, new_password  onfirm_password ot otp";
        }
        $response = Json::encode(['code' => $code, 'msg' => $msg, "data" => $data]);
        CommonFunction::logger(Yii::$app->request->url, json_encode(Yii::$app->request->bodyParams), json_encode($response));
        echo $response;
        exit;
    }

}