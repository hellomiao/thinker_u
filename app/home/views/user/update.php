<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Admin */

$this->title = '更新系统用户';
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
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

            </div></div></div>
    </section>
