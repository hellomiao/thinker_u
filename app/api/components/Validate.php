<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/24
 * Time: 下午3:30
 */

namespace app\api\components;

use yii;
class Validate
{
    static function sign($params, $token) {
        return strtoupper(md5(strtoupper(md5(Validate::assemble($params))).$token));
    }

    static function assemble($params)
    {
        if(!is_array($params))  return null;
        ksort($params, SORT_STRING);
        $sign = '';
        foreach($params AS $key=>$val){
            if(is_null($val))   continue;
            if(is_bool($val))   $val = ($val) ? 1 : 0;
            $sign .= $key . (is_array($val) ? self::assemble($val) : $val);
        }
        return $sign;
    }


    static function checkSign($params){

        $sign=$params['sign'];
        unset($params['sign']);
        $token = Yii::$app->params['token'];
        if($sign!=Validate::sign($params,$token)){
            return false;
        }
        return true;
    }
}