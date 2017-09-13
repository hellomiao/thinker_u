<?php

namespace app\home\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\home\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\home\models\Order`.
 */
class OrderSearch extends Order
{

    public $keywords;

    public $start_ctime;

    public $end_ctime;

    public $username;

    public $delivery_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_ctime', 'end_ctime', 'keywords', 'delivery_date','username'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return array_merge(parent::rules(), [
            'start_ctime' => '下单开始时间',
            'end_ctime' => '下单结束时间',
            'delivery_date' => '送货日期',
            'username' => '操作员',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->from(Order::tableName() . ' as t');
        $query->joinWith(['customer','user']);


        $query->where(['t.platform_id'=>$params['platform_id']]);
        // add conditions that should always apply here





        if ($params['user_id']) {
            $query->andWhere(['t.user_id' => $params['user_id']]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];


        if ($params['delivery_date']&&!$params['delivery_date']) {
            $query->andWhere(['t.delivery_date' => $params['delivery_date']]);
        }

        $this->load($params);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        if ($this->start_ctime) {
            $query->andFilterWhere(['>=', 't.created_at', strtotime($this->start_ctime)]);

        }
        if ($this->end_ctime) {
            $query->andFilterWhere(['<=', 't.created_at', strtotime($this->end_ctime)]);

        }

        $query->andFilterWhere(['t.delivery_date' => $this->delivery_date]);

        $query->andFilterWhere(['or', ['like', 'customer.code', $this->keywords],
            ['like', 'customer.name', $this->keywords]]);

        $query->andFilterWhere(['or', ['like', 'user.username', $this->username],
            ['like', 'user.realname', $this->username]]);

        return $dataProvider;
    }
}
