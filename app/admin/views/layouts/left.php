<aside class="main-sidebar">

    <section class="sidebar">



        <?php
        $menus=$this->context->menus;
        $items=[];
        foreach($menus as $key=>$val){
            $items[$key]=['label' => $val['name'],'icon'=>$val['icon'],'url'=>$val['url'],'active'=>$val['active']];
            if(is_array($val['children'])){

                foreach($val['children'] as $k=>$v){
                    $items[$key]['items'][]=['label'=>$v['name'],'icon'=>'fa fa-circle-o','url'=>$v['url'],'active'=>$v['active']];
                }

            }
        }
        ?>

        <?= \app\base\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' =>$items
            ]
        ) ?>

    </section>

</aside>
