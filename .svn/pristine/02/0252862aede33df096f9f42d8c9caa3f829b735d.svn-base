<?php

namespace app\base\models;

use Yii;

/**
 * This is the model class for table "w_config".
 *
 * @property integer $id
 * @property string $name
 * @property string $data
 * @property string $info
 */
class Config extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'data'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['status_is'], 'integer'],
            [['name'], 'unique'],
            [['data'], 'string'],
            [['data', 'info'], 'string', 'max' => 500]
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
            'data' => '数据',
            'info' => '备注',
            'status_is'=>'状态'
        ];
    }

    public static function getStatus(){
        return [
            '' => '全部',
            self::STATUS_ACTIVE => '开启',
            self::STATUS_DISABLE => '关闭',
        ];
    }


    public function getData($name){

        $row=$this->find()->where(['name'=>$name])->one();
        return $row->data;

    }
}
