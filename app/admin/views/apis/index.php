<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'api列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

                    <p>
                        <?= Html::a('添加api', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('编辑api说明', ['info'], ['class' => 'btn btn-info']) ?>
                    </p>


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $apisSearch,
                        'columns' => [

                            [
                              'label'=>'名称',
                                'attribute'=>'name',
                                'format'=>'raw',
                                'value'=>function($data){

                                    return Html::a($data->name,['view','id'=>$data->id]);

                                }
                            ],

                            'name',
                            'method',
//            'params',
//            'result',
                            // 'tips',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],

                            ['class' => 'app\admin\components\ActionColumn'],
                        ],
                    ]); ?>


                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">说明</h3>
                </div>
                <div class="box-body">
                    <?php echo $info; ?>

                </div>

            </div>
        </div>
</section>
