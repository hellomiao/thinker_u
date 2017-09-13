<?php

namespace app\home\models;

use app\admin\models\District;
use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $tel1
 * @property string $tel2
 * @property string $address
 * @property integer $status
 * @property integer $created_at
 * @property integer $province
 * @property integer $city
 * @property integer $area
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at','province','city','area','platform_id','user_id'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['longitude','latitude'], 'safe'],
            [['tel1', 'tel2'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id'=>'业务员',
            'province'=>'省',
            'city'=>'市',
            'area'=>'区',
            'code' => '客户编号',
            'longitude' => '经度',
            'latitude' => '纬度',
            'name' => '客户名称',
            'tel1' => '联系方式1',
            'tel2' => '联系方式2',
            'address' => '详细地址',
            'status' => '客户状态',
            'created_at' => '录入时间',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->from(['user' => User::tableName()]);
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

    public function getStatus($type=0)
    {
        $arr = [0 => '送货客户', 1 => '沉睡客户'];
        if($type==1) {
           return $arr;
        }
        return $arr[$this->status];
    }

    public function getAddr(){
//        $province=District::findOne($this->province);
//        $city=District::findOne($this->city);
//        $str =$province->name.$city->name;
//        if($this->area){
//            $area = District::findOne($this->area);
//            $str.=$area->name;
//        }

        return $this->address;
    }
}
