<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\base\models\Config */

$this->title = '报警配置';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-xs-5">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

                    <div class="config-form">

                        <?php $form = ActiveForm::begin([ 'id'=>$model->formName(),'enableAjaxValidation'=>true,'options'=>['class'=>'form-horizontal']
                        ]); ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">低</label>

                            <div class="col-sm-10">
                                <div class="col-xs-4">

                                <input type="text" class="form-control"  name="low[]" value="<?php echo $data['low'][0];?>" required placeholder="等级1">
                                    </div>
                                <div class="col-xs-4">

                                <input type="text" class="form-control"   name="low[]" value="<?php echo $data['low'][1];?>" required placeholder="等级2">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-2 control-label">中</label>

                            <div class="col-sm-10">
                                <div class="col-xs-4">

                                    <input type="text" class="form-control"  value="<?php echo $data['middle'][0];?>" name="middle[]" required placeholder="等级1">
                                </div>
                                <div class="col-xs-4">

                                    <input type="text" class="form-control"  value="<?php echo $data['middle'][0];?>" name="middle[]" required placeholder="等级2">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label  class="col-sm-2 control-label">高</label>

                            <div class="col-sm-10">
                                <div class="col-xs-4">

                                    <input type="text" class="form-control" name="high[]"  value="<?php echo $data['high'][0];?>" required placeholder="等级1">
                                </div>
                                <div class="col-xs-4">

                                    <input type="text" class="form-control"  name="high[]"  value="<?php echo $data['high'][0];?>" required placeholder="等级2">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">确定</button>

                        </div>

                        <?php ActiveForm::end(); ?>




                    </div>

                </div></div></div></div></section>


<?php \common\widgets\JsBlock::begin() ?>

<script>

    ajax_form('<?php echo $model->formName();?>');



</script>
<?php \common\widgets\JsBlock::end() ?>
