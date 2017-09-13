<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%driver_goods}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $driver_id
 * @property integer $goods_id
 * @property integer $num
 * @property integer $created_at
 */
class DriverGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'driver_id', 'goods_id', 'num', 'created_at'], 'integer'],
        ];
    }


    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
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
            'goods_id' => 'Goods ID',
            'num' => '数量',
            'created_at' => 'Created At',
        ];
    }
}
