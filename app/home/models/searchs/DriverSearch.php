<?php

namespace app\home\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\home\models\Driver;

/**
 * DriverSearch represents the model behind the search form about `app\home\models\Driver`.
 */
class DriverSearch extends Driver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'car_type', 'car_number', 'phone', 'limit_days'], 'safe'],
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
        $query = Driver::find();

        $query->where(['platform_id'=>$params['platform_id']]);

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
        $query->andFilterWhere([

            'phone' => $this->phone,

        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'car_type', $this->car_type])
            ->andFilterWhere(['like', 'car_number', $this->car_number])
            ->andFilterWhere(['like', 'limit_days', $this->limit_days]);

        return $dataProvider;
    }
}
