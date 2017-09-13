<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Admin */

$this->title = '资料设置';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="row">
    <div class="col-xs-12">


        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">



                <?= $this->render('_info_form', [
                    'model' => $model,
                ]) ?>

            </div></div></div>
    </section>
