<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\AdminGroup */
/* @var $form yii\widgets\ActiveForm */
?>




    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">快速添加</h3>
                </div>
<?php $form = ActiveForm::begin([ 'id'=>$model->formName(),
  ]); ?>
<div class="box-body">

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>


    <?php if($model->isNewRecord){$model->status_is='Y';}?>
    <?= $form->field($model, 'status_is')->dropDownList([ 'Y' => '启用', 'N' => '禁用', ]) ?>


    <input type="hidden" id="group_acl_ids" name="acl_ids"/>


</div>
<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
</div>
            </div>





<?php ActiveForm::end(); ?>
    </div>
<?php \common\widgets\JsBlock::begin() ?>

<script>

    ajax_form('<?php echo $model->formName();?>','<?php echo \yii\helpers\Url::to(['index']);?>');



</script>
<?php \common\widgets\JsBlock::end() ?>

