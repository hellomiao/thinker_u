<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/21
 * Time: 下午3:42
 */
namespace app\admin;

class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config.php'));

        \Yii::$app->errorHandler->errorAction = 'admin/default/error';


    }

}