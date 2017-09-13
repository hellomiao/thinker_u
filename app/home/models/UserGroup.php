<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%user_group}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $group_name
 * @property string $status_is
 * @property integer $create_time
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    const STATUS_ACTIVE = 'Y';
    const STATUS_DISABLE = 'N';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time','platform_id'], 'integer'],
            [['group_name'], 'required'],
            [['status_is'], 'string'],
            [['group_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => '组名称',
            'status_is' => '状态',
            'create_time' => '录入时间',
        ];
    }

    public static function getStatus(){
        return [
            '' => '全部',
            self::STATUS_ACTIVE => '正常',
            self::STATUS_DISABLE => '禁止',
        ];
    }

    public static function  getSelectList(){
        $list = self::findAll(['status_is'=>'Y']);
        $data = [""=>"请选择"];
        foreach($list as $key=>$val){

            $data[$val->id]=$val->group_name;
        }

        return $data;

    }
}
