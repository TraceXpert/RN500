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
use common\models\LeadMaster;
use common\models\Benefits;
use common\models\Speciality;
use common\models\Discipline;
use common\models\Cities;
use common\models\LeadBenefit;
use common\models\LeadDiscipline;
use common\models\LeadSpeciality;
use common\models\ReferralMaster;

/**
 * Company Controller API
 */
class BrowseJobsController extends Controller {

    public $modelClass = 'common\models\LeadMaster';

    public function actionDisciplines() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $paging = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $disciplinList = [];
            $query = Discipline::find();
            $total_pages = (ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])) ? ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT']) : 1;
            if ($paging <= $total_pages) {
                $query->offset(($paging - 1) * Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])->limit(Yii::$app->params['API_PAGINATION_RECORD_LIMIT']);
                $lists = $query->all();
                foreach ($lists as $value) {
                    $disciplinList[] = ['id' => $value->id, 'name' => $value->name];
                }
            }
            $code = 200;
            $msg = "Success";
            $data = ['discipline' => $disciplinList];
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

    public function actionBenefits() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $paging = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $benfitsList = [];
            $query = Benefits::find();
            $total_pages = (ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])) ? ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT']) : 1;
            if ($paging <= $total_pages) {
                $query->offset(($paging - 1) * Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])->limit(Yii::$app->params['API_PAGINATION_RECORD_LIMIT']);
                $lists = $query->all();
                foreach ($lists as $value) {
                    $benfitsList[] = ['id' => $value->id, 'name' => $value->name];
                }
            }
            $code = 200;
            $msg = "Success";
            $data = ['benefits' => $benfitsList];
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

    public function actionSpecialty() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $paging = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $specialtyList = [];
            $query = Speciality::find();
            $total_pages = (ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])) ? ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT']) : 1;
            if ($paging <= $total_pages) {
                $query->offset(($paging - 1) * Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])->limit(Yii::$app->params['API_PAGINATION_RECORD_LIMIT']);
                $lists = $query->all();
                foreach ($lists as $value) {
                    $specialtyList[] = ['id' => $value->id, 'name' => $value->name];
                }
            }
            $code = 200;
            $msg = "Success";
            $data = ['specialty' => $specialtyList];
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

    public function actionCities() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $paging = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $search = (isset($request['filter']) && !empty($request['filter'])) ? trim($request['filter']) : '';
            $citiesList = [];
            $query = Cities::find();
            if (!empty($search)) {
                $query->andWhere(['LIKE', 'city', $search."%", false]);
            }
            $total_pages = (ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])) ? ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT']) : 1;
            if ($paging <= $total_pages) {
                $query->offset(($paging - 1) * Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])->limit(Yii::$app->params['API_PAGINATION_RECORD_LIMIT']);
                $lists = $query->all();
                foreach ($lists as $value) {
                    $citiesList[] = ['id' => $value->id, 'name' => $value->city . "-" . $value->state_code];
                }
            }
            $code = 200;
            $msg = "Success";
            $data = ['cities' => $citiesList];
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

    public function actionSalary() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $salaryList[] = ['id' => 1, 'value' => '0 to $100'];
            $salaryList[] = ['id' => 2, 'value' => '$100 to $199'];
            $salaryList[] = ['id' => 3, 'value' => '$199 to $499'];
            $salaryList[] = ['id' => 4, 'value' => '$499 to $999'];
            $salaryList[] = ['id' => 5, 'value' => '$999 to $4999'];
            $salaryList[] = ['id' => 6, 'value' => 'Above $4999'];
            $code = 200;
            $msg = "Success";
            $data = ['salary' => $salaryList];
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

    public function actionLeads() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = Yii::$app->request->post();
        try {
            $paging = (isset($request['page']) && $request['page'] != '' && $request['page'] != 0) ? $request['page'] : 1;
            $search = (isset($request['search']) && !empty($request['search'])) ? $request['search'] : "";
            $limitForDashboard = (isset($request['limit_for_dashboard']) && $request['limit_for_dashboard'] != '') ? $request['limit_for_dashboard'] : "";

            $query = LeadMaster::find()->joinWith(['benefits', 'disciplines', 'specialty', 'branch'])->where(['lead_master.status' => LeadMaster::STATUS_APPROVED, 'lead_master.is_suspended' => LeadMaster::IS_SUSPENDED_NO]);
            if (!empty($search)) {
                $query->andWhere(['OR', ['like', 'lead_master.title', $search], ['like', 'lead_master.reference_no', $search]]);
            }
            if (isset($request['discipline']) && !empty($request['discipline'])) {
                $query->andWhere(['IN', 'lead_discipline.discipline_id', implode(',', $request['discipline'])]);
            }
            if (isset($request['speciality']) && !empty($request['speciality'])) {
                $query->andWhere(['IN', 'lead_speciality.speciality_id', implode(',', $request['speciality'])]);
            }
            if (isset($request['benefit']) && !empty($request['benefit'])) {
                $query->andWhere(['IN', 'lead_benefit.benefit_id', implode(',', $request['benefit'])]);
            }
            if (isset($request['location']) && !empty($request['location'])) {
                $query->andWhere(['IN', 'lead_master.city', implode(',', $request['location'])]);
            }
            if (isset($request['salary']) && !empty($request['salary'])) {
                foreach ($request['salary'] as $value) {
                    if ($value == 1) {
                        $query->andWhere(['>=', 'jobseeker_payment', 0]);
                        $query->andWhere(['<=', 'jobseeker_payment', 100]);
                    }
                    if ($value == 2) {
                        $query->andWhere(['>=', 'jobseeker_payment', 100]);
                        $query->andWhere(['<=', 'jobseeker_payment', 199]);
                    }
                    if ($value == 3) {
                        $query->andWhere(['>=', 'jobseeker_payment', 199]);
                        $query->andWhere(['<=', 'jobseeker_payment', 499]);
                    }
                    if ($value == 4) {
                        $query->andWhere(['>=', 'jobseeker_payment', 499]);
                        $query->andWhere(['<=', 'jobseeker_payment', 999]);
                    }
                    if ($value == 5) {
                        $query->andWhere(['>=', 'jobseeker_payment', 999]);
                        $query->andWhere(['<=', 'jobseeker_payment', 4999]);
                    }
                    if ($value == 6) {
                        $query->andWhere(['>=', 'jobseeker_payment', 4999]);
                    }
                }
            }
            $query->groupBy(['lead_master.id']);
            $query->orderBy(['lead_master.created_at' => SORT_DESC]);
            $leadList = [];
            $total_pages = (ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])) ? ceil($query->count() / Yii::$app->params['API_PAGINATION_RECORD_LIMIT']) : 1;
            if ($paging <= $total_pages || $limitForDashboard != '') {
                if ($limitForDashboard != '') {
                    $query->limit($limitForDashboard);
                } else {
                    $query->offset(($paging - 1) * Yii::$app->params['API_PAGINATION_RECORD_LIMIT'])->limit(Yii::$app->params['API_PAGINATION_RECORD_LIMIT']);
                }
                $lists = $query->all();

                foreach ($lists as $value) {
                    $leadList[] = [
                        'id' => $value->id,
                        'reference_no' => $value->reference_no,
                        'title' => $value->title,
                        'location' => $value->citiesName,
                        'posted_at' => CommonFunction::dateDiffInDays($value->created_at),
                        'estimated_pay' => "$" . $value->jobseeker_payment . "/" . Yii::$app->params['job.payment_type'][$value->payment_type],
                        'start_date' => $value->start_date,
                        'shift' => $value->shift == 1 ? CommonFunction::getAllShiftsCommaSeprated() : Yii::$app->params['job.shift'][$value->shift],
                        'job_type' => Yii::$app->params['job.type'][$value->job_type],
                        'description' => $value->description,
                        'rating' => $value->getAvgRating(),
                        'sharing_url' => $value->getSharableUrl()
                    ];
                }
            }
            $code = 200;
            $msg = "Success";
            $data = ['lead' => $leadList];
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

    public function actionViews($id) {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = [];
        try {
            $model = LeadMaster::findOne(['id' => $id]);
            if ($model != null) {
                $benefit = LeadBenefit::findAll(['lead_id' => $id]);
                $specialty = LeadSpeciality::findAll(['lead_id' => $id]);
                $discipline = LeadDiscipline::findAll(['lead_id' => $id]);
                $blist = $slist = $dlist = [];
                foreach ($benefit as $value) {
                    $blist[] = $value->benefit->name;
                }
                foreach ($specialty as $value) {
                    $slist[] = $value->speciality->name;
                }
                foreach ($discipline as $value) {
                    $dlist[] = $value->discipline->name;
                }
                $code = 200;
                $msg = "Success";
                $data = [
                    'title' => $model->title,
                    'created_at' => CommonFunction::getAPIDateDisplayFormat($model->created_at),
                    'location' => $model->citiesName,
                    'salary' => $model->jobseeker_payment,
                    'salary_type' => Yii::$app->params['job.payment_type'][$model->payment_type],
                    'description' => $model->description,
                    'benefit' => $blist,
                    'specialty' => $slist,
                    'discipline' => $dlist,
                    'reference_no' => $model->reference_no,
                    'employment_status' => Yii::$app->params['job.type'][$model->job_type],
                    'shift' => $model->shift == 1 ? CommonFunction::getAllShiftsCommaSeprated() : Yii::$app->params['job.shift'][$model->shift],
                    'rating' => $model->getAvgRating(),
                    'sharing_url' => $model->getSharableUrl(),
                    'city_id' => $model->city,
                    'city_name' => $model->getCitiesName()
                ];
            } else {
                $code = 202;
                $msg = "Lead with such reference does not exists.";
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

    public function actionReferToFriend() {
        $data = [];
        $code = 201;
        $msg = "Required Data Missing in Request.";
        $request = array_map("trim", Yii::$app->request->post());
       
        try {
            $reference_no = (isset($request['reference_no']) && !empty($request['reference_no'])) ? $request['reference_no'] : '';
            $from_name = (isset($request['from_name']) && !empty($request['from_name'])) ? $request['from_name'] : '';
            $from_email = (isset($request['from_email']) && !empty($request['from_email'])) ? $request['from_email'] : '';
            $description = (isset($request['description']) && !empty($request['description'])) ? $request['description'] : null;
            $to_name = (isset($request['to_name']) && !empty($request['to_name'])) ? $request['to_name'] : '';
            $to_email = (isset($request['to_email']) && !empty($request['to_email'])) ? $request['to_email'] : '';

      
            if ($reference_no != '' && $from_name != '' && $from_email != '' && $to_name != '' && $to_email != '') {
                $lead = LeadMaster::find()->where(['reference_no' => $reference_no])->one();

                if ($lead != null) {
                    $model = new ReferralMaster();
                    $model->load(Yii::$app->request->post());
                    $model->lead_id =$lead->id;
                    $model->from_name =$from_name;
                    $model->from_email =$from_email;
                    $model->to_name =$to_name;
                    $model->to_email = $to_email;
                    $model->description = $description;
                         
                    if ($model->sendReferralMail()) {
                        $code = 200;
                        $msg = 'Referral mail sent successfully.';
                        $data = [];
                    } else {
                        $code = 205;
                        $msg = 'Something went wrong, please try after some time.';
                        $data = [];
                    }
                } else {
                    $code = 202;
                    $msg = "Lead with such reference does not exists.";
                    $data = [];
                }
            } else {
                $data = [];
                $code = 201;
                $msg = "Required Data Missing in Request : reference_no , from_name , from_email , description , to_name or to_email ";
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

}
