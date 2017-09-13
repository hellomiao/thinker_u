<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title='员工回收站列表';
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<section class="content">
<div class="row">
    <div class="col-xs-12">


        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">


    <p>
        <?= Html::a('全部删除', ['create'], ['class' => 'btn btn-danger ajax-confirm','data-message'=>'是否要全部删除员工?不可还原']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $adminSearch,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'realname',
            'email:email',
            // 'qq',
             'mobile',

            // 'hash',
            [

                'attribute'=>'status_is',
                'filter' => Html::activeDropDownList($adminSearch, 'status_is', \app\admin\models\Admin::getStatus(), ['class' => 'form-control']),
                'value'=>function($data){
                    return \app\admin\models\Admin::getStatus()[$data->status_is];
                }
            ],
            [
                'label'=>'用户组',
                'filter' => Html::activeDropDownList($adminSearch, 'group_id', \app\admin\models\AdminGroup::getSelectList(),['class' => 'form-control']),
                'attribute' => 'group_id',
                'value'=>function($data){
                    return $data->getGroupName();
                }
            ]
            ,
            // 'create_time:datetime',

            ['class' => 'app\admin\components\ActionColumn', 'template'=>'{restore} {delete}','buttons' => [
                'restore' => function ($url, $model) {
                    $url =\yii\helpers\Url::to(['restore','id'=>$model->id]);
                    return Html::a('<span class="fa  fa-circle-o-notch"></span>', $url, [
                        'title' => '还原','data-message'=>'是否要还原此员工?','data-btext'=>'还原','class'=>'ajax-confirm'
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url =\yii\helpers\Url::to(['redel','id'=>$model->id]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => '删除','data-message'=>'是否要删除此员工?'
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