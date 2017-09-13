<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$name = '你没有权限';
$message ='sorry';
$this->title = $name;
?>
<!-- Main content -->
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info" style="font-size: 40px"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content" style="margin-left: 120px">
            <h3><?= $name ?></h3>





            <p>

                你没有访问当前页面的权限,请联系管理员授予权限.

            </p>


        </div>
    </div>

</section>
