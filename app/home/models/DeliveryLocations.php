<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%delivery_locations}}".
 *
 * @property integer $id
 * @property integer $delivery_id
 * @property double $longitude
 * @property double $latitude
 * @property integer $created_at
 */
class DeliveryLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%delivery_locations}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id','order_id','delivery_id', 'created_at','driver_id'], 'integer'],
            [['longitude', 'latitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_id' => 'Delivery ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'created_at' => 'Created At',
        ];
    }
}
