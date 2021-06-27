<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\assets\ThemeAsset;
use common\components\FlashmessageWidget;

ThemeAsset::register($this);
$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title>RN500</title>
        <?php $this->head() ?>
        <!-- Fav Icon -->
        <link rel="shortcut icon" href="<?= $assetDir ?>/images/favicon.ico">
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="forny-container">
            <div class="forny-inner">
                <div class="forny-two-pane">
                    <div class="position-relative">
                        <div class="login-header">
                            <div>
                                <a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/index"); ?>">
                                    <img src="<?= $assetDir ?>/img/logo.png" alt="logo" />
                                </a>

                                <a href="<?= Yii::$app->urlManagerFrontend->createUrl("site/index"); ?>">Home</a>
                            </div>
                        </div>
                        <?= $content ?>
                    </div>
                    <div class="right-pane">

                    </div>
                </div>
            </div>
        </div>
        <?php
        echo FlashmessageWidget::widget();
        ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<?php
$style = <<< CSS
.right-pane {
    background-image: url($assetDir/img/login-bg.png);
}
CSS;
$this->registerCss($style);
?>