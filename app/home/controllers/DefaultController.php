<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/21
 * Time: 下午4:05
 */
namespace app\home\controllers;


use app\admin\models\PlatformUser;
use app\base\lib\WaterMask;
use app\home\components\BaseController;
use app\home\models\LoginForm;
use yii;

use app\api\components;

class DefaultController extends BaseController
{
    public function actions()
    {

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {


        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
//        $a = new Admin();
//        echo $a->hashPassword('123456','251aab');
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['default/index']);
        }

        if (!Yii::$app->user->isGuest) {
            $this->redirect(['default/index']);
        }
        return $this->render('login', ['model' => $model]);
    }


    public function actionLogout()
    {

        if (Yii::$app->user->logout(false)) {
            $this->redirect(['/login']);
        }
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionMap()
    {
        $platform_id = $this->platform_id;
        $platuser = PlatformUser::findOne($platform_id);
        return $this->renderAjax('map',['platform_id'=>$platform_id,'platuser'=>$platuser]);
    }



}