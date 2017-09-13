<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%driver_clock_list}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $driver_id
 * @property double $in_longitude
 * @property double $in_latitude
 * @property string $in_address
 * @property string $in_pic
 * @property integer $in_time
 * @property double $out_longitude
 * @property double $out_latitude
 * @property string $out_address
 * @property string $out_pic
 * @property integer $out_time
 */
class DriverClockList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver_clock_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'driver_id', 'in_time', 'out_time','duration'], 'integer'],
            [['in_longitude', 'in_latitude', 'out_longitude', 'out_latitude'], 'number'],
            [['in_address', 'in_pic', 'out_address', 'out_pic'], 'string', 'max' => 200],
            [['clock_date','distance'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clock_date' => '考勤日期',
            'platform_id' => 'Platform ID',
            'driver_id' => 'Driver ID',
            'in_longitude' => 'In Longitude',
            'in_latitude' => 'In Latitude',
            'in_address' => '打卡地点',
            'in_pic' => '打卡照片',
            'in_time' => '上班打卡',
            'out_longitude' => 'Out Longitude',
            'out_latitude' => 'Out Latitude',
            'out_address' => '打卡地点',
            'out_pic' => '打卡照片',
            'out_time' => '下班打卡',
        ];
    }

    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id'])->from(['driver' => Driver::tableName()]);
    }
}
