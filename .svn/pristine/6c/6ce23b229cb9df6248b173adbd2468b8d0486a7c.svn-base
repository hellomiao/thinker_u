<?php
use yii\helpers\Html;
$config = new \app\base\models\Config();
$name = $config->getData('site-name');
/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['user/activate-account/'.$code]);
?>
<div class="password-reset">
    <p>欢迎来到 <?php $name;?>！</p>

    <p>点击下面的链接来确认和激活你的新帐号:</p>

    <p><?= Html::a(Html::encode($activateLink), $activateLink) ?></p>
    <p>如果上面的链接无法点击，请拷贝该链接并粘贴到你的浏览器的地址栏里。</p>
</div>
