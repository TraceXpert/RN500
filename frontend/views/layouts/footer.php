<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\CommonFunction;
?>
<section class="">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?= $assetDir ?>/img/application-splash.png" alt="application-splash" class="img-fluid mx-auto d-block mb-md-0 mb-5">
            </div>
            <div class="col-md-6">
                <div class="the-rn-app">
                    <h5>Step Forword Now</h5>
                    <h2>THE RN500 APP</h2>
                    <h3 class="mb-4">A world of opportunity in your hand</h3>

                    <p class="text-justify">
                        To connect through Mobile devices, download RN500 on your Android and iOS. We make easy for job seekers to find for their needs. Please write us on: info@RN500.com, if you need help.
                    </p>

                    <h3 class="mb-4">We are available on</h3>

                    <a href="https://play.google.com/store/apps/details?id=com.rm500">
                        <img src="<?= $assetDir ?>/img/google-play.png" alt="google-play" class="img-fluid mr-3">
                    </a>

                    <a href="">
                        <img src="<?= $assetDir ?>/img/app-store.png" alt="app-store" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?= $assetDir ?>/img/footer-logo.png" alt="footer-logo" class="img-fluid">

                <p class="mt-4 text-justify">
                    RN500 LLC is one of the leading staffing service provider in North America. In healthcare industries
                    to meet the staffing requirements in fastest growing market, we have developed advanced technology 
                    service solutions which can eliminate gaps between employers and job seekers.
                </p>


                <a href="https://twitter.com/TheRN500">
                    <img src="<?= $assetDir ?>/img/twitter.png" alt="twitter" class="img-fluid mr-2">
                </a>

                <a href="https://www.facebook.com/RN500-LLC-103500725353353">
                    <img src="<?= $assetDir ?>/img/facebook.png" alt="facebook" class="img-fluid mr-2">
                </a>

                <a href="">
                    <img src="<?= $assetDir ?>/img/google-f.png" alt="google-f" class="img-fluid">
                </a>

            </div>

            <div class="col-lg-2 col-md-4">
                <h3 class="mb-4 mt-4">Quick Links</h3>

                <ul class="list-unstyled">                       
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Search Your Job</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("job/post"); ?>">Post a Job</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Jobs by Speciality</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Jons by Disciptline</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Jobs by Benefits</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Jobs by Locations</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4">
                <h3 class="mb-4 mt-4">Company</h3>

                <ul class="list-unstyled">                       
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/about-us"); ?>">About Us</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/contact-us"); ?>">Contact Us</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Browse Jobs</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/privacy-policy"); ?>">Privacy Policy</a></li>
                    <li><a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/tearms-condition"); ?>">Terms Conditions</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h3 class="mb-4 mt-4">Contact Us</h3>

                <div class="media mb-3">
                    <img src="<?= $assetDir ?>/img/location-icon.png" alt="location-icon" class="mr-3">
                    <div class="media-body">                         
                        <p class="mb-0">
                            RN500 LLC.<br/> 445 Park Avenue,<br/> Manhattan, NY 10022 USA.
                        </p>
                    </div>
                </div>


                <div class="media  mb-3">
                    <img src="<?= $assetDir ?>/img/mobile-icon.png" alt="mobile-icon" class="mr-3">
                    <div class="media-body">                         
                        <a href="tel:+1 917-806-5507">
                            +1 917-806-5507
                        </a>
                    </div>
                </div>

                <div class="media">
                    <img src="<?= $assetDir ?>/img/mail-icon.png" alt="mobile-icon" class="mr-3">
                    <div class="media-body">                         
                        <a href="mailto:info@RN500.com">
                            info@RN500.com
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <hr>

                <p class="mb-0 text-center">© RN500 2021, All Rights Reserved. Powered By : <a href="https://www.tracexpert.com/">Tracexpert</a></p>
            </div>
        </div>
    </div>
</footer>