<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property string $name
 * @property integer $created_at
 */
class Goods extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => '名称',
            'created_at' => '录入时间',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($insert) {
                $this->created_at = time();

            }

            return true;
        } else {
            return false;
        }
    }

    public function getGoodsNum($driver_id){

        $row = DriverGoods::find()->where(['driver_id'=>$driver_id,'goods_id'=>$this->id])->one();

        return $row['num']?$row['num']:0;

    }
}
