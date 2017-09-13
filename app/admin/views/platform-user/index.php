<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\searchs\PlatformUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '平台客户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">


                    <p>
                        <?= Html::a('添加客户', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [


                            'id',
                            'name',
                            'username',
                            'phone',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],

                            ['class' => 'app\admin\components\ActionColumn', 'template' => '{update} {delete} {account}', 'buttons' => [
                                'account' => function ($url, $model) {
                                    $url = \yii\helpers\Url::to(['user/index','platform_id'=>$model->id]);
                                    return Html::a('<span class="fa fa-fw fa-user"></span>', $url, [
                                        'title' => '管理账号','class' => 'btn btn-xs bg-blue',
                                        'style' => 'width:40px'
                                    ]);
                                }
                            ]],

                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>
