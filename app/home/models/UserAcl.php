<?php

namespace app\home\models;

use Yii;

/**
 * This is the model class for table "{{%user_acl}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $icon
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property integer $order_num
 * @property integer $is_show
 */
class UserAcl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_acl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'order_num', 'is_show'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['icon', 'module', 'controller', 'action'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父id',
            'name' => '名称',
            'icon' => '图标',
            'module' => 'Module',
            'controller' => 'Controller',
            'action' => 'Action',
            'order_num' => '排序',
            'is_show' => '左侧是否显示',
        ];
    }

    //获取侧边菜单,2级
    public function getMenus($module,$controller, $action, $group_id)
    {
        //权限控制
        $groupAclModel = new UserGroupacl();
        $myAcl         = $groupAclModel->findAll(['group_id' => $group_id]);
        $acl_ids='';
        foreach($myAcl as $key=>$val){
            $acl_ids.= $val['acl_ids'].',';
        }
        $acl_ids=substr($acl_ids,0,-1);


        if (!in_array(1,$group_id))
        {
            $parent = $this->find()->where(['parent_id'=>0])->andWhere(['is_show'=>1])
                ->andWhere("FIND_IN_SET(`id`,'{$acl_ids}')")->orderBy('order_num ASC')->asArray()->all();

        }
        else
        {
            $parent = $this->find()->where(['parent_id'=>0])->andWhere(['is_show'=>1])
                ->orderBy('order_num ASC')->asArray()->all();
        }

        $menus       = array();

        foreach ($parent as $key => $val)
        {
            $menus[$key]['name']     = $val['name'];
            $menus[$key]['icon']     = $val['icon'];
            $menus[$key]['active'] = strcasecmp($val['controller'], $controller) == 0 ? true : false;
            if (!in_array(1,$group_id))
            {
                $children = $this->find()->where(['parent_id'=>$val['id']])->andWhere(['is_show'=>1])
                    ->andWhere("FIND_IN_SET(`id`,'{$acl_ids}')")->orderBy('order_num ASC')->asArray()->all();

            }
            else
            {
                $children = $this->find()->where(['parent_id'=>$val['id']])->andWhere(['is_show'=>1])
                    ->orderBy('order_num ASC')->asArray()->all();
            }

            $active = [];

            foreach ($children as $k => $v)
            {
                $children[$k]['name']     = $v['name'];
                $children[$k]['active'] = (strcasecmp($v['controller'], $controller)==0&&strcasecmp($v['action'], $action)==0)? true : false;
                $active[] =  $children[$k]['active'];
                if($children[$k]['active']){
                    break;
                }

            }

            foreach ($children as $k => $v)
            {
                $children[$k]['name']     = $v['name'];
//                $children[$k]['active'] = (strcasecmp($v['controller'], $controller)==0&&strcasecmp($v['action'], $action)==0)|| strcasecmp($v['controller'], $controller) == 0? true : false;
//                $active[] =  $children[$k]['active'];
                $children[$k]['url']      = $v['module']==$module?\yii\helpers\Url::to(["{$v['controller']}/{$v['action']}"]):\yii\helpers\Url::to(["/{$v['module']}/{$v['controller']}/{$v['action']}"]);
            }
            if($val['module']&&$val['controller']&&$val['action']){
                $menus[$key]['url']=$module?\yii\helpers\Url::to(["{$val['controller']}/{$val['action']}"]):\yii\helpers\Url::to(["/{$val['module']}/{$val['controller']}/{$val['action']}"]);
            }else{
                $menus[$key]['url']= 'javascript:;';
            }
            $menus[$key]['active'] =  in_array(1,$active)?true:false;
            $menus[$key]['children'] = count($children)>0?$children:'';
        }
        return $menus;
    }


    //给jstree提供json数据
    public function getJsonData()
    {
        $data = array();
        $list=$this->find()
            ->orderBy('order_num ASC')->asArray()->all();
        foreach ($list as $k => $v)
        {
            if ($v['parent_id'] == 0)
            {
                $data[$k]['id']     = $v['id'];
                $data[$k]['parent'] = '#';
                $data[$k]['text']   = $v['name'];
                $data[$k]['state']  = array('opened' => true);
            }
            else
            {
                $data[$k]['id']     = $v['id'];
                $data[$k]['parent'] = $v['parent_id'];
                $data[$k]['text']   = $v['name'];
            }
        }

        return json_encode($data);
    }



    public function getSelectList($id = 0, $lev = 0)
    {
        $list = $this->find()->where(['parent_id' => $id])
            ->orderBy('order_num ASC')->asArray()->all();
        static $arr = [0=>'请选择父级'];
        $tag = '';
        foreach ($list as $k => $v) {
            $tag = str_repeat("—", $lev);
            $v['name'] = $tag . $v['name'];
            $arr[$v['id']]= $v['name'];
            $this->getSelectList($v['id'], $lev + 1);
        }

        return $arr;
    }
}
