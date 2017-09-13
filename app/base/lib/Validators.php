<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/29
 * Time: 下午2:45
 * 一些常用的验证方法主要是用于api
 */

namespace app\base\lib;
use yii\base\Component;

class Validators extends Component
{

    public $value;
    public $message;

    public function number(){

        $pattern = '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/';
        $ret=array();
        $ret['status']=true;
        if (!preg_match($pattern, "$this->value")) {

            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;
    }

    public function intger(){

        $pattern = '/^\s*[+-]?\d+\s*$/';
        $ret=array();
        $ret['status']=true;
        if (!preg_match($pattern, "$this->value")) {

            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;
    }

    public function phone() {
        $phone=$this->value;
        $ret=array();
        $ret['status']=true;
        if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $phone)){
            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;
    }

    public function pwd(){
        $match='/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]$/';
        $v = trim($this->value);
        $ret=array();
        $ret['status']=true;
        if(!preg_match($match,$v)){
            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;
    }


    public function doMatch($reg)
    {
        $val = $this->value;
        $ret = array();
        $ret['status']=true;
        if (!preg_match($reg, $val)) {
            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;

    }


    public  function email(){
        $email=$this->value;
        $ret=array();
        $ret['status']=true;
        $reg='/^([a-zA-Z0-9]{1,20})(([_-.])?([a-zA-Z0-9]{1,20}))*@([a-zA-Z0-9]{1,20})(([-_])?([a-zA-Z0-9]{1,20}))*(.[a-z]{2,4}){1,2}$/';
        if(!preg_match($reg,$email))
        {
            $ret['status']=false;
            $ret['message']=$this->message;
        }
        return $ret;

    }

}