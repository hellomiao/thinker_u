<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\searchs\PlatformUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="platform-user-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get','options' => ['data-pjax' => true]
    ]); ?>
    <div class="row">
            <div class='col-xs-2'><?= $form->field($model, 'id') ?></div>

    <div class='col-xs-2'><?= $form->field($model, 'name') ?></div>

    <div class='col-xs-2'><?= $form->field($model, 'username') ?></div>

    <div class='col-xs-2'><?= $form->field($model, 'phone') ?></div>

    <div class='col-xs-2'><?= $form->field($model, 'created_at') ?></div>

    </div>
    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary search-btn']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
