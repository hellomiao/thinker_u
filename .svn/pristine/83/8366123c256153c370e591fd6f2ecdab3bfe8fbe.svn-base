<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\admin\models\AdminGroup */

$this->title = "设置组权限[$group_name]";
$this->params['breadcrumbs'][] = ['label' => '用户组', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="row">
    <div class="col-xs-12">




            <!-- /.box-header -->
            <div class="box-body">



                <div class="row">
                    <div class="col-md-6">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">权限设置</h3>
                            </div>

                            <div id="treeSetAcl">

                            </div>

                            <div class="box-footer">
                                <?= Html::button('设置', ['class' => 'btn btn-success','id'=>'setAclBtn']) ?>
                            </div>

                        </div>




                    </div>


                </div>

            </div>


    </div></div>
    </section>


<?php \common\widgets\JsBlock::begin() ?>

<script>


    var treeSetAcl = $('#treeSetAcl');

    var _aclGroupJsonData = <?php echo $json ?>;

    treeSetAcl.jstree({
        'core': {
            'themes': {
                'responsive': false
            },
            'data': _aclGroupJsonData
        },
        ui:{
            theme_name : "classic"
        },


        "checkbox": {
            cascade: "", three_state: false

        },
        'types': {
            'default': {
                'icon': 'fa  fa-gear'
            },
            'file': {
                'icon': 'fa fa-file'
            }
        },
        'plugins': ['types', 'checkbox', 'ui']
    });
$(function(){


$("#setAclBtn").on("click",function(){

    var list = treeSetAcl.jstree("get_selected");

    var str = "";
    for (var i = 0; i < list.length; i++) {
        str += list[i] + ",";
    }
    acl_ids=str.substr(0, str.length - 1);




    $.post('<?php echo \yii\helpers\Url::to(['set-acl']);?>',{id:"<?php echo $id;?>",acl_ids:acl_ids},function(d){

        swal({title:"操作提示", text: d.message, type: "success",timer:2000});
        page_load('<?php echo \yii\helpers\Url::to(['index']);?>');
    });

});

});

</script>
<?php \common\widgets\JsBlock::end() ?>
</div>
