<?php

namespace app\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%district}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $level
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'level'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => '名称',
            'level' => 'Level',
        ];
    }

    /**
     * @param $pid
     * @return array
     */
    public function getList($pid)
    {
        $model = self::findAll(array('parent_id'=>$pid));
        return ArrayHelper::map($model, 'id', 'name');
    }
}
