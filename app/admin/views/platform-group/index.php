<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '平台角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

                    <p>
                        <?= Html::a('创建角色', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',

                            'group_name',
                            [

                                'attribute' => 'status_is',
                                'value' => function ($data) {
                                    return \app\admin\models\Admin::getStatus()[$data->status_is];
                                }
                            ],

                            ['class' => 'app\admin\components\ActionColumn', 'template' => '{update} {set} {delete}', 'buttons' => [
                                'delete' => function ($url, $model) {
                                    if (!in_array($model->id,[1,2,3,4])) {
                                        return Html::a('<span class="fa fa-remove"></span>', $url, [
                                            'title' => '删除',   'class' => 'btn btn-xs bg-red',
                                            'style' => 'width:40px'
                                        ]);
                                    } else {
                                        return null;
                                    }
                                },
                                'set' => function ($url, $model) {
                                    if (!in_array($model->id,[1,2])) {
                                        return Html::a('<span class="glyphicon glyphicon-wrench"></span>', \yii\helpers\Url::to(['set-acl', 'id' => $model->id]), [
                                            'title' => '设置权限',   'class' => 'btn btn-xs bg-red',
                                            'style' => 'width:40px'
                                        ]);
                                    } else {
                                        return null;
                                    }
                                }
                            ],],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</section>
