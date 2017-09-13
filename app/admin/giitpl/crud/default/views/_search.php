<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get','options' => ['data-pjax' => true]
    ]); ?>
    <div class="row">
<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <div class='col-xs-2'><?= " . $generator->generateActiveSearchField($attribute) . " ?></div>\n\n";
    } else {
        echo "    <div class='col-xs-2'><?php // echo " . $generator->generateActiveSearchField($attribute) . " ?></div>\n\n";
    }
}
?>
        </div>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton('搜索', ['class' => 'btn btn-primary search-btn']) ?>
        <?= "<?= " ?>Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
