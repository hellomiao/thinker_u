<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\base\models\Config */

$this->title = "更新配置[{$model->name}]";
$this->params['breadcrumbs'][] = ['label' => '参数配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div></div></div></section>
