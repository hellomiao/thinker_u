<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%delivery}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $driver_id
 * @property double $distance
 * @property integer $duration
 * @property integer $num
 * @property integer $created_at
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery}}';
    }

    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'driver_id', 'duration', 'num', 'created_at','real_duration'], 'integer'],
            [['distance','real_distance'], 'number'],
            [['delivery_date', 'name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform_id' => '平台ID',
            'name' => '配送单名称',
            'driver_id' => 'Driver ID',
            'distance' => '配送里程',
            'duration' => '配送时长',
            'num' => '送货总量',
            'delivery_date' => '配送日期',
            'created_at' => 'Created At',
        ];
    }


    public function getOrderNum($platform_id, $status = '')
    {

        switch ($status) {
            case 1:
                $num = Order::find()->where(['platform_id' => $platform_id, 'delivery_id' => $this->id, 'status' => 1])->count();
                break;
            case 2:
                $num = Order::find()->where(['platform_id' => $platform_id, 'delivery_id' => $this->id, 'status' => 2])->count();
                break;
            default:
                $num = Order::find()->where(['platform_id' => $platform_id, 'delivery_id' => $this->id])->count();
                break;
        }
        return $num;

    }
}
