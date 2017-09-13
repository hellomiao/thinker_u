<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/6/6
 * Time: 下午5:32
 */

namespace console\controllers;


use app\admin\models\Admin;
use app\admin\models\Notice;
use app\admin\models\Xiaoqu;
use app\base\lib\umeng\Push;
use app\base\lib\Utils;
use app\home\models\Delivery;
use app\home\models\DeliveryLocations;
use app\home\models\Driver;
use app\home\models\DriverClockList;
use yii\base\Exception;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class TaskController extends Controller
{
    public $defaultAction = 'run';

    public function actionRun($sdate = '')
    {
        error_reporting(E_ALL ^ E_NOTICE);

        $date = $sdate == '' ? date("Y-m-d", strtotime("-1 days")) : $sdate;

        $dids = Delivery::find()->select('id,driver_id,platform_id,delivery_date')->where(['delivery_date' => $date])->asArray()->all();

        foreach ($dids as $v) {
            $distance = 0;
            $driver = Driver::findOne($v['driver_id']);
            $time1 = strtotime($v['delivery_date'] . ' 00:00:00');
            $time2 = strtotime($v['delivery_date'] . ' 24:00:00');
            $total = DeliveryLocations::find()->where(['platform_id' => $v['platform_id'], 'driver_id' => $driver->user_id])
                ->andWhere(['>=', 'created_at', $time1])->andWhere(['<=', 'created_at', $time2])->count();
            for ($i = 0; $i < $total - 1; $i++) {

                $list = DeliveryLocations::find()
                    ->select('longitude,latitude')->where(['platform_id' => $v['platform_id'], 'driver_id' => $driver->user_id])
                    ->andWhere(['>=', 'created_at', $time1])->andWhere(['<=', 'created_at', $time2])
                    ->offset($i)->limit(2)->asArray()->all();
                $l1[0] = $list[0]['longitude'];
                $l1[1] = $list[0]['latitude'];
                $l2[0] = $list[1]['longitude'];
                $l2[1] = $list[1]['latitude'];
                //var_dump($list);
                $d=Utils::distance($l1, $l2);
                $d=$d>0?$d:0;
                $distance += $d;

            }


            $min = DeliveryLocations::find()->select('created_at')
                ->where(['platform_id' => $v['platform_id'], 'driver_id' => $driver->user_id])
                ->andWhere(['>=', 'created_at', $time1])->andWhere(['<', 'created_at', $time2])->orderBy('created_at asc')->asArray()->one();

            $max = DeliveryLocations::find()->select('created_at')
                ->where(['platform_id' => $v['platform_id'], 'driver_id' => $driver->user_id])
                ->andWhere(['>=', 'created_at', $time1])->andWhere(['<', 'created_at', $time2])->orderBy('created_at desc')->asArray()->one();

            $real_duration = $max['created_at'] - $min['created_at'];

            $real_distance = round($distance, 2);

            $real_distance = $real_distance > 0 ? $real_distance : 0;

            Delivery::updateAll(['real_distance' => $real_distance, 'real_duration' => $real_duration], ['id' => $v['id']]);

            DriverClockList::updateAll(['distance' => $real_distance, 'duration' => $real_duration],
                ['platform_id' => $v['platform_id'], 'clock_date' => $date, 'driver_id' => $v['driver_id']]);


        }


    }

    public function actionTest()
    {
        $total = DeliveryLocations::find()->where(['driver_id' => 30])->count();
        $distance = 0;
        for ($i = 0; $i < $total - 1; $i++) {

            $list = DeliveryLocations::find()
                ->select('longitude,latitude')->where(['driver_id' => 28])
                ->offset($i)->limit(2)->asArray()->all();
            $l1[0] = $list[0]['longitude'];
            $l1[1] = $list[0]['latitude'];
            $l2[0] = $list[1]['longitude'];
            $l2[1] = $list[1]['latitude'];
            //var_dump($list);
            $distance += Utils::distance($l1, $l2);

        }
        echo $distance;
    }


}