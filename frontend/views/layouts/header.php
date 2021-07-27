<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\CommonFunction;
use yii\widgets\Pjax;
use yii\web\View;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$userIdentity = isset(Yii::$app->user->identity) ? Yii::$app->user->identity : '';
$baseUrl = Url::base(true);

$isEmployer = CommonFunction::isEmployer();
$isRecruiter = CommonFunction::isRecruiter();
$isJobSeeker = CommonFunction::isJobSeeker();
?>
<style>
    .header-menu-pop-up.dropdown-menu{
        top: 115% !important;
        border: 0 !important;
        right: 0 !important;
        top: 75px !important;
        left: auto !important;
        background: #F7FBFC !important;
        box-shadow: 0px 4px 4px rgb(0 0 0 / 25%) !important;
        border-radius: 12px !important;
        padding: 0 !important;
        border-radius: 12px !important;
    }
    .header-menu-pop-up.dropdown-menu > .dropdown-item{
        padding: .70rem 1rem !important;
    }
</style>
<nav class="navbar navbar-expand-lg bg-white navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/index"); ?>"><img src="<?= $assetDir ?>/img/logo.png" alt="logo" class="img-fluid logo-w"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item position-relative <?php echo $controller == 'site' && $action == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/index"); ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item position-relative  <?php echo $controller == 'site' && $action == 'about-us' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/about-us"); ?>">About Us</a>
                </li>
                
                <li class="nav-item position-relative <?php echo $controller == 'browse-jobs' && ($action == 'index' || $action == 'view') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Browse Job</a>
                </li>
                <li class="nav-item position-relative  <?php echo $controller == 'site' && $action == 'contact-us' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/contact-us"); ?>">Contact </a>
                </li>
                <?php if ($isRecruiter) { ?>
                    <li class="nav-item position-relative  <?php echo $controller == 'browse-jobs' && ($action == 'recruiter-lead' || $action == 'recruiter-view') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/recruiter-lead"); ?>">For Recruiter</a>
                    </li>
                <?php } ?>

                <?php if ($isEmployer || $isRecruiter) { ?>
                    <li class="nav-item position-relative  <?php echo $controller == 'job' && ($action == 'post' || $action == 'list' )? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("job/list"); ?>">Post A Job</a>
                    </li>
                <?php } ?>
                <?php if (Yii::$app->user->isGuest) { ?>

                    <li class="nav-item position-relative d-flex align-items-center">
                        <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>" class="btn btn-primary readmore ml-md-3 ml-0 mb-3 mb-md-0 mt-2 mt-md-0">Sign In / Sign Up</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item dropdown position-relative profile-d">
                        <a class="nav-link p-0 m-0 mr-3 dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <div class="media">
                                <?php Pjax::begin(['id' => 'profile-picture-pjax', 'enablePushState' => false]); ?>
                                <?php if (!empty($userIdentity->details->profile_pic) && file_exists(CommonFunction::getProfilePictureBasePath() . "/" . $userIdentity->details->profile_pic)) { ?>
                                    <img src="<?= $baseUrl . "/uploads/user-details/profile/" . Yii::$app->user->identity->details->profile_pic ?>" alt="" class="mr-3 rounded-circle header-profile-img-size" />
                                <?php } else { ?>
                                    <img src="<?= $assetDir ?>/img/profile.png" alt="profile-img" class="mr-3 rounded-circle header-profile-img-size">
                                <?php } ?>
                                    <?php Pjax::end(); ?>
                                <div class="media-body">
                                    <p class="mb-0"><?= $userIdentity->fullName ?> </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu header-menu-pop-up" aria-labelledby="dropdown07">
                            <?php if ($isJobSeeker) { ?>
                                <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl(["site/job-seeker"]); ?>">
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/drop-profile.png" alt="profile-img" class="mr-2 rounded-circle">
                                        <div class="media-body">
                                            <p class="mb-0">Profile</p>
                                        </div>
                                    </div>
                                </a>
                            <?php } else { ?>
                                <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl(["user-details/profile", 'id' => Yii::$app->user->identity->id]); ?>">
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/drop-profile.png" alt="profile-img" class="mr-2 rounded-circle">
                                        <div class="media-body">
                                            <p class="mb-0">Profile</p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl("/auth/change-password"); ?>">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/drop-password.png" alt="profile-img" class="mr-2 rounded-circle">
                                    <div class="media-body">
                                        <p class="mb-0">Change Password</p>
                                    </div>
                                </div>
                            </a>
                            <?php if ($isJobSeeker) { ?>
                                <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl('browse-jobs/track-my-application') ?>">
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/drop-track-app.png" alt="profile-img" class="mr-2 rounded-circle">
                                        <div class="media-body">
                                            <p class="mb-0">Track My Application</p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                            
                            <?php if ($isEmployer || $isRecruiter) { ?>
                                <a class="dropdown-item" href="<?= Yii::$app->urlManagerAdmin->createUrl("site/index"); ?>">
                                    <div class="media">
<!--                                        <img src="<?= $assetDir ?>/img/drop-track-app.png" alt="profile-img" class="mr-2 rounded-circle">-->
                                        <span class="fa fa-cogs mr-2 rounded-circle pop-menu-icon"></span>
                                        <div class="media-body">
                                            <p class="mb-0">Admin Settings</p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>

                            <?php if ($isEmployer || $isRecruiter) { ?>
                                <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl('leads-received/index') ?>">
                                    <div class="media">
                                        <img src="<?= $assetDir ?>/img/drop-track-app.png" alt="profile-img" class="mr-2 rounded-circle">
                                        <div class="media-body">
                                            <p class="mb-0">Applications Received</p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>

                            <a class="dropdown-item" href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/logout"); ?>">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/drop-logout.png" alt="profile-img" class="mr-2 rounded-circle">
                                    <div class="media-body">
                                        <p class="mb-0">Logout</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </div>
</nav>


