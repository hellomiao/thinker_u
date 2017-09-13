<?php

namespace app\admin\models;

use Yii;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property integer $id
 * @property integer $attach_id
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    public function getAttach()
    {
        return $this->hasOne(Attachments::className(), ['id' => 'attach_id']);
    }


    public function getAttachPath()
    {

        $path = \Yii::getAlias('@web/static/docs') . '/' . $this->attach->path;

        return $path;
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attach_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attach_id' => '图片',
        ];
    }
}
