<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/21
 * Time: 下午5:55
 */
namespace app\admin\assets;
class LoginAsset extends \yii\web\AssetBundle
{
  public $sourcePath = '@app/admin/misc';
    public $css = [
//        "AdminLTE.min.css",
//        "_all-skins.min.css",
//        "skin-blue.css",
//        'admin.css',
    'css/login2.css',

    ];
    public $js = [



    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
//        'hass\backend\assets\FontAwesomeAsset',
//        'hass\backend\assets\IoniconsAsset',
//        'hass\backend\assets\AdminLteAsset',
    ];

//  public $jsOptions = [
//      'position' => \yii\web\View::POS_HEAD
//  ];

  //定义按需加载JS方法，注意加载顺序在最后
  public static function addScript($view, $jsfile) {
    $b=AdminAsset::register($view);
    $view->registerJsFile($b->baseUrl.$jsfile, [AdminAsset::className(), 'depends' => 'app\admin\assets\AdminAsset']);
  }

  //定义按需加载css方法，注意加载顺序在最后
  public static function addCss($view, $cssfile) {
    $b=AdminAsset::register($view);
    $view->registerCssFile($b->baseUrl.$cssfile, [AdminAsset::className(), 'depends' => 'app\admin\assets\AdminAsset']);
  }
}