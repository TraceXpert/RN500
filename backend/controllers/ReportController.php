<?php

//

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\models\ReferralMaster;
use yii\helpers\Url;
use yii\base\DynamicModel;
use common\CommonFunction;
use yii\db\Expression;
use yii\db\Query;
use common\models\CompanySubscriptionPayment;
use common\models\LeadRecruiterJobSeekerMapping;

/**
 * RoleController implements the CRUD actions for RoleMaster model.
 */
class ReportController extends Controller {

    public $title = "Report";
    public $activeBreadcrumb, $breadcrumb;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['lead-referral', 'lead-referral-load', 'payment', 'payment-load', 'recruited-jobseeker', 'recruited-jobseeker-load'],
                'rules' => [
                        [
                        'actions' => ['lead-referral', 'lead-referral-load', 'payment', 'payment-load', 'recruited-jobseeker', 'recruited-jobseeker-load'],
                        'allow' => true,
                        'roles' => isset(Yii::$app->user->identity) ? ['@'] : ['*'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'lead-referral-load' => ['POST'],
                    'payment-load' => ['POST'],
                    'recruited-jobseeker-load' => ['POST'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->breadcrumb = [
            'Home' => Url::base(true),
//            $this->title => Yii::$app->urlManagerAdmin->createAbsoluteUrl(['report/index']),
        ];
    }

    /**
     * LEAD REFERRAL REPORT ACTION
     */
    public function actionLeadReferral() {
        $this->activeBreadcrumb = "Report : Lead Referral";
        $filterFormModel = new DynamicModel(['from_date', 'to_date']);
        $filterFormModel->addRule(['from_date', 'to_date'], 'required');
        $filterFormModel->to_date = date('d-M-Y');
        $filterFormModel->from_date = date('d-M-Y', strtotime("-7 days"));
        return $this->render('lead-referral', ['filterFormModel' => $filterFormModel]);
    }

    public function actionLeadReferralLoad() {
        $postData = Yii::$app->request->post('DynamicModel');
        $from_date = isset($postData['from_date']) ? date('Y-m-d', strtotime($postData['from_date'])) . ' 00:00:01' : '';
        $to_date = isset($postData['to_date']) ? date('Y-m-d', strtotime($postData['to_date'])) . ' 23:59:59' : '';
        $models = ReferralMaster::find()->andWhere("created_at BETWEEN '$from_date' AND '$to_date' ")->orderBy(['created_at' => SORT_DESC])->all();
        return $this->renderPartial('lead-referral_load_data', [
                    'models' => $models,
        ]);
    }

    /**
     * PAYMENT REPORT ACTION
     */
    public function actionPayment() {
        $this->activeBreadcrumb = "Report : Payment";
        $filterFormModel = new DynamicModel(['from_date', 'to_date']);
        $filterFormModel->addRule(['from_date', 'to_date'], 'required');
        $filterFormModel->to_date = date('d-M-Y');
        $filterFormModel->from_date = date('d-M-Y', strtotime("-7 days"));
        return $this->render('payment', ['filterFormModel' => $filterFormModel]);
    }

    public function actionPaymentLoad() {
        $data = [];
        try {
            $postData = Yii::$app->request->post('DynamicModel');
            $from_date = isset($postData['from_date']) ? strtotime($postData['from_date'] . ' 00:00:01') : '';
            $to_date = isset($postData['to_date']) ? strtotime($postData['to_date'] . ' 23:59:59') : '';
            $loggedInUserCompanyId = CommonFunction::getLoggedInUserCompanyId();
            $loggedInUserBranchId = CommonFunction::getLoggedInUserBranchId();

            $query = new Query();
            $query->select([
                        "package.title as package",
                        "cs.start_date as pkg_start_date",
                        "cs.expiry_date as pkg_end_date",
                        "lead.reference_no as lead_reference_no",
                        "CONCAT(lead.title, ' ', lead.reference_no) as lead_title",
                        "payment_status" => new Expression("CASE WHEN csp.status = 1 THEN 'Success' ELSE 'Fail' END"),
                        "csp.amount",
                        "csp.customer_transaction_id as transaction_id",
                        "transaction_date" => new Expression("DATE_FORMAT(FROM_UNIXTIME(csp.created_at), '%d %M %Y')"),
                    ])
                    ->from("company_subscription_payment as csp")
                    ->leftJoin("company_subscription as cs", "cs.id = csp.subscription_id")
                    ->leftJoin("package_master as package", "package.id = cs.package_id")
                    ->leftJoin("lead_master as lead", "lead.id = csp.lead_id");
            if (!CommonFunction::isMasterAdmin(Yii::$app->user->id) && CommonFunction::isHoAdmin(Yii::$app->user->id)) {
                $query->andWhere(["cs.company_id" => $loggedInUserCompanyId]);
            } else if (!CommonFunction::isMasterAdmin(Yii::$app->user->id) && !CommonFunction::isHoAdmin(Yii::$app->user->id)) {
                $query->andWhere(["lead.branch_id" => $loggedInUserBranchId]);
            }
            $query->andWhere(["csp.is_free" => CompanySubscriptionPayment::IS_FREE_NO]);

            if ($from_date != '' && $to_date != '') {
                $query->andWhere("csp.created_at BETWEEN '$from_date' AND '$to_date'");
            }

            $data = $query->createCommand()->queryAll();
        } catch (\Exception $ex) {
            $data = [];
        }

        return $this->renderPartial('payment_load_data', [
                    'data' => $data,
        ]);
    }

    /**
     * RECRUITED JOB SEEKER REPORT ACTION  (FILTERS AND EMPLOYER NAME IS PENDING)
     */
    public function actionRecruitedJobseeker() {
        $this->activeBreadcrumb = "Report : Recruited Job Seeker";
        $filterFormModel = new DynamicModel(['from_date', 'to_date']);
        $filterFormModel->addRule(['from_date', 'to_date'], 'required');
        $filterFormModel->to_date = date('d-M-Y');
        $filterFormModel->from_date = date('d-M-Y', strtotime("-7 days"));
        return $this->render('recruited_job_seeker', ['filterFormModel' => $filterFormModel]);
    }

    public function actionRecruitedJobseekerLoad() {
        $data = [];
        try {
            $postData = Yii::$app->request->post('DynamicModel');
            $from_date = isset($postData['from_date']) ? CommonFunction::getAPIDateDisplayFormat($postData['from_date'], 'Y-m-d') : '';
            $to_date = isset($postData['to_date']) ? CommonFunction::getAPIDateDisplayFormat($postData['to_date'], 'Y-m-d') : '';
            $loggedInUserCompanyId = CommonFunction::getLoggedInUserCompanyId();
            $loggedInUserBranchId = CommonFunction::getLoggedInUserBranchId();

            $query = new Query();
            $query->select([
//                        "package.title as package",
//                        "cs.start_date as pkg_start_date",
//                        "cs.expiry_date as pkg_end_date",
//                        "lead.reference_no as lead_reference_no",
//                        "CONCAT(lead.title, ' ', lead.reference_no) as lead_title",
//                        "payment_status" => new Expression("CASE WHEN csp.status = 1 THEN 'Success' ELSE 'Fail' END"),
//                        "csp.amount",
//                        "csp.customer_transaction_id as transaction_id",
//                        "transaction_date" => new Expression("DATE_FORMAT(FROM_UNIXTIME(csp.created_at), '%d %M %Y')"),

                        "CONCAT(job_seeker_detail.first_name, ' ', job_seeker_detail.last_name) as job_seeker_name",
                        "job_seeker.email as job_seeker_email",
                        "CONCAT(lead.title, ' ', lead.reference_no) as lead_title",
                        "recruiter_company.company_name as recruiter",
                        "lrj.rec_joining_date as joining_date",
                        "lead.reference_no as lead_reference_no"
                    ])
                    ->from("lead_recruiter_job_seeker_mapping  as lrj")
                    ->leftJoin("user  as job_seeker", "job_seeker.id = lrj.job_seeker_id")
                    ->leftJoin("user_details  as job_seeker_detail", "job_seeker_detail.user_id = job_seeker.id")
                    ->leftJoin("lead_master as lead", "lead.id = lrj.lead_id")
                    ->leftJoin("company_branch as recruiter_branch", "recruiter_branch.id = lrj.branch_id")
                    ->leftJoin("company_master as recruiter_company", "recruiter_company.id = recruiter_branch.id")
                    ->andWhere(["lrj.employer_status" => LeadRecruiterJobSeekerMapping::STATUS_APPROVED]);

            if (!CommonFunction::isMasterAdmin(Yii::$app->user->id) && CommonFunction::isHoAdmin(Yii::$app->user->id)) {
                $query->andWhere(["lrj.recruiter_company.id" => $loggedInUserCompanyId]);
            } else if (!CommonFunction::isMasterAdmin(Yii::$app->user->id) && !CommonFunction::isHoAdmin(Yii::$app->user->id)) {
                $query->andWhere(["lrj.branch_id" => $loggedInUserBranchId]);
            }

            if ($from_date != '' && $to_date != '') {
                $query->andWhere("lrj.rec_joining_date BETWEEN '$from_date' AND '$to_date'");
            }
            $data = $query->createCommand()->queryAll();
        } catch (\Exception $ex) {
            $data = [];
        }

        return $this->renderPartial('recruited_job_seeker_load_data', [
                    'data' => $data,
        ]);
    }

}
