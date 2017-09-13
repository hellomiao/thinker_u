<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/5/5
 * Time: 下午2:17
 */

namespace app\base\lib;

use app\base\models\Config;
use Yii;
use yii\base\Component;

class RedisConfig extends Component
{

    const KEY = 'config';

    public $redis;

    private $configModel;


    public function __construct()
    {
        $this->redis = Yii::$app->redis;
        $this->configModel = new Config();
    }

    public function save()
    {

        $list = $this->configModel->find()->where(['status_is' => 1])->all();
        $data = [];
        foreach ($list as $k => $v) {
            array_push($data, $v['name']);
            array_push($data, $v['data']);
        }
        if (!empty($data)) {
            array_unshift($data, self::KEY);
            $this->redis->executeCommand('HMSET', $data);
        }
    }

    public function set($name, $data, $info = '')
    {
        $model = $this->configModel->findOne(['name' => $name]);
        $this->configModel = $model ? $model : $this->configModel;
        $this->configModel->name = $name;
        $this->configModel->data = $data;
        $this->configModel->info = $info;
        $this->configModel->save();
        $arr = [];
        array_push($arr, $name);
        array_push($arr, $data);
        array_unshift($arr, self::KEY);
        $this->redis->executeCommand('HSET', $arr);
    }

    public function get($name)
    {

        $data = $this->redis->executeCommand('HGET', [self::KEY, $name]);
        if (!$data) {
            $row = $this->configModel->find()->where(['status_is' => 1, 'name' => $name])->one();
            $this->redis->executeCommand('HSET', [self::KEY, $row['name'], $row['data']]);
            $data = $row['data'];
        }
        return $data;

    }

    public function mget(array $field){
        $set=$field;
        array_unshift($set, self::KEY);
        $new=[];
        $data = $this->redis->executeCommand('HMGET', $set);
        unset($set);
        if(!$data){
            $data=$this->configModel->find()->where(['name'=>['wxAppId','wxAppSecret']])->asArray()->all();
            $set=[];
            foreach($data as $k=>$v){
                $new[$v['name']]=$v['data'];
                array_push($set, $v['name']);
                array_push($set, $v['data']);
            }
            array_unshift($set, self::KEY);
            $this->redis->executeCommand('HMSET', $set);
        }else{

            foreach($field as $k=>$v){
                $new[$v]=$data[$k];
            }
        }
        return $new;

    }


    public function clear()
    {
        return $this->redis->executeCommand('DEL', [self::KEY]);
    }
}