<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/1/5
 * Time: 下午9:30
 */

namespace app\base\widgets\thinker\tag;

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class Tag extends  InputWidget
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

    public $jsOptions = [];

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
        TagAssets::register($this->view);
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
        $jsonOptions = Json::encode($this->jsOptions);
        $script = "$('#{$this->id}').tagEditor(" . $jsonOptions . ");";
        $this->view->registerJs($script, View::POS_READY);
    }
}