<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '平台菜单权限管理';
$this->params['breadcrumbs'][] = $this->title;
$prefix= strtolower($model->formName());
?>




    <section class="content">


        <div class="row">
            <div class="col-md-6">



                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">快速添加</h3>
                    </div>

                    <?php $form = ActiveForm::begin(['id'     => $model->formName(),
                        'action'=>['create'],
                    ]); ?>

                    <div class="box-body">

                        <?= $form->field($model, 'parent_id')->dropDownList($model->getSelectList()) ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>


                        <?= $form->field($model, 'controller')->dropDownList($controllerId) ?>

                        <?= $form->field($model, 'action')->dropDownList(['请选择']) ?>

                        <?= $form->field($model, 'order_num')->textInput(['value'=>0]) ?>

                        <?= $form->field($model, 'is_show')->checkbox() ?>



                        <input type="hidden" value="0" name="id" id="<?php echo $prefix;?>-id"/>
                        <input type="hidden" value="<?php echo Url::to(['view']); ?>" id="<?php echo $prefix;?>-get_url"/>
                        <input type="hidden" value="<?php echo Url::to(['delete']); ?>" id="<?php echo $prefix;?>-del_url"/>


                        <div class="form-group">
                            <button id="<?php echo $prefix;?>-add_btn" class="btn btn-success" >添加 <i class="fa fa-plus"></i></button>
                            <button  id="<?php echo $prefix;?>-edit_btn" style="display: none"
                                     class="btn btn-success">编辑</button>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>



                </div>












            </div>


            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">权限树</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div id="treeAcl"></div>
                </div>
                <!-- /.box -->

            </div>


        </div>

    </section>



<?php \common\widgets\JsBlock::begin() ?>

<script>

    $(function ($) {

        $("#useracl-controller").change(function(){

            var controller = $(this).val();

            $.post("<?=Url::to('get-action');?>",{controller:controller},function(json){

                var options='';
                for(var item in json){
                    options+='<option value="'+item+'">'+json[item]+'</option>'
                }
                $("#useracl-action").html(options);

            },"json");

        });
        /*
         * 权限对象
         */
        var treeAcl = $('#treeAcl');
        var acl = {
            'prefix': '<?php echo $prefix;?>-',
            'getDom': function(name) {
                return $("#" + this.prefix + name)
            },
            'getDomValue': function(name) {
                return this.getDom(name).val();
            },

            'addUI': function(id) {
                this.getDom('parent_id').val(id);
                this.getDom('name').focus();
                this.getDom('add_btn').show();
                this.getDom('edit_btn').hide();
                $('form#<?php echo $model->formName();?>').attr('action','<?php echo Url::to(['create']);?>')
            },

            'editUI': function(id) {
                var _self = this;
                var url = this.getDomValue('get_url');
                $.getJSON(url, {id: id}, function(data) {
                    _self.getDom('id').val(data.id);
                    _self.getDom('parent_id').val(data.parent_id);
                    _self.getDom('name').val(data.name);
                    _self.getDom('icon').val(data.icon);
                    _self.getDom('module').val(data.module);
                    _self.getDom('controller').val(data.controller);

                    $.post("<?=Url::to('get-action');?>",{controller:data.controller},function(json){

                        var options='';
                        for(var item in json){
                            options+='<option value="'+item+'">'+json[item]+'</option>'
                        }
                        $("#useracl-action").html(options);
                        _self.getDom('action').val(data.action);

                    },"json");


                    _self.getDom('order_num').val(data.order_num);
                    if (data.is_show == 1) {
                        _self.getDom('is_show').attr("checked", true);
                    }
                    _self.getDom('add_btn').hide();
                    _self.getDom('edit_btn').show();
                    $('form#<?php echo $model->formName();?>').attr('action','<?php echo Url::to(['update']);?>')
                });
            },
            'del': function(id) {

                var that = this;

                swal({   title: "操作提示",   text: "是否将此权限删除?",   type: "warning",
                    showCancelButton: true,   confirmButtonColor: "#DD6B55",cancelButtonText:"取消",
                    confirmButtonText: "删除",   closeOnConfirm: false }, function(){


                    var url = that.getDomValue('del_url');
                    $.post(url, {id: id}, function(d) {
                        if (d.status) {
                            var ref = treeAcl.jstree(true),
                                sel = ref.get_selected();
                            if (!sel.length) {
                                return false;
                            }
                            ref.delete_node(sel);
                            swal({title:"操作提示", text: "已经被删除!", type: "success",timer:1000});

                        }
                    });
                });
            }
        };



        var _aclJsonData = <?php echo $model->getJsonData();?>;

        treeAcl.jstree({
            'core': {
                'check_callback': true,
                "themes": {
                    "theme": "default",
                    "dots": true,
                    "icons": false
                },
                'data': _aclJsonData
            },


            'types': {
                'default': {
                    'icon': 'fa  fa-gear'
                },
                'file': {
                    'icon': 'fa fa-file'
                }
            },
            "contextmenu": {
                "items": function (node) {// Could be a function that should return an object like this one
                    return {
                        "create": {
                            "separator_before": false,
                            "separator_after": true,
                            "label": "添加子权限",
                            "action": function (obj) {
                                acl.addUI(node.id);
                            }
                        },
                        "edit": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "编辑",
                            "action": function (obj) {
                                acl.editUI(node.id);
                            }
                        },
                        "delete": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "删除",
                            "action": function (obj) {
                                acl.del(node.id);
                            }
                        }
                    }
                }
            },
            'plugins': ['themes', 'types', 'contextmenu']
        });

        ajax_form('<?php echo $model->formName();?>');



    });
</script>


<?php \common\widgets\JsBlock::end()?>

