<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\PlatformUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="platform-user-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'enableAjaxValidation'=>true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">

        <div id="container"  style="height: 300px"  class="map col-xs-12" tabindex="0"></div>

    </div>
    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript" src='//webapi.amap.com/maps?v=1.3&key=5b605ef068fbd7b2ecdf645a5200b0c0&plugin=AMap.ToolBar'></script>
<!-- UI组件库 1.0 -->
<script src="//webapi.amap.com/ui/1.0/main.js"></script>
<?php  \common\widgets\JsBlock::begin();?>
<script>
    $(function(){
        ajax_form('<?php  echo $model->formName();?>','<?php  echo \yii\helpers\Url::to(['index']);?>');
    })
    AMapUI.loadUI(['misc/PositionPicker'], function(PositionPicker) {
        var map = new AMap.Map('container', {
            zoom: 16,
            scrollWheel: false
        })
        var positionPicker = new PositionPicker({
            mode: 'dragMarker',
            map: map
        });
        AMap.plugin('AMap.Geocoder',function(){
            var geocoder = new AMap.Geocoder({

            });
            $("#platformuser-address").blur(function(e){
                var address = $(this).val();
                geocoder.getLocation(address,function(status,result){

                    console.log(result)
                    if(status=='complete'&&result.geocodes.length){
                        console.log(result.geocodes[0].location)
                        positionPicker.start(result.geocodes[0].location);

                    }
                })
            });

            $("#platformuser-address").blur();


        });

        positionPicker.on('success', function(positionResult) {

            console.log(positionResult);
            var lng =positionResult.position.lng,lat=positionResult.position.lat,address= positionResult.address;
            $("#platformuser-longitude").val(lng);
            $("#platformuser-latitude").val(lat);
//            $("#customer-address").val(address);

        });
        positionPicker.on('fail', function(positionResult) {
            $("#platformuser-longitude").val('');
            $("#platformuser-latitude").val('');
        });

        positionPicker.start();
        map.panBy(0, 1);

        map.addControl(new AMap.ToolBar({
            liteStyle: true
        }))
    });
</script>
<?php  \common\widgets\JsBlock::end();?>


