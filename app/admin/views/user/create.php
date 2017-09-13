<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\home\models\User */

$this->title = "添加平台客户[{$platformUser->name}]账号";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
