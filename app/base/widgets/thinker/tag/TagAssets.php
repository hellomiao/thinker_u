<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/1/5
 * Time: 下午9:25
 */
namespace app\base\widgets\thinker\tag;
use \yii\web\AssetBundle;
class TagAssets extends AssetBundle{
    public $sourcePath = "@app/base/widgets/thinker/tag/assets";
    public $basePath = "@webroot/assets";
    public $css=[
      'css/jquery.tag-editor.css'
    ];
    public $js=[
        'js/jquery.caret.min.js',
        'js/jquery.tag-editor.js'
    ];

    public $depends = ['yii\web\JqueryAsset'];
}