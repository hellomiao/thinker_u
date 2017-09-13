<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/24
 * Time: 下午4:49
 */

namespace app\api\components;

use app\base\lib\DES3;
use app\base\lib\Utils;
use yii;

class Rpc
{

    public static $res;

    public static function call($method, $params = array())
    {
        $des3 = new DES3();
        $params['method'] = $method;
        $params['access_token'] = \Yii::$app->adminUser->identity->access_token;
        $params['is_system'] = true;
        $json = json_encode($params);
        $raw = $des3->encrypt($json);
        $res = Utils::post_raw(yii\helpers\Url::to('@web/api', true), $raw);
        self::$res=json_decode($res,true);
        return $res;
    }

    public static function getRes($message='操作成功'){

        $res=self::$res;
        if($res['code']==1000){
            return ['status'=>true,'message'=>$message];
        }else{
            return ['status'=>false,'message'=>$res['message']];
        }

    }
}