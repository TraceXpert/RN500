<?php

use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use common\CommonFunction;
use yii\helpers\Url;
use yii\web\JsExpression;

$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
$frontendDir = Yii::$app->urlManagerFrontend->getBaseUrl() . "/uploads/advertisement/";
?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Lead Purchase Detail</h1>
            </div>
        </div>

    </div>
</section>



<section class="about-us about-inner-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 main-title">
                <h2 class="mb-4"><?= $model->title ?></h2>
            </div>
        </div>

        <div class="row view-details mb-4 m-0">
            <div class="col-md-4">
                <p class="mb-0">Date Posted: <?= CommonFunction::getAPIDateDisplayFormat($model->created_at) ?></p>
                <p><?= $model->citiesName ?></p>
            </div>

            <div class="col-md-4">
                <div class="salary-block mt-3 mb-3 mt-md-0 mb-md-0">
                    <p class="mb-0">Salary: $<?= $model->jobseeker_payment ?>/<?= Yii::$app->params['job.payment_type'][$model->payment_type] ?></p>
                </div>
            </div>

            <div class="col-md-4 text-right">
                <a href="javascript:void(0)" id="submit" class="btn apply read-more contact-us mb-0">Pay Now <?= "$" . $model->price ?></a> 
            </div>
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="view-details mb-4 mb-lg-0">
                    <h3 class="job-title">Job Description</h3>

                    <p class="job-black"><?= $model->description ?></p>
                    <?php if (isset($benefit) && !empty($benefit)) { ?>
                        <p class="ul-t">Benifits</p>

                        <ul class="list-unstyled mb-4">
                            <?php foreach ($benefit as $value) { ?>
                                <li><?= $value->benefit->name ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <?php if (isset($discipline) && !empty($discipline)) { ?>
                        <p class="ul-t">Discipline</p>

                        <ul class="list-unstyled mb-4">
                            <?php foreach ($discipline as $value) { ?>
                                <li><?= $value->discipline->name ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <?php if (isset($specialty) && !empty($specialty)) { ?>
                        <p class="ul-t">Specialty</p>

                        <ul class="list-unstyled mb-4">
                            <?php foreach ($specialty as $value) { ?>
                                <li><?= $value->speciality->name ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                    <?php if (isset($emergency) && !empty($emergency)) { ?>
                        <p class="ul-t">Emergency</p>

                        <ul class="list-unstyled mb-4">
                            <?php foreach ($emergency as $value) { ?>
                                <li><?= $value->emergency->name ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="view-details">
                    <h3 class="job-title mb-4">Job Detail</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="ul-right">
                                <li>Job Id</li>
                                <li>Location</li>
                                <li>Job Type</li>
                                <li>Shift</li>
                                <li>Start Date</li>
                                <li>Commission</li>
                                <li>Commission Type</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="ul-right ul-last-child">
                                <li><?= $model->reference_no ?></li>
                                <li><?= isset($model->citiesName) ? $model->citiesName : "-" ?></li>
                                <li><?= isset(Yii::$app->params['job.type'][$model->job_type]) ? Yii::$app->params['job.type'][$model->job_type] : "-" ?></li>
                                <li><?= $model->shift == 1 ? CommonFunction::getAllShiftsCommaSeprated() : Yii::$app->params['job.shift'][$model->shift] ?></li>
                                <li><?= isset($model->start_date) && !empty($model->start_date) ? $model->start_date : "-" ?></li>
                                <li><?= $model->recruiter_commission_type == 1 ? $model->recruiter_commission . "%" : '$' . $model->recruiter_commission ?></li>
                                <li><?= isset(Yii::$app->params['COMMISSION_MODE'][$model->recruiter_commission_mode]) ? Yii::$app->params['COMMISSION_MODE'][$model->recruiter_commission_mode] : "-" ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-12 main-title">
                <h2 class="mb-4">Featured New Advertise </h2>                
            </div>
            <div class="col-sm-3 col-12 main-title">
                <a href="" class="float-right mb-3">View All </a>
            </div>
        </div>


        <div class="row mb-5 pb-5">
            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="<?= $assetDir ?>/img/featured-video.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"></p>                             
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="<?= $assetDir ?>/img/featured-video-1.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"></p>                             
                    </div>
                    <div class="most-popular-jobs-block-hover">
                        <img src="<?= $assetDir ?>/img/play-icon.png" alt="play-icon">
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="<?= $assetDir ?>/img/featured-video-2.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"></p>                             
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="<?= $assetDir ?>/img/featured-video-3.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"></p>                             
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="<?= $assetDir ?>/img/featured-video-4.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"></p>                             
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$secret_id = base64_encode($model->id);
$checkoutSessionUrl = Url::to(['payment/checkoutsession', 'id' => $secret_id]);
$stripeKeyUrl = Url::to(['payment/stripekey']);
$script_new = <<<JS
    var stripe;
    var checkoutSessionId;
    "use strict";
    var setupElements = function () {
        fetch("$stripeKeyUrl", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })
                .then(function (result) {

                    return result.json();
                })
                .then(function (data) {
                    console.log("publicKey",data.publicKey);
                    stripe = Stripe(data.publicKey);

                });
    };

    setupElements();
    document.querySelector("#submit").addEventListener("click", function (evt) {
        evt.preventDefault();
        $.ajax({
            url:"$checkoutSessionUrl",
            type: "get", //request type,
            dataType: 'json',
            data: "",
            success: function (result) {
                checkoutSessionId = result.checkoutSessionId;
                 console.log("key",result.checkoutSessionId);
                 if(checkoutSessionId!=''){
        // Initiate payment
        stripe.redirectToCheckout({
                    sessionId: checkoutSessionId
                }).then(function (result) {
                    alert(result.error.message);
                    console.log("error");
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer
                    // using `result.error.message`.
                }).catch(function (err) {
                    console.log(err);
                    alert(err);
                });
        }
            }
        });
    });
JS;
$this->registerJS($script_new);
