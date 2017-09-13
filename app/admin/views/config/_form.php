<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\base\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin([ 'id'=>$model->formName(),'enableAjaxValidation'=>true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord){$model->status_is=1;}?>
    <?= $form->field($model, 'status_is')->dropDownList([ 0 => '关闭', 1 => '启用', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','name'=>'commit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \common\widgets\JsBlock::begin() ?>

<script>

    ajax_form('<?php echo $model->formName();?>','<?php echo \yii\helpers\Url::to(['index']);?>');



</script>
<?php \common\widgets\JsBlock::end() ?>

