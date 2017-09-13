<?php
$path=dirname(dirname(__DIR__)).'/app/';
$filesnames = scandir($path);
$modules['gii']= [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1'],
    'generators' => [
        'crud' => [ //生成器名称
            'class' => 'yii\gii\generators\crud\Generator',
            'templates' => [ //设置我们自己的模板
                //模板名 => 模板路径
                'myCrud' => '@app/admin/giitpl/crud/default',
            ]
        ]
    ],

];
$modules['debug']= [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1']

];
//获取也就是扫描文件夹内的文件及文件夹名存入数组 $filesnames

//print_r ($filesnames);

foreach ($filesnames as $name) {

    if(is_dir($path.$name)&&$name!='.'&&$name!='..'&&$name!='.svn'&&$name!='.git') {
        $modules[$name] = "app\\{$name}\\Module";

    }

}
//print_r ($modules);exit;
return $modules;
