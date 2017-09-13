<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\base\models\Config */

$this->title = '创建配置';
$this->params['breadcrumbs'][] = ['label' => '参数配置', 'url' => ['index']];
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
