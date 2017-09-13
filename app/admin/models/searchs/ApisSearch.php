<?php

namespace app\admin\models\searchs;

use app\admin\models\Apis;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class ApisSearch extends Apis
{


    public function rules()
    {
        return [
            [['name','method'], 'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {


        $query = Apis::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'method', $this->method]);


        return $dataProvider;
    }
}
?>