<?php

namespace app\base\widgets\thinker\wangeditor;

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;


/**
 * Wangeditor Widget
 *
 */
class Wangeditor extends InputWidget
{

    /**
     * 初始化目标ID
     * @var string
     */
    public $id;

    /**
     * 默认值
     * @var string
     */
    public $value;

    /**
     * 表单字段名
     * @var string
     */
    public $name;

    /**
     * Tag/ScriptTag HtmlStyle
     * @var style
     */
    public $style;

    /**
     * 是否渲染Tag
     * @var string/bool
     */
    public $renderTag = true;


    public $menu = [];

    public $uploadImgUrl;

    public $uploadParams=[];


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (empty($this->id)) {
            $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        }
        if (empty($this->name)) {
            $this->name = $this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->id;
        }
        $attributeName = $this->attribute;
        if (empty($this->value) && $this->hasModel()) {
            $this->value = $this->model->$attributeName;
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        WangeditorAssets::register($this->view);
        $this->registerScripts();

        if ($this->renderTag) {
            echo $this->renderTag();
        }
    }

    public function renderTag()
    {
        $id = $this->id;
        $content = $this->value;
        $name = $this->name;
        $style = $this->style ? " style=\"{$this->style}\"" : '';
        return <<<EOF
<textarea id="{$id}" name="{$name}"$style>{$content}</textarea>
EOF;
    }

    public function registerScripts()
    {

        $id = str_replace('-', '_', $this->id);
        $editor_id = "editor{$id}";
        $script = "var {$editor_id} = new wangEditor('{$this->id}');";
        if ($this->menu) {
            $menu = Json::encode($this->menu);
            $script .= "{$editor_id}.config.menus={$menu};";
        }
        if ($this->uploadImgUrl) {
            $script .= "{$editor_id}.config.uploadImgUrl='{$this->uploadImgUrl}';";
        }


        $uploadParams = json_encode(array_merge($this->uploadParams,[\Yii::$app->request->csrfParam=>\Yii::$app->request->csrfToken]));
        $script .= "{$editor_id}.config.uploadParams={$uploadParams};";

        $script .= "{$editor_id}.create();";
        $this->view->registerJs($script, View::POS_READY);
    }

}
