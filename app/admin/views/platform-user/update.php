<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\admin\models\PlatformUser */

$this->title = "更新客户[{$model->name}]";
$this->params['breadcrumbs'][] = ['label' => '平台客户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
