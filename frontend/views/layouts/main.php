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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <?php echo FlashmessageWidget::widget(); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        color: #232731;
        margin-top: 80px;
        font-size: 16px;
    }

    #overlay {
        position: fixed;
        z-index: 9999;
        height: 10em;
        width: 10em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #overlay:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    #overlay img {
        position: absolute;
        z-index: 99;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }

    #overlay h1 {
        position: relative;
        color: rgba(0, 0, 0, .3);
        font-size: 4em;
    }

    #overlay h1:before {
        content: attr(data-text);
        position: absolute;
        overflow: hidden;
        max-width: 7em;
        white-space: nowrap;
        color: #ffffff;
        animation: loading 3s linear infinite;
    }

    @keyframes loading {
        0% {
            max-width: 0;
        }

        100% {
            max-width: 200px;
        }
    }

    /* .loading {
        height: 0;
        width: 0;
        padding: 15px;
        border: 6px solid #fff;
        border-right-color: #1c4599;
        border-radius: 22px;
        z-index: 99;
        -webkit-animation: rotate 1s infinite linear;
    }

    @-webkit-keyframes rotate {
        100% {
            -webkit-transform: rotate(360deg);
        }
    } */
    .show{
        display: block !important;
    }
    .hide{
        display: none !important;
    }
</style>
<div id="overlay" class="show">
    <h1 data-text="RN500">RN500</h1>
</div>
<script>
    $(window).on('load', function () {
        setInterval(function () {
            $('#overlay').removeClass("show");
            $('#overlay').addClass("hide");
        }, 4000);
    });
    $(document).bind("ajaxStart.mine", function () {
        $('#overlay').removeClass("hide");
        $('#overlay').addClass("show");
    });
    $(document).bind("ajaxStop.mine", function () {
        $('#overlay').removeClass("show");
        $('#overlay').addClass("hide");
    });
</script>