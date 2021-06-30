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
        'css/toastr.min.css',
        'css/custom.css',
        'css/custom_ma.css',
        'css/font-awesome.css',
        'css/jquery-ui.min.css',
    ];
    public $js = [
//        'js/jquery.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/jquery-ui.min.js',
        'js/toastr.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapAsset',
//        'yii\bootstrap4\BootstrapPluginAsset',
    ];

}
