<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/5/25
 * Time: 上午10:51
 */

namespace app\base\widgets;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * Class Menu
 * Theme menu widget.
 */
class Menu extends \dmstr\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a href="{url}" title="{title}">{icon} {label}</a>';
    public $submenuTemplate = "\n<ul class='treeview-menu' {show}>\n{items}\n</ul>\n";
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (isset($item['items'])) {
            $labelTemplate = '<a href="{url}" title="{title}">{label} <i class="fa fa-angle-left pull-right"></i></a>';
            $linkTemplate = '<a href="{url}" title="{title}">{icon} {label} <i class="fa fa-angle-left pull-right"></i></a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }

        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $linkTemplate);
            $replace = !empty($item['icon']) ? [
                '{url}' => Url::to($item['url']),
                '{label}' => '<span>' . $item['label'] . '</span>',
                '{title}' => $item['label'],
                '{icon}' => '<i class="' . $item['icon'] . '"></i> '
            ] : [
                '{url}' => Url::to($item['url']),
                '{title}' =>$item['label'],
                '{label}' => '<span>' . $item['label'] . '</span>',
                '{icon}' => null,
            ];
            return strtr($template, $replace);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $labelTemplate);
            $replace = !empty($item['icon']) ? [
                '{label}' => '<span>' . $item['label'] . '</span>',
                '{title}' =>$item['label'],
                '{icon}' => '<i class="' . $item['icon'] . '"></i> '
            ] : [
                '{label}' => '<span>' . $item['label'] . '</span>',
                '{title}' =>$item['label'],
            ];
            return strtr($template, $replace);
        }
    }
}