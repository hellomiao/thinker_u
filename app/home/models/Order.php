<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $delivery_id
 * @property integer $cid
 * @property integer $driver_id
 * @property integer $order_num
 * @property integer $num
 * @property string $delivery_date
 * @property string $delivery_time
 * @property string $note
 * @property integer $start_time
 * @property integer $end_time
 * @property double $distance
 * @property integer $duration
 * @property integer $status
 * @property integer $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'cid'])->from(['customer' => Customer::tableName()]);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->from(['user' => User::tableName()]);
    }

    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_first','cid','user_id','platform_id', 'delivery_id', 'driver_id', 'order_num', 'num', 'start_time', 'end_time', 'duration', 'status', 'created_at','delivery_times'], 'integer'],
            [['delivery_date'], 'required'],
            [['delivery_date'], 'safe'],
            [['distance'], 'number'],
            [['delivery_time','delivery_time_end'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform_id' => '平台ID',
            'delivery_id' => 'Delivery ID',
            'driver_id' => 'Driver ID',
            'cid' => '配送客户',
            'order_num' => '配送顺序',
            'num' => '送货数量',
            'delivery_date' => '送货日期',
            'delivery_time' => '配送开始时间',
            'delivery_time_end' => '配送结束时间',
            'note' => '备注',
            'start_time' => '到达时间',
            'end_time' => '离开时间',
            'distance' => '配送里程',
            'duration' => '配送时间',
            'status' => '配送状态',
            'created_at' => '生成时间',
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

    public function getStatus()
    {
        $arr = [0 => '待分配', 1 => '已分配', 2 => '已配送'];

        return $arr[$this->status];

    }
}
