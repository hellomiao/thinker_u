<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/23
 * Time: 下午2:59
 */
namespace app\api\controllers;

use app\base\lib\WaterMask;
use yii\base\Exception;
use yii\web\UploadedFile;
use yii;


class UploadController extends yii\base\Controller
{




    public function actionIndex()
    {
        header('Content-Type:application/json;charset=utf-8');
        try {
            $post = Yii::$app->request->post();
            $type = $post['type'];
            $file = UploadedFile::getInstanceByName($post['filename']);
            $dir = date("Ymd");
            $directory = \Yii::getAlias("@webroot/static/{$type}") . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $fileName = uniqid(time()) . '.' . $file->getExtension();
            $filePath = $directory . $fileName;
            if ($file->saveAs($filePath)) {


//                yii\imagine\Image::text($filePath,
//                    date("Y-m-d H:i:s"), '@webroot/msyh.ttf',
//                    [$width-200,$height-200],['color'=>'ccc','size'=>14,'angle'=>5])->save($filePath, ['quality' => 100]);

//                yii\imagine\Image::text($filePath,
//                    '天府新区啊啥啥啥是啥是啥是啥是是是手上的都是但是但是', '@webroot/msyh.ttf',
//                    [100,$height-280],['color'=>'ccc','size'=>14,'angle'=>5])->save($filePath, ['quality' => 100]);

                $url = \Yii::getAlias("/static/{$type}") . '/' . $dir . '/' . $fileName;
                exit(json_encode(['ok' => true,
                    'error' => '', 'servertime' => time(), 'path' => $url], JSON_UNESCAPED_UNICODE));

            } else {
                throw  new Exception('上传异常');
            }
        } catch (Exception $e) {
            exit(json_encode(['ok' => false,
                'error' => $e->getMessage(),
                'errorid' => $e->getCode(),
                'servertime' => time()], JSON_UNESCAPED_UNICODE));
        }
    }


}