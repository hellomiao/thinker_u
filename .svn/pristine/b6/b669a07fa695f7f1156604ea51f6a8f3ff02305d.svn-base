<?php

app\admin\assets\AdminAsset::register($this);
app\admin\assets\AdminAsset::addScript($this, '/js/jsonFormater.js');
app\admin\assets\AdminAsset::addCss($this, '/css/jsonFormater.css');

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\admin\models\apis */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'api列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">


                <!-- /.box-header -->
                <div class="box-body">


                    <p>
                        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            [
                                'attribute' => 'method',
                                'format' => 'raw',
                                'value' => '<span class="label label-primary" style="font-size: 14px">'.$model->method.'</span>'
                            ],
                            'className',
                            [
                                'attribute' => 'params',
                                'format' => 'raw',
                                'value' => '<pre contenteditable="true"><div id="params_txt">' . \app\base\lib\Utils::jsonFormat(json_decode($model->params, true)) . '</div></pre>'
                            ],
                            [
                                'attribute' => 'result',
                                'format' => 'raw',
                                'value' => '<pre contenteditable="false"><div id="time_txt"></div><div id="result_txt">' . \app\base\lib\Utils::jsonFormat(json_decode($model->result, true)) . '</div></pre>'
                            ],
                            [
                                'attribute' => 'tips',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => $model->created_at > 0 ? date("Y-m-d H:i:s", $model->created_at) : ""
                            ],
                        ],
                    ]) ?>


                </div>




                <div class="box-footer">
                    <?= Html::button('测试', ['class' => 'btn btn-danger', 'id' => 'commit_test']) ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">参数规则</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>

                            <th>参数</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>说明</th>
                            <th>规则</th>
                            <th>是否必需</th>
                        </tr>
                        <?php foreach((array)$model->getRules() as $k=>$v){?>
                            <tr>

                                <td><?php echo $k;?></td>
                                <td><?php echo $v['name'];?></td>
                                <td><?php echo $v['type'];?></td>
                                <td><?php echo $v['info'];?></td>
                                <td><?php echo $v['regular_str'];?></td>
                                <td><?php echo $v['required']?'<span class="label label-danger">是</span>':'<span class="label label-success">否</span>';?> </td>
                            </tr>
                        <?php }?>

                        </tbody></table>
                </div>

            </div>
        </div>
    </div>
</section>

<?php \common\widgets\JsBlock::begin() ?>

<script>

    $("#commit_test").click(function () {
        $("#result_txt").html('请求中...');
        var params = $("#params_txt").text();
        $.post("<?php echo \yii\helpers\Url::to(['/api/test']);?>", {params: params}, function (d) {
            //$("#time_txt").text(d.time);
            var options = {
                dom: '#result_txt', //对应容器的css选择器
                imgCollapsed: '<?php echo $this->context->assetUrl;?>/images/Collapsed.gif',
                imgExpanded: '<?php echo $this->context->assetUrl;?>/images/Expanded.gif'

            };
            $("#result_txt").html(d);
            var jf1 = new JsonFormater(options);
            jf1.doFormat($('#result_txt').text());

        })

    })

    $(document).ready(function () {
        var options = {
            dom: '#params_txt', //对应容器的css选择器
            imgCollapsed: '<?php echo $this->context->assetUrl;?>/images/Collapsed.gif',
            imgExpanded: '<?php echo $this->context->assetUrl;?>/images/Expanded.gif'

        };
        var jf = new JsonFormater(options); //创建对象
        jf.doFormat($('#params_txt').text()); //格式化json
        var options1 = {
            dom: '#result_txt', //对应容器的css选择器
            imgCollapsed: '<?php echo $this->context->assetUrl;?>/images/Collapsed.gif',
            imgExpanded: '<?php echo $this->context->assetUrl;?>/images/Expanded.gif'

        };
        var jf1 = new JsonFormater(options1);
        jf1.doFormat($('#result_txt').text());



    });


</script>
<?php \common\widgets\JsBlock::end() ?>
