<?php

namespace app\admin\models;

use Yii;

/**
 * This is the model class for table "{{%admin_logger}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $catalog
 * @property string $url
 * @property string $intro
 * @property string $ip
 * @property integer $create_time
 */
class AdminLogger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_logger}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create_time'], 'integer'],
            [['catalog', 'intro'], 'string'],
            [['url'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'user_id']);
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
}
