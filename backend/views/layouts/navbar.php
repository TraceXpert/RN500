<?php

use yii\helpers\Html;

$profile = Yii::$app->urlManagerAdmin->createAbsoluteUrl('/images/profile.png');
if (isset(Yii::$app->user->identity->details->profile_pic) && !empty(Yii::$app->user->identity->details->profile_pic)) {
    $profile = Yii::$app->urlManagerFrontend->createAbsoluteUrl('/uploads/user-details/profile/' . Yii::$app->user->identity->details->profile_pic);
}
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $profile ?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?= isset(Yii::$app->user->identity) ? Yii::$app->user->identity->getFullName() : '' ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?= $profile ?>" class="img-circle elevation-2" alt="User Image">

                    <p>
                        <?= isset(Yii::$app->user->identity) ? Yii::$app->user->identity->getFullName() : '' ?>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="<?= Yii::$app->urlManagerAdmin->createUrl('../site/index') ?>" class="btn btn-default btn-flat">Home Page</a>
                    <?php echo Html::a('Sign out', ['../auth/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat float-right','style'=>'height: 37px;']) ?>
                </li>
            </ul>
        </li>
        <!--        <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                            class="fas fa-th-large"></i></a>
                </li>-->
    </ul>
</nav>