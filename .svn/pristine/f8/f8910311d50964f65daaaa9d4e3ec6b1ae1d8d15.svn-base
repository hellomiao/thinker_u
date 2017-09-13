<?php

namespace app\admin\models;

use Yii;

/**
 * This is the model class for table "{{%platform_user}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $phone
 * @property integer $created_at
 */
class PlatformUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platform_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['longitude','latitude','address'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'longitude' => '经度',
            'latitude' => '纬度',
            'address' => '配送地址',
            'username' => '联系人',
            'phone' => '联系电话',
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
}
