<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '行政区域';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                    <p>
                        <?= Html::a('添加', ['create','id'=>$id,'level'=>$level], ['class' => 'btn btn-success']) ?>
                    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
              'label'=>'名称',
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>function($data){
                    $name = $data->name;
                    if($data->level<3) {
                        return Html::a($name, ['index', 'id' => $data->id, 'level' => $data->level + 1]);
                    }else{
                        return $name;
                    }
                }

            ],
            ['class' => 'app\admin\components\ActionColumn','template' => '{update}']

        ],
    ]); ?>
</div></div></div></div></section>
