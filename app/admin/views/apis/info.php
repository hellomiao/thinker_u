<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\apis */

$this->title = '编辑api说明';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                    <?php $form = ActiveForm::begin(['id'=>'ConfigForm']) ?>
                    <div class="form-group">
                    <?php echo \app\base\widgets\thinker\wangeditor\Wangeditor::widget([
                        'name'=>'info',
                        'style'=>"height:500px",
                        'value'=>$info,
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
                    </div>
                    <div class="form-group">
                        <button id="adminacl-add_btn" class="btn btn-success">提交</button>

                    </div>
                    <?php ActiveForm::end();?>
                </div></div></div></div></section>

<?php \common\widgets\JsBlock::begin();?>
<script>
    ajax_form('ConfigForm');
</script>
<?php \common\widgets\JsBlock::end();?>

