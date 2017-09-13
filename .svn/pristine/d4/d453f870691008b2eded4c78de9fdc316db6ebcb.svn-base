<?php
$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')

);
$db=yii\helpers\ArrayHelper::merge(include_once __DIR__ . '/../../common/config/dbconfig.php',
include_once __DIR__ . '/dbconfig.php'
    );


$components = [
    'log' => [
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],

    'swooleAsync' => [
        'class' => 'app\base\lib\swoole\AsyncComponent',
    ],
//    'queue' => [
//        'class' => '\app\base\lib\queue\RedisQueue',
//        'redis' => [
//            'host' => '127.0.0.1',
//            'port' => 6379
//        ]
//    ]
];
$components = yii\helpers\ArrayHelper::merge($db, $components);
return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Chongqing',
    'controllerNamespace' => 'console\controllers',
    'components' =>$components,
    'modules' => include_once  __DIR__ .'/../../common/config/module.php',
    'params' => $params,
];
