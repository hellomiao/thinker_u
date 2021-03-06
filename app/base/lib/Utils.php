<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/24
 * Time: 下午3:35
 */
namespace app\base\lib;

use app\admin\models\AdminLogger;
use app\home\models\UserLogger;
use yii\base\Exception;
use yii\log\FileTarget;

class Utils
{
    public static function objectToArray($stdclassobject)
    {
        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;

        foreach ($_array as $key => $value) {
            $value = (is_array($value) || is_object($value)) ? Utils::objectToArray($value) : $value;
            $array[$key] = $value;
        }

        return $array;
    }

    public static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function xmp($data, $isExit = false)
    {

        echo '<xmp>';
        print_r($data);
        echo '</xmp>';

        if ($isExit)
            exit;
    }

    //添加日志
    public static function adminLog($type, $intro, $uid = 0)
    {

        $uid = \Yii::$app->adminUser->id ? \Yii::$app->adminUser->id : $uid;
        $logger = new AdminLogger();
        $currentUrl = \Yii::$app->request->getUrl();
        $userIP = \Yii::$app->request->userIP;
        $data = array('user_id' => $uid, 'catalog' => $type, 'url' => $currentUrl, 'intro' => $intro, 'ip' => $userIP, 'create_time' => time());
        $logger->attributes = $data;
        $logger->save();
    }


    public static function log($type, $intro, $uid = 0)
    {
        $uid = \Yii::$app->user->id ? \Yii::$app->user->id : $uid;
        $platform_id = \Yii::$app->user->identity->platform_id;
        $logger = new UserLogger();
        $currentUrl = \Yii::$app->request->getUrl();
        $userIP = \Yii::$app->request->userIP;
        $data = array('user_id' => $uid, 'platform_id' => $platform_id, 'catalog' => $type, 'url' => $currentUrl, 'intro' => $intro, 'ip' => $userIP, 'create_time' => time());
        $logger->attributes = $data;
        $logger->save();
    }


    public static function getTree($categorys)

    {
        $id = 0;
        $level = 0;
        $categoryObjs = array();
        $tree = array();
        $childrenNodes = array();
        foreach ($categorys as $cate) {
            $obj = new stdClass();
            $obj->root = $cate;
            $id = $cate['id'];
            $level = $cate['parent_id'];
            $obj->children = array();
            $categoryObjs[$id] = $obj;
            if ($level) {
                $childrenNodes[] = $obj;
            } else {
                $tree[] = $obj;
            }
        }


        foreach ($childrenNodes as $node) {
            $cate = $node->root;
            $id = $cate['id'];
            $level = $cate['parent_id'];
            $categoryObjs[$level]->children[] = $node;
        }

        return $tree;
    }


    public static function sendSms($telphone, $message)
    {
        $res = [];
        $uid = \Yii::$app->params['smsUid'];
        $passwd = \Yii::$app->params['smsPasswd'];
        $message = iconv('UTF-8', 'GB2312', $message);
        $gateway = "http://mb345.com:999/ws/batchSend2.aspx?CorpID={$uid}&Pwd={$passwd}&Mobile={$telphone}&Content={$message}&Cell=&SendTime=";

        $result = file_get_contents($gateway);

        if ($result > 0) {
            $res['status'] = true;
        } else {
            $res['status'] = false;
            $res['message'] = $result;
        }

        return $res;

    }

    public static function isNames($value, $minLen = 2, $maxLen = 20, $charset = 'ALL')
    {
        if (empty($value))
            return false;
        switch ($charset) {
            case 'EN':
                $match = '/^[_\w\d]{' . $minLen . ',' . $maxLen . '}$/iu';
                break;
            case 'CN':
                $match = '/^[_\x{4e00}-\x{9fa5}\d]{' . $minLen . ',' . $maxLen . '}$/iu';
                break;
            default:
                $match = '/^[_\w\d\x{4e00}-\x{9fa5}]{' . $minLen . ',' . $maxLen . '}$/iu';
        }
        return preg_match($match, $value);
    }

    /**
     * 验证密码
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isPwd($value, $minLen = 6, $maxLen = 16)
    {
        $match = '/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{' . $minLen . ',' . $maxLen . '}$/';
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证eamil
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isEmail($value, $match = '/^[\w\d]+[\w\d-.]*@[\w\d-.]+\.[\w\d]{2,10}$/i')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证电话号码
     * @param string $value
     * @return boolean
     */
    public static function isTelephone($value, $match = '/^0[0-9]{2,3}[-]?\d{7,8}$/')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证手机
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isMobile($value, $match = '/^[(86)|0]?(13\d{9})|(15\d{9})|(18\d{9})$/')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证邮政编码
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isPostcode($value, $match = '/\d{6}/')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证IP
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isIP($value, $match = '/^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证身份证号码
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isIDcard($value, $match = '/^\d{6}((1[89])|(2\d))\d{2}((0\d)|(1[0-2]))((3[01])|([0-2]\d))\d{3}(\d|X)$/i')
    {
        $v = trim($value);
        if (empty($v))
            return false;
        else if (strlen($v) > 18)
            return false;
        return preg_match($match, $v);
    }

    /**
     * *
     * 验证URL
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function isURL($value, $match = '/^(http:\/\/)?(https:\/\/)?([\w\d-]+\.)+[\w-]+(\/[\d\w-.\/?%&=]*)?$/')
    {
        $v = strtolower(trim($value));
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /*
    utf-8编码下截取中文字符串,参数可以参照substr函数
    @param $str 要进行截取的字符串
    @param $start 要进行截取的开始位置，负数为反向截取
    @param $end 要进行截取的长度
*/
    public static function utf8_substr($str, $start = 0)
    {
        if (empty($str)) {
            return false;
        }
        if (function_exists('mb_substr')) {
            if (func_num_args() >= 3) {
                $end = func_get_arg(2);
                return mb_substr($str, $start, $end, 'utf-8');
            } else {
                mb_internal_encoding("UTF-8");
                return mb_substr($str, $start);
            }

        } else {
            $null = "";
            preg_match_all("/./u", $str, $ar);
            if (func_num_args() >= 3) {
                $end = func_get_arg(2);
                return join($null, array_slice($ar[0], $start, $end));
            } else {
                return join($null, array_slice($ar[0], $start));
            }
        }
    }

    public static function post_raw($url, $data_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function getRandChar($length)
    {
        $str = null;
        $strPol = "0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }


    /** Json数据格式化
     * @param  Mixed $data 数据
     * @param  String $indent 缩进字符，默认4个空格
     * @return JSON
     */
    public static function jsonFormat($data, $indent = null)
    {


        if ($data == null) {
            return;
        }

        $callback = function (&$val) {
            if ($val !== true && $val !== false && $val !== null) {
                $val = urlencode($val);
            }
        };
        // 对数组中每个元素递归进行urlencode操作，保护中文字符
        array_walk_recursive($data, $callback);


        // json encode
        $data = json_encode($data);

        // 将urlencode的内容进行urldecode
        $data = urldecode($data);

        // 缩进处理
        $ret = '';
        $pos = 0;
        $length = strlen($data);
        $indent = isset($indent) ? $indent : '    ';
        $newline = "\n";
        $prevchar = '';
        $outofquotes = true;

        for ($i = 0; $i <= $length; $i++) {

            $char = substr($data, $i, 1);

            if ($char == '"' && $prevchar != '\\') {
                $outofquotes = !$outofquotes;
            } elseif (($char == '}' || $char == ']') && $outofquotes) {
                $ret .= $newline;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }

            $ret .= $char;

            if (($char == ',' || $char == '{' || $char == '[') && $outofquotes) {
                $ret .= $newline;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $ret .= $indent;
                }
            }

            $prevchar = $char;
        }

        return $ret;
    }


    public static function downfile($file_path)
    {
        header("location:{$file_path}");
    }


    /**
     * curl post
     * @param $url
     * @param $post_data
     * @return mixed
     */

    public static function post($url, $post_data)
    {
        if (is_array($post_data)) {
            $post_data = http_build_query($post_data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * @param $file
     * @param int $row 行数
     * @return array
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public static function readExcel($file, $row = 2)
    {
        $type = pathinfo($file);
        $type = strtolower($type["extension"]);
        $type = $type === 'csv' ? $type : ($type == 'xls' ? 'Excel5' : 'Excel2007');
        $objReader = \PHPExcel_IOFactory::createReader($type);
        $objPHPExcel = $objReader->load($file);
        $sheet = $objPHPExcel->getSheet(0);
        // 取得总行数
        $highestRow = $sheet->getHighestRow();
        // 取得总列数
        $highestColumn = $sheet->getHighestColumn();
        //循环读取excel文件,读取一条,插入一条
        $data = array();
        //从第一行开始读取数据
        for ($j = $row; $j <= $highestRow; $j++) {
            //从A列读取数据
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                // 读取单元格
                $cell = $objPHPExcel->getActiveSheet()->getCell("$k$j");
                $value = $cell->getValue();;
                $data[$j][] = $value;
            }
        }

        return $data;
    }

    /**
     * 秒转成分钟小时
     */

    public static function sec2time($sec)
    {

        if (is_numeric($sec)) {
            $value = array(
                "hours" => 0,
                "minutes" => 0
            );
            if ($sec >= 3600) {
                $value["hours"] = floor($sec / 3600);
                $sec = ($sec % 3600);
            }
            if ($sec >= 60) {
                $value["minutes"] = floor($sec / 60);
                $sec = ($sec % 60);
            }

            $t = '';
            if ($value["hours"] > 0) {
                $t .= $value["hours"] . "小时";
            }
            if ($value["minutes"] >= 0) {

                $t .= $value["minutes"] . "分钟";
            }

            Return $t;

        } else {
            return (bool)FALSE;
        }
    }

    public static function distance($l1, $l2, $radius = 6378.137)
    {
        $lat1 = $l1[1];
        $lon1 = $l1[0];
        $lat2 = $l2[1];
        $lon2 = $l2[0];
        $rad = floatval(M_PI / 180.0);

        $lat1 = floatval($lat1) * $rad;
        $lon1 = floatval($lon1) * $rad;
        $lat2 = floatval($lat2) * $rad;
        $lon2 = floatval($lon2) * $rad;

        $theta = $lon2 - $lon1;

        $dist = acos(sin($lat1) * sin($lat2) +
            cos($lat1) * cos($lat2) * cos($theta)
        );

        if ($dist < 0) {
            $dist += M_PI;
        }

        return $dist = $dist * $radius;
    }

    public static function getAddress($lng, $lat)
    {

        $data = [];
        $ch = curl_init();
//设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "http://restapi.amap.com/v3/geocode/regeo?key=8ece2871fbc243a65abc69d687751100&location={$lng},{$lat}&poitype=&radius=1000&extensions=all&batch=false&roadlevel=0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
//执行并获取HTML文档内容
        $res = curl_exec($ch);
        if ($res === FALSE) {

            return 'ERROR|获取不到地址';
        }
//释放curl句柄
        curl_close($ch);
//打印获得的数据
        $res = json_decode($res, true);
        if($res['status']==1) {
            $address = $res['regeocode']['formatted_address'];
        }else{
            return 'ERROR|获取不到地址';
        }
        return $address;

    }

    public static function logger($msg, $categorys = 'driver')
    {
        $date = date("Y-m-d");
        $time = microtime(true);
        $log = new FileTarget();
        $log->logFile = \Yii::$app->getRuntimePath() . "/logs/driverlog/{$categorys}/{$date}.log";

        if (!file_exists(dirname($log->logFile))) {
            mkdir(dirname($log->logFile), 0777, true);
        }
        $log->messages[] = [$msg, 4, $categorys, $time];
        $log->export();
    }

}