<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/4/20
 * Time: 上午10:48
 */

namespace app\api\controllers;


use app\admin\components\BaseController;
use app\admin\models\Apis;
use app\base\lib\DES3;
use app\base\lib\Utils;
use League\Flysystem\Exception;
use yii\helpers\Url;
use yii\imagine\Image;

class TestController extends BaseController
{

    public function actionIndex()
    {
        $pageStartTime = microtime();
        $des3 = new DES3();
//        $jsonData=[];
//        $jsonData['method']='user.test';
//        $jsonData['id']=1;
        $post = \Yii::$app->request->post('params');
        $arr = json_decode($post, true);
        $raw = $des3->encrypt($post);
        $res = Utils::post_raw(Url::to('@web/api', true), $raw);
        $raar=json_decode($res, true);
        $apis = Apis::find()->where(['method' => $arr['method']])->one();
        if ($apis) {
            unset($arr['method']);
            $apis->params = json_encode($arr);
            $apis->result = $res;
            $apis->save();
        }
        $pageEndTime = microtime();
        $startTime = explode(" ", $pageStartTime);
        $endTime = explode(" ", $pageEndTime);
        $totalTime = $endTime[0] - $startTime[0] + $endTime[1] - $startTime[1];
        $timeCost = sprintf("%s", $totalTime);
        $resArr=json_decode($res, true);
        $resArr['__time__']="API运行时间: {$timeCost} 秒";
        if(!empty($raar)) {
            exit(Utils::jsonFormat($resArr));
        }

    }



    public function actionUp(){

        if(\Yii::$app->request->isPost){

        }

        return $this->renderPartial('up');
    }
}