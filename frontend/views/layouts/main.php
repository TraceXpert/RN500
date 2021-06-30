<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\ThemeAsset;
use yii\bootstrap4\ActiveForm;
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
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>-->
        <link rel="shortcut icon" href="<?= $assetDir ?>/img/favicon.ico">
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- Header start -->
        <?= $this->render('header', ['assetDir' => $assetDir]) ?>
        <!-- Header end --> 

        <?= $content ?>
        <!-- Footer start -->
        <?= $this->render('footer', ['assetDir' => $assetDir]) ?>
        <!-- Footer end --> 
         <?= $this->render('common-modal', ['assetDir' => $assetDir]) ?>
        <?php $this->endBody() ?>
        <?php
//        echo FlashmessageWidget::widget();
        ?>
    </body>
</html>
<?php $this->endPage() ?>

