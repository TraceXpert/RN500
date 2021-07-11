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
                        Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue
                        posuere lacus,
                        id tincidunt nisi porta sit amet. Suspendisse et sapien varius, pellentesque dui non, semper
                        orci. Curabitur
                        blandit, diam ut ornare ultricies.
                    </p>

                    <h3 class="mb-4">We are available on</h3>

                    <a href="">
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


                <a href="">
                    <img src="<?= $assetDir ?>/img/twitter.png" alt="twitter" class="img-fluid mr-2">
                </a>

                <a href="">
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
                </ul>
            </div>
            <div class="col-lg-4 col-md-12">
                <h3 class="mb-4 mt-4">Contacts</h3>

                <div class="media mb-3">
                    <img src="<?= $assetDir ?>/img/location-icon.png" alt="location-icon" class="mr-3">
                    <div class="media-body">                         
                        <p class="mb-0">
                            2929 NE 49th St, 
                            Fort Lauderdale, FL 33308 USA.
                        </p>
                    </div>
                </div>


                <div class="media  mb-3">
                    <img src="<?= $assetDir ?>/img/mobile-icon.png" alt="mobile-icon" class="mr-3">
                    <div class="media-body">                         
                        <a href="tel:+1 123–456–7890">
                            +1 123–456–7890
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