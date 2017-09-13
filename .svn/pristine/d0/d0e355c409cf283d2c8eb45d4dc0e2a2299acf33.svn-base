<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\apis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apis-form">

    <?php $form = ActiveForm::begin([ 'id'=>$model->formName(),
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'className')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'params')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'result')->textarea(['rows' => 5]) ?>

    <?=
    $form->field($model, 'tips')->widget(app\base\widgets\thinker\wangeditor\Wangeditor::className(),[
        'style'=>"height:500px",
        'menu'=>['source',
            '|',
            'bold',
            'underline',
            'italic',
            'strikethrough',
            'eraser',
            'forecolor',
            'bgcolor',
            '|',
            'quote',
            'fontfamily',
            'fontsize',
            'head',
            'unorderlist',
            'orderlist',
            'alignleft',
            'aligncenter',
            'alignright',
            '|',
            'link',
            'unlink',
            'table',
            '|',
            'img',
            'insertcode',
            '|',
            'undo',
            'redo',
            'fullscreen'],
        'uploadImgUrl'=>yii\helpers\Url::to(['upload','action'=>'uploadimage']),
    ]);?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php \common\widgets\JsBlock::begin() ?>

<script>

    ajax_form('<?php echo $model->formName();?>','<?php echo \yii\helpers\Url::to(['index']);?>');



</script>
<?php \common\widgets\JsBlock::end() ?>
