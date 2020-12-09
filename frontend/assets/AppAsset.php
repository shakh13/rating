<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/css/Nunito.css',
        'assets/css/line-awesome-font-awesome.min.css',
        'assets/css/main.css',
        'assets/css/app.css',
        'css/site.css',
    ];
    public $js = [
        'assets/980b77c1/js/bootstrap.js',
        'assets/js/popper.min.js',
        'assets/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
