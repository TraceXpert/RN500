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


<nav class="navbar navbar-expand-lg bg-white navbar-dark fixed-top">
    <div class="container">

        <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo" class="img-fluid logo-w"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item position-relative">
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link" href="about-us.html">About Us</a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link" href="browse-jobs.html">Browse Job</a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link" href="contact-us.html">Contact</a>
                </li>
                <li class="nav-item active position-relative">
                    <a class="nav-link" href="advertise.html">Advertise</a>
                </li>
                <li class="nav-item position-relative d-flex align-items-center">
                    <a href="login.html"
                       class="btn btn-primary readmore ml-md-3 ml-0 mb-3 mb-md-0 mt-2 mt-md-0">Sign In /
                        Sign Up</a>
                </li>
            </ul>
        </div>

    </div>
</nav>


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
                <form class="d-flex">
                    <div class="col-md-4 p-0">
                        <div class="form-group">
                            <img src="img/search-icon.png" alt="search-icon"><input type="text"
                                                                                    class="form-control br-1" id="joblist" placeholder="Search Open Jobs">
                        </div>
                    </div>
                    <div class="col-md-3 p-0">
                        <div class="form-group">
                            <img src="img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <select id="choose-city" class="form-control select2-hidden-accessible"
                                    data-select2-id="City Name" tabindex="-1" aria-hidden="true">
                                <option data-select2-id="2">City Name</option>
                                <option data-select2-id="5">Chandigarh</option>
                                <option data-select2-id="6">London</option>
                                <option data-select2-id="7">England</option>
                                <option data-select2-id="8">Pratapcity</option>
                                <option data-select2-id="9">Ukrain</option>
                                <option data-select2-id="10">Wilangana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 p-0">
                        <div class="form-group">
                            <img src="img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <select id="choose-city" class="form-control select2-hidden-accessible border-right-0"
                                    data-select2-id="New York, USA" tabindex="-1" aria-hidden="true">
                                <option data-select2-id="2">New York, USA</option>
                                <option data-select2-id="5">Chandigarh</option>
                                <option data-select2-id="6">London</option>
                                <option data-select2-id="7">England</option>
                                <option data-select2-id="8">Pratapcity</option>
                                <option data-select2-id="9">Ukrain</option>
                                <option data-select2-id="10">Wilangana</option>
                            </select>
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
        COVID-19 affects different people in different ways. Most infected people will develop mild to moderate
        illness and recover without hospitalization.
    </marquee>
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
                    <img src="img/featured-video.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-1.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                    <div class="most-popular-jobs-block-hover">
                        <img src="img/play-icon.png" alt="play-icon">
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-2.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-3.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-4.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-1.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                    <div class="most-popular-jobs-block-hover">
                        <img src="img/play-icon.png" alt="play-icon">
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-5.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-6.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-7.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>

                <div class="featured-img-block position-relative mb-4">
                    <img src="img/featured-video-4.png" alt="featured-video" class="img-fluid mx-auto d-block">
                    <div class="ads-title">
                        <p class="mb-0">Company Name <img src="img/right-arrow.png" alt="right-arrow"
                                                          class="img-fluid float-right"></p>
                    </div>
                </div>
            </div>


            <div class="col-md-12 text-center">
                <a href="" class="read-more mt-4">Load More</a>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="img/application-splash.png" alt="application-splash"
                     class="img-fluid mx-auto d-block mb-md-0 mb-5">
            </div>
            <div class="col-md-6">
                <div class="the-rn-app">
                    <h5>Step Forword Now</h5>
                    <h2>THE RN500 APP</h2>
                    <h3 class="mb-4">A world of opportunity in your hand</h3>

                    <p class="text-justify">
                        Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue
                        posuere lacus,
                        id tincidunt nisi porta sit amet. Suspendisse et sapien varius, pellentesque dui non, semper
                        orci. Curabitur
                        blandit, diam ut ornare ultricies.
                    </p>

                    <h3 class="mb-4">We are available on</h3>

                    <a href="">
                        <img src="img/google-play.png" alt="google-play" class="img-fluid mr-3">
                    </a>

                    <a href="">
                        <img src="img/app-store.png" alt="app-store" class="img-fluid">
                    </a>
                </div>
            </div>
            </div>
    </div>
</section>
