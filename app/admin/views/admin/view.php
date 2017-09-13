<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Admin */

$this->title = '查看'.$model->username;
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="row">
    <div class="col-xs-12">


        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'realname',
            'email:email',
            'qq',
            'mobile',
            'last_login_ip',
            [
                'attribute' => 'last_login_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],

            [

              'attribute'=>'status_is',
                'value'=>\app\admin\models\Admin::getStatus()[$model->status_is],
            ],

            'group_id',
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
        </div></div>

    </section>