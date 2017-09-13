<?php
use yii\helpers\Html;
$config = new \app\base\models\Config();
$name = $config->getData('site-name');
/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/password-reset/'.$code]);
?>
<div class="password-reset">
    <p>有人请求重置你在 <?php echo $name;?> 上的密码</p>

    <p>如果那不是你，你可以直接忽略本邮件。</p>

    <p>点击下面的链接来选择一个新密码:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>
