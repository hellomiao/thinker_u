<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/24
 * Time: 上午9:25
 */

namespace app\admin\api;

use app\api\components\BaseApi;

class Test extends BaseApi
{


    protected function rules()
    {
        return [
            'id'=>['type'=>'number','min'=>3,'max'=>6,'required'=>true,'name'=>'id',"message"=>"请填写正确的id"],
        ];
    }

    public function run()
    {
        return $this->formatData(['test'=>'123']);
    }


}