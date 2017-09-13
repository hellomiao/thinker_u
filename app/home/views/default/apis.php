<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'API管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">



                <div class="col-md-12">



                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">API</h3>
                        </div>




                    </div>












                </div>

</section>

<?php \common\widgets\JsBlock::begin();?>
<script>
    ajax_form('ConfigForm');
</script>
<?php \common\widgets\JsBlock::end();?>
