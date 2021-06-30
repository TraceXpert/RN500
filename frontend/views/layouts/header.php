<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\CommonFunction;
use yii\widgets\Pjax;
use yii\web\View;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
?>
<nav class="navbar navbar-expand-lg bg-white navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html"><img src="<?= $assetDir ?>/img/logo.png" alt="logo" class="img-fluid logo-w"></a>
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
                <?php if (CommonFunction::isEmployer() || CommonFunction::isRecruiter()) { ?>
                    <li class="nav-item position-relative  <?php echo $controller == 'site' && $action == 'about-us' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Yii::$app->urlManagerAdmin->createUrl("site/index"); ?>">Dashboard</a>
                    </li>
                <?php } ?>
                <li class="nav-item position-relative <?php echo $controller == 'browse-jobs' && $action == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("browse-jobs/index"); ?>">Browse Job</a>
                </li>
                <li class="nav-item position-relative  <?php echo $controller == 'site' && $action == 'contact-us' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/contact-us"); ?>">Contact </a>
                </li>
<!--                <li class="nav-item position-relative <?php echo $controller == 'site' && $action == 'advertise' ? 'active' : '' ?>    ">
                    <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl("site/advertise"); ?>">Advertise</a>
                </li>-->
                <?php if (Yii::$app->user->isGuest) { ?>

                    <li class="nav-item position-relative d-flex align-items-center">
                        <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>" class="btn btn-primary readmore mt-md-0 ml-0 mb-3 mb-md-0 mt-2 mt-md-0">Sign In / Sign Up</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item position-relative d-flex align-items-center">
                        <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/logout"); ?>" class="btn btn-primary readmore mt-md-0 ml-0 mb-3 mb-md-0 mt-2 mt-md-0">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </div>
</nav>


