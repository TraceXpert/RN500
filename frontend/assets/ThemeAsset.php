<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ThemeAsset extends AssetBundle {

    public $sourcePath = '@themes/rn500-theme';
    public $css = [
        'css/bootstrap.min.css',
        'css/custom.css',
        'css/font-awesome.css',
        'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'
    ];
    public $js = [
//        'js/jquery.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
