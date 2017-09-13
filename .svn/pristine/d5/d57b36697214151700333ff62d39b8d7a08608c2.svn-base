<?php
use yii\helpers\Html;

$assetUrl = $this->context->assetUrl;

/* @var $this \yii\web\View */
/* @var $content string */
?>

    <header class="main-header">

        <?= Html::a("<span class='logo-mini'></span><span class='logo-lg'>" . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">




                    <!-- User Account: style can be found in dropdown.less -->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs"><?php echo Yii::$app->adminUser->identity->username; ?></span>


                        </a>
                        <ul class="dropdown-menu">


                            <li>  <?= Html::a(
                                    '设置个人信息',
                                    \yii\helpers\Url::to(['/admin/admin/info'])
                                ) ?></li>
                            <li role="presentation" class="divider"></li>
                            <li>  <?= Html::a(
                                    '注销登陆',
                                    \yii\helpers\Url::to(['/admin/logout']),
                                    ['data-method' => 'post']
                                ) ?></li>

                        </ul>

                    </li>



                    <li>
                        <a href="#" data-toggle="control-sidebar" title="切换皮肤"><i class="fa  fa-gears"></i></a>
                    </li>




                    <!-- User Account: style can be found in dropdown.less -->

                </ul>
            </div>
        </nav>
    </header>

<?php \common\widgets\JsBlock::begin(); ?>
    <script>
        $(function () {
            $(".clearCache").click(function (e) {

                var url = $(this).attr("href");

                $.post(url, function (d) {
                    layer.msg('缓存清除成功', {
                        time: 2000, icon: 6, end: function () {
                            reload();
                        }
                    });

                });

                e.preventDefault();
                return false;
            });
        });
    </script>
<?php \common\widgets\JsBlock::end(); ?>