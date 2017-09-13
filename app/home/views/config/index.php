<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '参数配置';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">


            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">



    <p>
        <?= Html::a('添加配置', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('重载配置', ['reload'], ['class' => 'btn btn-info','id'=>'config_reload']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'data',
            'info',
            [

                'attribute'=>'status_is',
                'value'=>function($data){
                    return \app\base\models\Config::getStatus()[$data->status_is];
                }
            ],
            ['class' => 'app\admin\components\ActionColumn','template' => '{update} {delete}',  'buttons' => [
                'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => '删除',
                    ]);
                }
            ]],
        ],
    ]); ?>

</div>
            </div></div></div></section>



<?php \common\widgets\JsBlock::begin() ?>

<script>

  $("#config_reload").click(function(){
     var url = $(this).attr('href');
      $.post(url,function(data){
          swal({ title:"操作提示", text: data.message, type: "success",timer:1000});
          setTimeout(function(){
              page_load();
          },1000);
      },'json');
      return false;
  });

</script>
<?php \common\widgets\JsBlock::end() ?>
