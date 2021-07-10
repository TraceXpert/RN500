<?php
/* @var $this yii\web\View */

use common\CommonFunction;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\rating\StarRating;
use kartik\icons\FontAwesomeAsset;
use common\models\Advertisement;

FontAwesomeAsset::register($this);

$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>

<section class="main-banner align-items-end d-flex">
    <div class="container">
        <div class="row text-center">
            <div class="col-xl-12">
                <h1 class="mb-4">
                    Find Your Jobs
                </h1>                                    
            </div> 
        </div>

        <div class="row filter-block mb-4">
            <div class="col-xl-12 col-lg-12">
                <form class="d-flex" action="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/index']) ?>" method="GET">
                    <div class="col-md-5 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/search-icon.png" alt="search-icon"><input type="text" class="form-control br-1" name="title" id="lead_title" placeholder="Search Open Jobs">
                        </div>
                    </div>
                    <div class="col-md-5 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <?php
                            $url = Url::to(['browse-jobs/get-cities']);
                            echo Select2::widget([
                                'name' => 'location',
                                'options' => [
                                    'id' => 'choose-city',
                                    'placeholder' => 'Select Location...',
                                    'multiple' => true,
                                    'class' => 'form-control br-1 select2-hidden-accessible'
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


<section class="marquee-text p-0 d-flex align-items-center">
    <marquee width="100%" direction="left">
        <ul style="display: flex;flex-direction: row;justify-content:space-around;">
            <?php foreach ($banner as $value) { ?>
                <li style='margin-left: 4%;'><?= $value->headline ?></li>
            <?php } ?>
        </ul>  
    </marquee>
</section>




<section class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 main-title">
                <h2 class="mb-4">About Us</h2>

                <p class="text-justify">
                    RN500 is founded by the people who believed they could change the travel nursing industry for
                    better than before with huge revolutionary technology options. This vision, along with culture
                    of honesty, transparency and great customer services, continues to guide our growth. Simplify
                    the Process: Use your unique skill to make the complex easy. Own Your Relationships: Engage with
                    others clarity, transparency and care. Obsess Over the Experience: Distinguish yourself by
                    providing the best possible experience every time.
                </p>

                <a href="" class="read-more">Read More</a>
            </div>

            <div class="col-lg-6">
                <img src="<?= $assetDir ?>/img/about-us.png" alt="about-us" class="img-fluid mx-auto d-block mt-4">
            </div>
        </div>
    </div>
</section>



<section class="most-popular-jobs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main-title about-us text-center">
                <h2 class="mb-4">Most Popular Jobs</h2>

                <p class="mb-5">RN500 is founded by the people who believed they could change the travel nursing industry</p>
            </div>
        </div>

        <div class="row">
            <?php foreach ($leadModels as $model) { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="most-popular-jobs-block">
                        <div class="jobs-details">
                            <p><img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2"> <?= $model->citiesName ?></p>
                            <h3 class="mb-3"><?= $model->title ?></h3>
                            <small>Shift : <?= $model->shift == 1 ? implode(',', array_values(Yii::$app->params['job.shift'])) : Yii::$app->params['job.shift'][$model->shift] ?></small>
                            <small>Response Time: within a day</small>
                            <small>Estimated Pay: $<?= $model->jobseeker_payment ?>/<?= Yii::$app->params['job.payment_type'][$model->payment_type] ?></small>
                            <?php if (isset($model->emergency) && !empty($model->emergency)) { ?>
                                <span class="badge badge-warning">Urgent</span>
                            <?php } ?>
                            <span class="badge badge-success"><?= Yii::$app->params['job.type'][$model->job_type] ?></span>
                        </div>
                        <div class="rating">
                            <div class="media">
                                <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                <div class="media-body">
                                    <p class="mb-0">Rattings</p>
                                    <?=
                                    StarRating::widget([
                                        'name' => 'rating_35',
                                        'value' => $model->avgRating,
                                        'pluginOptions' => ['displayOnly' => true,   'showCaption' => false,]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="most-popular-jobs-block-hover">
                            <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/view', 'id' => $model->reference_no]) ?>" class="text">View Profile</a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/index']) ?>" class="read-more mt-4">View More</a>
            </div>
        </div>
    </div>
</section>



<section class="industry-logo">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main-title text-center">
                <h2 class="mb-4">Industry Leaders</h2>

                <p class="mb-5">Sponsors of The Future Career</p>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/slack.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/netflix.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/fitbit.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/google.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/airbnb.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/uber.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/slack.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/netflix.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/fitbit.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/google.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/airbnb.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <img src="<?= $assetDir ?>/img/uber.png" alt="about-us" class="img-fluid mx-auto d-block">
            </div>
        </div>

    </div>
</section>





<section class="most-popular-jobs popular-searches">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main-title about-us text-center">
                <h2 class="mb-4">Popular Searches</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 offset-lg-1 col-md-4 col-6">
                <ul class="list-unstyled">
                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg> Alabama
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg> Alaska
                    </li>


                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg> Arizona
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Arkansas
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>California
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Colorado
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Connecticut
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Delaware
                    </li>
                </ul>                    
            </div>


            <div class="col-lg-3 offset-lg-1 col-md-4 col-6">
                <ul class="list-unstyled">
                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Florida
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Georgia
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Hawaii
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Idaho 
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Illinois
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Indiana
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Iowa
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Kansas
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 offset-lg-1 col-md-4 col-6">
                <ul class="list-unstyled">
                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Kentucky
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Louisiana
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Maine
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Maryland
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Massachusetts
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Michigan
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Minnesota
                    </li>

                    <li>
                        <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                        <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                        </svg>Mississippi
                    </li>
                </ul>
            </div>

            <!--            <div class="col-lg-3 offset-lg-1 col-md-4 col-6">
                            <ul class="list-unstyled">
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>Missouri
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>Montana
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>Nebraska
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>Nevada
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>New Hampshire
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>New Jersey
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>New Mexico
                                </li>
            
                                <li>
                                    <svg class="mr-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15" cy="15" r="15" fill="#DADADA"/>
                                    <path d="M13.9375 9.09375C13.625 9.40625 13.6562 9.875 13.9375 10.1875L17.7188 13.75H8.75C8.3125 13.75 8 14.0938 8 14.5V15.5C8 15.9375 8.3125 16.25 8.75 16.25H17.7188L13.9375 19.8438C13.6562 20.1562 13.6562 20.625 13.9375 20.9375L14.625 21.625C14.9375 21.9062 15.4062 21.9062 15.6875 21.625L21.7812 15.5312C22.0625 15.25 22.0625 14.7812 21.7812 14.4688L15.6875 8.40625C15.4062 8.125 14.9375 8.125 14.625 8.40625L13.9375 9.09375Z" fill="white"/>
                                    </svg>New York
                                </li>
                            </ul>
                        </div>-->
        </div>
    </div>
</section>




<section class="cta">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 main-title">
                <h2 class="mb-0">
                    Let’s build something <br>new with RN500
                </h2>
            </div>

            <div class="col-md-6 text-right">
                <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/contact-us']) ?>" class="read-more contact-us mr-3">Contact Us</a>
                <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/index']) ?>" class="read-more find-job">Find Job 
                    <svg class="ml-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.9375 1.09375C5.625 1.40625 5.65625 1.875 5.9375 2.1875L9.71875 5.75H0.75C0.3125 5.75 0 6.09375 0 6.5V7.5C0 7.9375 0.3125 8.25 0.75 8.25H9.71875L5.9375 11.8438C5.65625 12.1562 5.65625 12.625 5.9375 12.9375L6.625 13.625C6.9375 13.9062 7.40625 13.9062 7.6875 13.625L13.7812 7.53125C14.0625 7.25 14.0625 6.78125 13.7812 6.46875L7.6875 0.40625C7.40625 0.125 6.9375 0.125 6.625 0.40625L5.9375 1.09375Z" fill="white"/>
                    </svg>                            
                </a>
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
                    <a href="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['advertisement/all']); ?>" class="float-right mb-3">View All </a>
                </div>
            </div>


            <div class="row mb-5 pb-5">
                <?php foreach ($advertisments as $key => $ads) { ?> 
                    <?php $adsName = (strlen($ads->name) > 30) ? substr($ads->name, 0, 30) . ' ...' : $ads->name ?> 
                    <div class="col-md-4">
                        <div class="featured-img-block position-relative mb-4">
                            <?php if ($ads->file_type == Advertisement::FILE_TYPE_YOUTUBE_LINK) { ?>
                                <iframe width="100%"  height="195" src="<?php echo $ads->getYoutubeEmbedUrl() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="max-height-ads-home"></iframe>
                                <div class="ads-title">
                                    <p class="mb-0"><?php echo $adsName ?> <a href="<?php echo $ads->link_url ?>" target="_blank"> <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"> </a></p>                             
                                </div>

                            <?php } else { ?>

                                <?php if ($ads != '' && file_exists(CommonFunction::getAdvertisementBasePath() . DIRECTORY_SEPARATOR . $ads->icon)) { ?>
                                    <img src="<?= CommonFunction::getAdvertisementBaseUrl() . DIRECTORY_SEPARATOR . $ads->icon ?>" alt="<?php echo $ads->icon ?>" class="img-fluid mx-auto d-block max-height-ads-home w-100">
                                <?php } else { ?>
                                    <img src="<?= $assetDir ?>/img/featured-video-2.png" alt="featured-video" class="img-fluid mx-auto d-block max-height-ads-home">
                                <?php } ?>
                                <div class="ads-title">
                                    <p class="mb-0"> <?php echo $adsName ?> <a href="<?php echo $ads->link_url ?>" target="_blank"> <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"> </a></p>                             
                                </div>

                            <?php } ?>
                        </div>
                    </div>


                <?php } ?>

            </div>
        </div>
    </section>