<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/23
 * Time: 下午2:59
 */
namespace app\ajax\controllers;

use app\admin\models\District;
use app\admin\models\Line;
use app\admin\models\Notice;
use app\admin\models\Sim;
use app\admin\models\Xiaoqu;
use app\home\models\Customer;
use yii;


class DefaultController extends yii\base\Controller
{

    public function actionDistrct()
    {

        $pid = Yii::$app->request->get('pid');
        $level = Yii::$app->request->get('level');

        $district = new District();
        $model = $district->getList($pid);
        if ($level == 1) {
            $aa = "--请选择市--";
        } else if ($level == 2 && $model) {
            $aa = "--请选择区--";
        }

        echo yii\helpers\Html::tag('option', $aa, ['value' => '0']);

        if ($pid != '' && $pid != 0) {

            foreach ($model as $value => $name) {
                echo yii\helpers\Html::tag('option', yii\helpers\Html::encode($name), array('value' => $value));
            }
        }
    }



    public function actionGetLnglat(){

        return $this->renderPartial('get-lnglat');

    }

    public function actionCustomer()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $q = Yii::$app->request->get('q');
        $platform_id = Yii::$app->request->get('platform_id');
        $user_id = Yii::$app->request->get('user_id',0);
        if ($q) {
            $where=['status'=>0,'platform_id'=>$platform_id];
            if($user_id>0){
                $where['user_id']=$user_id;
            }
            $sim = Customer::find()->select('id,name,code')->where($where)->andWhere(['or',['like', 'code', $q],['like', 'name', $q]])->limit(20)->all();
            $data = [];
            foreach ($sim as $key => $val) {
                $data[$key]['id']=$val->id;
                $data[$key]['text']=$val->name."({$val->code})";

            }
            $out['results'] = array_values($data);
        }
        return $out;
    }




}