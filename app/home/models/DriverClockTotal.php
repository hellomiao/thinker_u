<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%driver_clock_total}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property string $clock_date
 * @property integer $total_num
 * @property integer $in_num
 * @property integer $leave_num
 */
class DriverClockTotal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver_clock_total}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'total_num', 'in_num', 'leave_num'], 'integer'],
            [['clock_date'], 'safe'],
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
            'clock_date' => '考勤日期',
            'total_num' => '应考勤人次',
            'in_num' => '上班打卡人次',
            'leave_num' => '下班打卡人次',
        ];
    }

    public function getTotalDriver(){

        return Driver::find()->where(['platform_id'=>$this->platform_id])->count();
    }
}
