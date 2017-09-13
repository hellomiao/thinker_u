<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1">
    <meta name=apple-mobile-web-app-capable content=yes>
    <meta name=apple-mobile-web-app-status-bar-style content=#303B4F>
    <meta content="telephone=no" name=format-detection>
    <meta content="email=no" name=format-detection>
    <meta name=apple-mobile-web-app-title content=货运管理>
    <meta name=apple-mobile-web-app-status-bar-style content=black-translucent>
    <meta name=x5-orientation content=portrait>
    <meta name=x5-fullscreen content=true>
    <meta name=x5-page-mode content=app>
    <meta name=HandheldFriendly content=true>
    <meta name=MobileOptimized content=320>
    <meta name=screen-orientation content=portrait>
    <meta name=x5-orientation content=portrait>
    <meta name=full-screen content=yes>
    <meta name=browsermode content=application>
    <meta name=msapplication-tap-highlight content=no>
    <meta name=renderer content=webkit|ie-comp|ie-stand>
    <meta name=msapplication-TileColor content=#303B4F>
    <meta http-equiv=Cache-Control content=no-siteapp>
    <meta http-equiv=Pragma content=no-cache>
    <title>货运管理平台-内勤端</title>
    <meta name=description content=货运管理平台-内勤端>
    <meta name=author content=陈龙>
    <meta name=robots content=index,follow>
    <?php \app\home\assets\AdminNoAsset::addCss($this,'/map/css/style.css');?>

</head>
<body data-mapkey="<?php echo Yii::$app->params['mapkey'];?>" data-location="[<?php echo $platuser->longitude;?>,<?php echo $platuser->latitude;?>]" data-platformid="<?php echo $platform_id;?>"
      data-domain="<?php echo Url::to(['/ajax/api']);?>" data-driver-url="<?php echo Url::to(['driver/index']);?>"
      data-clock-url="<?php echo Url::to(['clock-total/index']);?>"
      data-close-url="<?php echo Url::to(['default/index']);?>">
<div id=app></div>
<?php \app\home\assets\AdminNoAsset::addScript($this,'/map/js/manifest.js');?>
<?php \app\home\assets\AdminNoAsset::addScript($this,'/map/js/vendor.js');?>
<?php \app\home\assets\AdminNoAsset::addScript($this,'/map/js/app.js');?>

</body>
</html>