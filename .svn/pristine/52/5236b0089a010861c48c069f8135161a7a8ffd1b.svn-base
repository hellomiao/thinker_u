<?php

namespace app\admin\models;

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
            [['name', 'data', 'info'], 'required'],
            [['name'], 'string', 'max' => 50],
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
            'name' => 'Name',
            'data' => 'Data',
            'info' => 'Info',
        ];
    }
}
