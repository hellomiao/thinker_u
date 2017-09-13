<?php

namespace app\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\admin\models\Admin;

class AdminSearch extends Admin
{


    public function rules()
    {
        return [
            [['username','status_is','group_id','realname'], 'safe'],  //这里nickname一定要写，根据你自己的命名去写，不写的话搜索框出不来
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {


        $query = Admin::find();
        $query->joinWith(['group']);


        if($params['group_id']>0){
            $query->andWhere(['group_id'=>$params['group_id']]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->defaultOrder=['create_time'=>SORT_DESC];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'realname', $this->realname]);
        $query->andFilterWhere([$this->tableName().'.status_is'=>$this->status_is]);
        if($this->group_id) {
            $query->andFilterWhere(['group_id' => explode(",", $this->group_id)]);
        }




        return $dataProvider;
    }
}
?>