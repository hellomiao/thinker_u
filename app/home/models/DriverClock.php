<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%driver_clock}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $driver_id
 * @property integer $type
 * @property double $longitude
 * @property double $latitude
 * @property string $address
 * @property string $pic
 * @property integer $created_at
 */
class DriverClock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver_clock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'driver_id', 'type', 'created_at'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['address', 'pic'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform_id' => 'Platform ID',
            'driver_id' => 'Driver ID',
            'type' => '0上班 1下班',
            'longitude' => '经度',
            'latitude' => '纬度',
            'address' => '打开地点',
            'pic' => '打开照片',
            'created_at' => '打开时间',
        ];
    }

    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }
}
