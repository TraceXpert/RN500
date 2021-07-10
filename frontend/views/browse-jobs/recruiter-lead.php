<?php

//use Yii;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use common\CommonFunction;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\rating\StarRating;
use kartik\icons\FontAwesomeAsset;

FontAwesomeAsset::register($this);

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
$shift_prams = isset($_GET['shift']) ? $_GET['shift'] : [];
?>
<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Find Your Leads</h1>
            </div>
        </div>
    </div>
</section>



<section class="about-us browse-search pb-5">
    <div class="container">
        <div class="row filter-block">
            <div class="col-xl-12 col-lg-12">
                <form class="d-flex" method="GET">
                    <div class="col-md-5 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/search-icon.png" alt="search-icon"><input type="text" class="form-control br-1" name="title" id="lead_title" value="<?= isset($_GET['title']) && !empty($_GET['title']) ? $_GET['title'] : "" ?>" placeholder="Search Open Jobs">
                        </div>
                    </div>
                    <div class="col-md-5 p-0">
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
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                    Emergency
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body" id="emergency">
                                    <form method="GET">
                                        <div id="options"></div>
                                        <div class='view-more'></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                    Discipline
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                <div class="card-body" id="discipline">
                                    <form method="GET">
                                        <div id="options"></div>
                                        <div class='view-more'></div>
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
                                <div class="card-body" id="speciality">
                                    <form method="GET">
                                        <div id="options"></div>
                                        <div class='view-more'></div>
                                    </form>
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
                                <div class="card-body" id="benefit">
                                    <form>
                                        <div id="options"></div>
                                        <div class='view-more'></div>
                                    </form>
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
                                <div class="card-body" id="shift">
                                    <form>
                                        <div id="options">
                                            <?php if (in_array(1, $shift_prams)) { ?>
                                                <div class="form-group"><input type="checkbox" value="1" name="shift[]" id="shift-1" checked><label for="shift-1">Morning</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="1" name="shift[]" id="shift-1"><label for="shift-1">Morning</label></div>

                                            <?php } ?>
                                            <?php if (in_array(2, $shift_prams)) { ?>
                                                <div class="form-group"><input type="checkbox" value="2" name="shift[]" id="shift-2" checked><label for="shift-2">Evening</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="2" name="shift[]" id="shift-2"><label for="shift-2">Evening</label></div>
                                            <?php } ?>
                                            <?php if (in_array(3, $shift_prams)) { ?>
                                                <div class="form-group"><input type="checkbox" value="3" name="shift[]" id="shift-3" checked><label for="shift-3">Night</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="3" name="shift[]" id="shift-3"><label for="shift-3">Night</label></div>
                                            <?php } ?>
                                            <?php if (in_array(4, $shift_prams)) { ?>
                                                <div class="form-group"><input type="checkbox" value="4" name="shift[]" id="shift-4" checked><label for="shift-4">Flexible</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="4" name="shift[]" id="shift-4"><label for="shift-4">Flexible</label></div>
                                            <?php } ?>
                                        </div>
                                        <div class='view-more'></div>
                                    </form>
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
                                <div class="card-body" id="salary">
                                    <form>
                                        <div id="options">
                                            <?php if (isset($_GET['salary']) && in_array(1, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="1" name="salary[]" id="salary-1" checked><label for="shift-1">0 to $100</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="1" name="salary[]" id="salary-1"><label for="shift-1">0 to $100</label></div>

                                            <?php } ?>
                                            <?php if (isset($_GET['salary']) && in_array(2, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="2" name="salary[]" id="salary-2" checked><label for="shift-2">$100 to $199</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="2" name="salary[]" id="salary-2"><label for="shift-2">$100 to $199</label></div>
                                            <?php } ?>
                                            <?php if (isset($_GET['salary']) && in_array(3, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="3" name="salary[]" id="salary-3" checked><label for="shift-3">$199 to $499</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="3" name="salary[]" id="salary-3"><label for="shift-3">$199 to $499</label></div>
                                            <?php } ?>
                                            <?php if (isset($_GET['salary']) && in_array(4, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="4" name="salary[]" id="salary-4" checked><label for="shift-4">$499 to $999</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="4" name="salary[]" id="salary-4"><label for="shift-4">$499 to $999</label></div>
                                            <?php } ?>
                                            <?php if (isset($_GET['salary']) && in_array(5, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="5" name="salary[]" id="salary-5" checked><label for="shift-4">$999 to $4999</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="5" name="salary[]" id="salary-5"><label for="shift-4">$999 to $4999</label></div>
                                            <?php } ?>
                                            <?php if (isset($_GET['salary']) && in_array(6, $_GET['salary'])) { ?>
                                                <div class="form-group"><input type="checkbox" value="6" name="salary[]" id="salary-6" checked><label for="shift-4">Above $4999</label></div>
                                            <?php } else { ?>
                                                <div class="form-group"><input type="checkbox" value="6" name="salary[]" id="salary-6"><label for="shift-4">Above $4999</label></div>
                                            <?php } ?>
                                        </div>
                                        <div class='view-more'></div>
                                    </form>
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
                                    <?php if (isset($model->emergency) && !empty($model->emergency)) { ?>
                                        <span class="badge badge-warning">Urgent</span>
                                    <?php } ?>
                                    <span class="badge badge-success"><?= Yii::$app->params['job.type'][$model->job_type] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 job-d">
                            <div class="col-md-4 mt-3">
                                <div>
                                    <p class="mb-0 small-text">Shift :</p>
                                    <p><?= $model->shift == 1 ? CommonFunction::getAllShiftsCommaSeprated() : Yii::$app->params['job.shift'][$model->shift] ?></p>
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
                                    <p><?= CommonFunction::getAPIDateDisplayFormat($model->start_date); ?></p>
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
                                            <p class="mb-0">Rating</p>
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
                                    <?php if (!CommonFunction::isExpired() || in_array($model->id, CommonFunction::getAllPurchasedLead()) || CommonFunction::getLoggedInUserCompanyId() == 1 || (isset($model->branch->company_id) && $model->branch->company_id == CommonFunction::getLoggedInUserCompanyId())) { ?>
                                        <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/recruiter-view', 'id' => $model->reference_no]) ?>" class="read-more contact-us mb-0">View Profile</a>
                                    <?php } else { ?>
                                        <?php if (CommonFunction::isVisibleLead($model->approved_at)) { ?>
                                            <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['payment/index', 'id' => $model->id]) ?>" class="read-more contact-us mb-0">Buy Now <?= "$" . $model->price ?></a>
                                        <?php } else {
                                            ?>
                                            <a href="javascript:void(0)" class="read-more contact-us mb-0">Coming Soon</a>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>


                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</section>
<?php
$discipline_prams = isset($_GET['discipline']) ? implode(',', $_GET['discipline']) : '';
$specialty_prams = isset($_GET['speciality']) ? implode(',', $_GET['speciality']) : '';
$benefits_prams = isset($_GET['benefit']) ? implode(',', $_GET['benefit']) : '';
$emergency_prams = isset($_GET['emergency']) ? implode(',', $_GET['emergency']) : '';
$get_discipline_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-discipline']);
$get_specialty_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-specialty']);
$get_benefits_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-benefits']);
$get_emergency_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-emergency']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
$script_new = <<<JS
getDisciplineRecords();
getSpecialtyRecords();
getBenefitsRecords();
getEmergencyRecords();
        
    function getDisciplineRecords(pageno=0) {
        let params='$discipline_prams';
        let availabel=pageno;
        $.post("$get_discipline_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
            let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#discipline form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#discipline form .view-more").append("<a href='javascript:void(0)' id='discipline-viewmore' onClick='getDisciplineRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#discipline  form #options").append(data.options);
               $("#discipline-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#discipline form .view-more").append("<a href='javascript:void(0)' id='discipline-viewmore' onClick='getDisciplineRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getSpecialtyRecords(pageno=0) {
        let params='$specialty_prams';
        let availabel=pageno;
        $.post("$get_specialty_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#speciality form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#speciality form .view-more").append("<a href='javascript:void(0)' id='speciality-viewmore' onClick='getSpecialtyRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#speciality form #options").append(data.options);
               $("#speciality-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#speciality form .view-more").append("<a href='javascript:void(0)' id='speciality-viewmore' onClick='getSpecialtyRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getEmergencyRecords(pageno=0) {
        let params='$emergency_prams';
        let availabel=pageno;
        $.post("$get_emergency_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#emergency form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#emergency form .view-more").append("<a href='javascript:void(0)' id='emergency-viewmore' onClick='getEmergencyRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#emergency form #options").append(data.options);
               $("#emergency-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#emergency form .view-more").append("<a href='javascript:void(0)' id='emergency-viewmore' onClick='getEmergencyRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getBenefitsRecords(pageno=0) {
        let params='$benefits_prams';
        let availabel=pageno;
        $.post("$get_benefits_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#benefit form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#benefit form .view-more").append("<a href='javascript:void(0)' id='benefit-viewmore' onClick='getBenefitsRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#benefit form #options").append(data.options);
               $("#benefit-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#benefit form .view-more").append("<a href='javascript:void(0)' id='benefit-viewmore' onClick='getBenefitsRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
JS;
$this->registerJS($script_new, 3);
?>