<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
$this->title="平台客户[{$platformUser->name}]账号列表";
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
                        <?= Html::a('添加账号', ['create','platform_id'=>$platform_id], ['class' => 'btn btn-success']) ?>

                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [


                            'id',
                            'username',

                            // 'qq',
                            'mobile',

                            // 'create_time:datetime',

                            ['class' => 'app\admin\components\ActionColumn','template'=>'{update} {delete}'],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>

    </div>
</section>