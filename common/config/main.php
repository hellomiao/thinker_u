<?php
$dbconfig = dirname(dirname(__DIR__)) . '/common/config/dbconfig.php';
$db = [];
if (file_exists($dbconfig)) {
    $db = include_once $dbconfig;
}

if (!file_exists(dirname(dirname(__DIR__)) . "/static/assets")) {
    mkdir(dirname(dirname(__DIR__)) . "/static/assets", 0777, true);

}

if (!file_exists(dirname(dirname(__DIR__)) . "/static/files")) {
    mkdir(dirname(dirname(__DIR__)) . "/static/files", 0777, true);

}
$components = [

    'imgUpload' => [
        'class' => 'app\base\lib\ImageUpload',
        'uploadDir' => "@webroot/static/files",
        'uploadUrl' => "@web/static/files",
    ],
    "urlManager" => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
//            'suffix' => '.html',
        'rules' => include_once dirname(dirname(__DIR__)) . '/common/config/url-rules.php',
    ],
    'assetManager' => [
        "basePath" => "@webroot/static/assets",
        "baseUrl" => "@web/static/assets",
        'linkAssets' => true,
        'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'js' => [
//                        YII_DEBUG ? 'jquery.js' : 'jquery.min.js'
//                    ]
//                ],
//                'yii\bootstrap\BootstrapAsset' => [
//                    'css' => [
//                        YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'
//                    ]
//                ],
//                'yii\bootstrap\BootstrapPluginAsset' => [
//                    'js' => [
//                        YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'
//                    ]
//                ],
            'dmstr\web\AdminLteAsset' => [
                'skin' => 'skin-blue',
            ],
        ]
    ],

    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.163.com',
            'username' => 'qqucx@163.com',
            'password' => 'xxx',
            'port' => '25',
            'encryption' => 'tls',

        ],
        'messageConfig' => [
            'charset' => 'UTF-8',
            'from' => ['qqucx@163.com' => 'thinkforum']
        ],
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => [
                    'error',
                    'warning',
                    'info',
                ]
            ]
        ]
    ],
    'adminUser' => [
        'class' => '\yii\web\User',
        'identityClass' => 'app\admin\models\Admin',
        'enableAutoLogin' => true,
        'idParam' => '_admin',
        'identityCookie' => [
            'name' => '_backendIdentity',
            'httpOnly' => true
        ]
    ],
    'user' => [
        'class' => '\yii\web\User',
        'identityClass' => 'app\home\models\User',
        'enableAutoLogin' => true,
        'idParam' => '_user',
        'identityCookie' => [
            'name' => '_frontIdentity',
            'httpOnly' => true
        ]
    ],



//    'session' => [
//        'class' => 'yii\redis\Session',
//        'redis' => [
//            'hostname' => 'localhost',
//            'port' => 6379,
//            'database' => 0,
//        ],
//    ],


    'cache' => [
        'class' => 'yii\caching\FileCache',
//        'class' => 'yii\redis\Cache',
    ],
//    'redis' => [
//        'class' => 'yii\redis\Connection',
//        'hostname' => 'localhost',
//        'port' => 6379,
//    ],



];
$components = array_merge($db, $components);

return [
    'name' => '货运管理平台',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'id' => 'app',
    'runtimePath' => '@data/runtime',
    'bootstrap' => [
        'log', 'debug'
    ],
    'timeZone' => 'Asia/Chongqing',
    'defaultRoute' => 'home/default/index',
    'controllerNamespace' => 'app\home\controllers',
    'modules' => include_once dirname(dirname(__DIR__)) . '/common/config/module.php',
    'components' => $components,
    'params' => include_once 'params.php'
];
