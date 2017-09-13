<<<<<<< HEAD
Yii 2 改造
===============================


api
------------------
每个模块都可以建立api,即可外部调用,亦可内部调用
首先要在common/config/apis.php建立api路由
<pre><code>'admin.api.update'=>['class'=>'app\admin\api\Update','name'=>'测试接口']</code></pre>
例如在admin\api下建立了update pai

<pre><code>
namespace app\admin\api;
use app\api\components\BaseApi;
class Update extends BaseApi
{

    protected function rules(){
        return [
          'phone'=>['type'=>'phone','required'=>true,'name'=>'手机号',"message"=>"请填写正确的手机号码"],
          'num'=>['type'=>'number','min'=>6,'max'=>12,'required'=>true,'name'=>'数量','message'=>'请填写正确的数字'],
        ];
    }
    public function run($params){
//        parent::check();

        return ["status"=>true,"message" => "hello".$params->num];
    }



}
</code></pre>

`rules是一些简单的验证方法`
```
number 数字
intger 整数
phone 手机
email 邮箱
```

`调用方法:`
<pre><code>
$rs=Rpc::call("admin.api.update",['num'=>"aaa",'phone'=>'123']);</code></pre>

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
app
    admin/               后台
    base/                基本,存放一些基本类
    api/                 接口
vendor/                  框架等
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
=======

=======
#thinkerforum
>>>>>>> fba770853b32f5008a74efa0dcad79f479a4fb3d
