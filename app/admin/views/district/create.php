<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\admin\models\District */

$this->title = "添加";
$this->params['breadcrumbs'][] = ['label' => '行政区域', 'url' => ['index']];;
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
