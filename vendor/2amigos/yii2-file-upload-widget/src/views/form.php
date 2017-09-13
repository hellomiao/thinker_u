<?php
/** @var \dosamigos\fileupload\FileUploadUI $this */
use yii\helpers\Html;
$context = $this->context;
if($context->model){
    $name = $context->model->attributeLabels()[$context->attribute];
}

?>
    <!-- The file upload form used as target for the file upload widget -->
<?= Html::beginTag('div', $context->options); ?>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?= $name?$name:Yii::t('fileupload', 'Add files') ?></span>

                <?= $context->model instanceof \yii\base\Model && $context->attribute !== null
                    ? Html::activeFileInput($context->model, $context->attribute, $context->fieldOptions)
                    : Html::fileInput($context->name, $context->value, $context->fieldOptions);?>

            </span>
            <a class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span><?= Yii::t('fileupload', 'Start upload') ?></span>
            </a>
            <a class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span><?= Yii::t('fileupload', 'Cancel upload') ?></span>
            </a>
            <a class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span><?= Yii::t('fileupload', 'Delete') ?></span>
            </a>
            <input type="checkbox" class="toggle">
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files">
<?php if($filesJson){ foreach($filesJson as $key=>$val){?>

        <tr class="template-download fade in">
            <td>
                <input type="hidden" name="<?=$val['input_name'];?>[]" value="<?php echo $val['id'];?>"/>
            <span class="preview">

                    <a href="<?php echo $val['url'];?>" title="<?php echo $val['name'];?>" download="<?php echo $val['name'];?>" data-gallery=""><img src="<?php echo $val['preview'];?>" width="30"></a>

            </span>
            </td>
            <td>
                <p class="name">

                    <a href="<?php echo $val['url'];?>" title="<?php echo $val['name'];?>" download="<?php echo $val['name'];?>" data-gallery=""><?php echo $val['name'];?></a>

                </p>

            </td>
            <td>
                <span class="size"><?php echo round($val['size']/1204,2);?> KB</span>
            </td>
            <td>

                <button class="btn btn-danger delete" data-type="POST" data-url="file-delete?name=<?php echo $val['name'];?>&id=<?php echo $val['id'];?>">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>删除</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">

            </td>
        </tr>
<?php }}?>
        </tbody></table>
<?= Html::endTag('div');?>
