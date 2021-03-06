<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%driver}}".
 *
 * @property integer $id
 * @property integer $platform_id
 * @property integer $user_id
 * @property string $username
 * @property integer $phone
 * @property string $car_type
 * @property string $car_number
 * @property string $inner_size
 * @property string $outer_size
 * @property string $limit_days
 * @property integer $created_at
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->from(['user' => User::tableName()]);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['platform_id', 'user_id', 'created_at'], 'integer'],
            [['username', 'car_type', 'inner_size', 'outer_size'], 'string', 'max' => 100],
            [['car_number'], 'string', 'max' => 50],
            [['longitude', 'latitude'], 'safe'],
            [['limit_days'], 'safe'],
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'unique','message'=>'{attribute}已经被占用了'],
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
            'user_id' => '关联账号',
            'username' => '司机名称',
            'phone' => '联系方式',
            'car_type' => '车辆型号',
            'longitude' => '经度',
            'latitude' => '纬度',
            'car_number' => '车牌号',
            'inner_size' => '内控尺寸（米）',
            'outer_size' => '外厢尺寸（米）',
            'limit_days' => '车辆限行时间',
            'created_at' => '录入时间',
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


    public static function getWeek()
    {
        return [0=>'周日',1 => '周一', 2 => '周二', 3 => '周三', 4 => '周四', 5 => '周五',6=>'周六'];
    }

    public function getWeekStr()
    {
        if ($this->limit_days != 0) {
            $str = '';
            $week = self::getWeek();
            $arr = explode(',', $this->limit_days);
            foreach ($arr as $v) {
                $str .= $week[$v] . ',';
            }

            return substr($str, 0, -1);
        }

        return '无';
    }

    public function checkLimit()
    {
        $flag = false;
        $w = date("w");
        if ($this->limit_days != 0) {
            $arr = explode(',', $this->limit_days);
            if (in_array($w, $arr)) {
                $flag = true;
            }

        }
        return $flag;
    }

    public function getGoods()
    {
        $listTmp = DriverGoods::find()->where(['driver_id' => $this->id])->all();
        $list = [];
        foreach ($listTmp as $key => $val) {
            $list[$key]['id'] = $val->goods->id;
            $list[$key]['name'] = $val->goods->name;
            $list[$key]['value'] = $val->num;
        }
        return $list;
    }


}
