<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\District */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="district-form">

    <?php $form = ActiveForm::begin([ 'id'=>$model->formName(),'enableAjaxValidation'=>true
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'required'=>true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '确定', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php \common\widgets\JsBlock::begin() ?>

<script>

    ajax_form('<?php echo $model->formName();?>','<?php echo \Yii::$app->request->referrer;?>');



</script>
<?php \common\widgets\JsBlock::end() ?>

