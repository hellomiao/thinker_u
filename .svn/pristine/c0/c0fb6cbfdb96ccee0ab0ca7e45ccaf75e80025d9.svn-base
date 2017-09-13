<?php

namespace app\admin\models;

use Yii;

/**
 * This is the model class for table "{{%apis}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $method
 * @property string $params
 * @property string $result
 * @property string $tips
 * @property integer $created_at
 */
class Apis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apis}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name','className'], 'string', 'max' => 50],
            [['method'], 'string', 'max' => 20],
            [['params', 'tips'], 'string', 'max' => 500],
            [['result','tips'], 'string', 'max' => 1000],
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
            'className' => '类名',
            'method' => '方法',
            'params' => '参数',
            'result' => '结果',
            'tips' => '说明',
            'created_at' => '创建时间',
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


    public function getRules(){
        $newClass=new $this->className();
        return $newClass->getRules();
    }
}
