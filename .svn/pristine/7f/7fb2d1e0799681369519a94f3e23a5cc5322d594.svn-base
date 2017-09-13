<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\home\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'enableAjaxValidation'=>true]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'value'=>'']) ?>



    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php  \common\widgets\JsBlock::begin();?>
<script>
    $(function(){
        ajax_form('<?php  echo $model->formName();?>','<?php  echo Yii::$app->request->referrer;?>');
    })

</script>
<?php  \common\widgets\JsBlock::end();?>


