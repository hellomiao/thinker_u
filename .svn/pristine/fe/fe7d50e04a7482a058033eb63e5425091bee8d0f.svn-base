<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>




    <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'enableAjaxValidation'=>true,'options'=>['class' => 'form-horizontal'],
        'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ]]); ?>
<div class="box-body">


    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>'']) ?>

    <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>



</div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \common\widgets\JsBlock::begin();?>
<script>
    $(function(){
        ajax_form('<?php echo $model->formName();?>','<?php echo \yii\helpers\Url::to(['index']);?>');
    })

</script>
<?php \common\widgets\JsBlock::end();?>


