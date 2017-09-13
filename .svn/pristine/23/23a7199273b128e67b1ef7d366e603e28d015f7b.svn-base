<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table-bordered{
        table-layout: fixed;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [


            'id',
            'admin.username',
            'catalog',
            'intro:ntext',
             'ip',
            [
                'attribute' => 'create_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],


        ],
    ]); ?>

</div>
            </div>
        </div>
    </div></section>
