<?php 

namespace backend\assets;

use yii\web\AssetBundle;

class CalcPreviewAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@frontend/web';
    public $sourcePath = '@frontend/web/js/lib';
    public $css = [
    ];
    public $js = [
        'jquery-1.8.3.min.js'
    ];
    public $depends = [
    ];
}