<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '货运平台运营中心';
$assetUrl=$this->context->assetUrl;

 app\admin\assets\AdminAsset::addCss($this,'/css/login2.css');

$fieldOptions1 = [
    'options' => ['class' => 'uinArea'],
    'inputTemplate' => "
                <label class=\"input-tips\" for=\"u\">账号：</label>
                <div class=\"inputOuter\" id=\"uArea\">

                    {input}
                </div>
               "
];

$fieldOptions2 = [
    'options' => ['class' => 'pwdArea'],
    'inputTemplate' => "
               <label class=\"input-tips\" for=\"p\">密码：</label>
               <div class=\"inputOuter\" id=\"pArea\">

                  {input}
                </div>
                "
];
?>
<h1><?php echo $this->title ?></h1>

<div class="login" style="margin-top:50px;">
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 255px;">

        <div class="web_login" id="web_login">


            <div class="login-box">


                <div class="login_form">
        <p class="login-box-msg"></p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username'),'autocomplete'=>'off']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'),'autocomplete'=>'off']) ?>



            <!-- /.col -->
            <div style="padding-left:50px;margin-top:20px;">
                <div class="">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <?= Html::submitButton('登录', ['class' => 'button_blue', 'name' => 'login-button','style'=>'width:120px']) ?>
            </div>
            <!-- /.col -->


        <?php ActiveForm::end(); ?>


        <!-- /.social-auth-links -->



    </div></div></div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
</div>

<div class="jianyi">*推荐使用Chrome内核浏览器访问本站,ps:谷歌,火狐,360极速,qq,搜狗等浏览器</div>