<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%user_logger}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $catalog
 * @property string $url
 * @property string $intro
 * @property string $ip
 * @property integer $create_time
 */
class UserLogger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_logger}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create_time','platform_id'], 'integer'],
            [['intro'], 'string'],
            [['catalog'], 'string', 'max' => 10],
            [['url'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户id',
            'catalog' => '类型',
            'url' => 'url',
            'intro' => '操作',
            'ip' => '操作ip',
            'create_time' => '操作时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
