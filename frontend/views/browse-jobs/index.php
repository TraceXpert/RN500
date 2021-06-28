<?php

//use Yii;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use common\CommonFunction;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\rating\StarRating;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>
<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Find Your Jobs</h1>
            </div>
        </div>
    </div>
</section>



<section class="about-us browse-search pb-5">
    <div class="container">

        <div class="row filter-block">
            <div class="col-xl-12 col-lg-12">
                <form class="d-flex" method="GET">
                    <div class="col-md-4 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/search-icon.png" alt="search-icon"><input type="text" class="form-control br-1" name="title" id="lead_title" value="<?= isset($_GET['title']) && !empty($_GET['title']) ? $_GET['title'] : "" ?>" placeholder="Search Open Jobs">
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <?php
                            $url = Url::to(['browse-jobs/get-cities']);
                            echo Select2::widget([
                                'name' => 'location',
                                'value' => array_keys($selectedLocations),
                                'initValueText' => array_values($selectedLocations),
                                'options' => [
                                    'id' => 'choose-city',
                                    'placeholder' => 'Select Location...',
                                    'multiple' => true,
                                    'class' => 'form-control select2-hidden-accessible'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 1,
                                    'ajax' => [
                                        'url' => $url,
                                        'dataType' => 'json',
                                        'data' => new JsExpression('function(params) {return {q:params.term, page:params.page || 1}; }'),
                                        'cache' => true,
                                    ],
                                    'escapeMarkup' => new JsExpression('function (markup) {return markup; }'),
                                    'templateResult' => new JsExpression('function(location) {return "<b>"+location.name+"</b>"; }'),
                                    'templateSelection' => new JsExpression('function (location) {
                                        console.log(location);
                                if(location.selected==true){
                                    return location.text; 
                                }else{
                                    return location.name;
                                }
                            }'),
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary full-width">Search Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="most-popular-jobs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="filter-accordion">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                    Discipline
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="checkbox" id="one" checked>
                                            <label for="one">RN</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="two" checked>
                                            <label for="two">Allied Health Professional</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Therapy</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">School Services</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">LPN / LVN</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Social Work</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">CNA</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Advance Practice</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">CMA</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                    Specialty
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="checkbox" id="one" checked>
                                            <label for="one">Med Surg</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="two" checked>
                                            <label for="two">OR - Operating Room</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Med Surg / Telemetry</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">ICU - Intensive Care unit</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Medical Lab Tech</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Speech Language </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Pathologist</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">ED - Emergency </label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">DepartmentTelemetry</label>
                                        </div>

                                        <div class="view-more">View More</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                    Emergency
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                                    Shift
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                                    Benefits
                                </a>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                                    Salary Range
                                </a>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <?php foreach ($models as $model) { ?>
                    <div class="job-details">
                        <div class="title-location">
                            <div class="row m-0 job-d">
                                <div class="col-md-6 p-0">
                                    <p class="job-title mb-0"><?= $model->title ?></p>
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                        <div class="media-body">
                                            <?= $model->citiesName ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right mt-2 mt-sm-0">
                                    <!--<span class="badge badge-warning">Urgent</span>-->
                                    <span class="badge badge-success"><?= Yii::$app->params['job.type'][$model->job_type] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 job-d">
                            <div class="col-md-4 mt-3">
                                <div>
                                    <p class="mb-0 small-text">Shift :</p>
                                    <p><?= $model->shift == 1 ? "Morning, Evening, Night, Flexible" : Yii::$app->params['job.shift'][$model->shift] ?></p>
                                </div>
                                <div>
                                    <p class="mb-0 small-text">Estimated Pay</p>
                                    <p>$<?= $model->jobseeker_payment ?>/<?= Yii::$app->params['job.payment_type'][$model->payment_type] ?></p>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div>
                                    <p class="mb-0 small-text">Response Time:</p>
                                    <p>within a day</p>
                                </div>
                                <div>
                                    <p class="mb-0 small-text">Posted by</p>
                                    <p><?= CommonFunction::dateDiffInDays($model->created_at) == 0 ? "Today" : CommonFunction::dateDiffInDays($model->created_at) . " days ago"; ?></p>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <div>
                                    <p class="mb-0 small-text">Starting Date :</p>
                                    <p><?= date('m-d-Y', strtotime($model->start_date)); ?></p>
                                </div>
                                <div>
                                    <p class="mb-0 small-text">Benefits starts from</p>
                                    <p>Day 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="rating">

                            <div class="row m-0 job-d">
                                <div class="col-sm-6 p-0">
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                        <div class="media-body">
                                            <p class="mb-0">Rattings</p>
                                            <?=
                                            StarRating::widget([
                                                'name' => 'rating_35',
                                                'value' => $model->avgRating,
                                                'pluginOptions' => ['displayOnly' => true]
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 p-0 text-right">
                                    <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/view', 'id' => $model->id]) ?>" class="read-more contact-us mb-0">View Profile</a>
                                </div>


                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</section>