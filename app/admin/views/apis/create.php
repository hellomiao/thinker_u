<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\admin\models\apis */

$this->title = '添加api';
$this->params['breadcrumbs'][] = ['label' => 'api管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-8">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div></div></div></section>
