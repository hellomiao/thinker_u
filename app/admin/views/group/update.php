<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\admin\models\AdminGroup */

$this->title = '更新角色: ' . ' ' . $model->group_name;
$this->params['breadcrumbs'][] = ['label' => '用户组', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<section class="content">
<div class="row">
    <div class="col-xs-12">




            <!-- /.box-header -->
            <div class="box-body">



                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

            </div></div>
    </section>