<?php

namespace app\home\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\home\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `app\home\models\Customer`.
 */
class CustomerSearch extends Customer
{
    public $keywords;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at'], 'integer'],
            [['code', 'name', 'tel1', 'tel2', 'address','keywords'], 'safe'],
        ];
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
        $query = Customer::find();


        $query->where(['platform_id'=>$params['platform_id']]);

        if ($params['user_id']) {
            $query->andWhere(['user_id' => $params['user_id']]);
        }


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->defaultOrder=['created_at'=>SORT_DESC];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions


        $query->andFilterWhere(['or',['like','code',$this->keywords],['like','name',$this->keywords]]);
        $query->andFilterWhere(['status'=>$this->status]);
        return $dataProvider;
    }
}
