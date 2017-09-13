<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/23
 * Time: 下午2:59
 */
namespace app\api\controllers;


use app\admin\models\Apis;
use yii\base\Exception;
use app\base\lib\DES3;
use yii;


class DefaultController extends yii\base\Controller
{


    public function actions()
    {
        $post = \Yii::$app->request->rawBody;
//        \Yii::info($post);
//     exit;
        $des3 = new DES3();
        $response = [];
//        $xx=$des3->decrypt('nOevrRMQTTBRIiiiQ1shfXX6Sch1T4qrvYf2htyvPPtvyNDnc9Mqbth+M/fedk9JCzf+4usPgEPCiJ5yZYrq6g==');
//        var_dump(json_decode($xx,true));exit;
//        $jsonData=[];
//        $jsonData['method']='user.test';
//        $jsonData['id']=1;
//        exit(json_encode($jsonData));
//        $row=$des3->encrypt(json_encode($jsonData));
//        exit($row);
        if (!$post) {
            $response['code'] = 1004;
            $response['message'] = 'no data';
            exit(json_encode($response));
        }
        $res = $des3->decrypt($post);
        $res = json_decode($res, true);

        if ($res['method']) {
            try {
                $apis = Apis::find()->where(['method' => $res['method']])->one();
                if ($apis) {
                    $class = $apis['className'];
                    $classObj = new $class();
                    unset($res['method']);
                    $classObj->params = $res;
                    $check = $classObj->check();
                    if (!empty($check) && !$check['ok']) {
                        $response = $check;
                    } else {
                        $response = $classObj->run();
                    }
                } else {
                    throw new Exception('方法不存在');
                }
            } catch (yii\base\Exception $e) {
                exit(json_encode(['ok' => false,
                    'error' => $e->getMessage(),
                    'errorid' => $e->getCode(),
                    'servertime' => time()], JSON_UNESCAPED_UNICODE));
            }
        } else {
            exit(json_encode(['ok' => false,
                'error' => '接口不存在', 'servertime' => time()], JSON_UNESCAPED_UNICODE));
        }
        exit(json_encode($response, JSON_UNESCAPED_UNICODE));
    }

    public function actionIndex()
    {

    }


}