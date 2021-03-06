<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 16/3/22
 * Time: 上午9:44
 */
namespace app\home\components;

use app\admin\models\Attachments;
use app\base\lib\Utils;
use app\home\models\UserAcl;
use yii\helpers\ArrayHelper;

use yii\helpers\Json;
use yii\web\Controller;

use yii\helpers\Url;
use yii\web\UploadedFile;

class BaseController extends Controller
{

    public $layout = "@app/home/views/layouts/main.php";


    public $uid;
    public $username;
    public $group_id = [];
    public $platform_id=0;
    public $menus = [];
    public $_view;
    public $commit = false;//区分ajax验证还是ajax提交

    public $uflag;

    public $assetUrl;



    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'acl' => [
                'class' => AclFilter::className(),
            ],

        ]);
    }


    public function beforeAction($action)
    {
        if (!\Yii::$app->user->isGuest) {
            $this->_view = $this->view;
            $acl = new UserAcl();
            $module = $this->module->id;
            $controller = $this->id;
            $action = str_replace('-', '', $this->action->id);
            $this->username = \Yii::$app->user->identity->username;
            $this->uid = \Yii::$app->user->identity->id;
            $this->platform_id = \Yii::$app->user->identity->platform_id;
            $realname = \Yii::$app->user->identity->realname;
            $this->uflag = $this->username . "({$realname})";
            if (\Yii::$app->user->identity->group_id) {
                $this->group_id = explode(",", \Yii::$app->user->identity->group_id);
            }
            $this->menus = $acl->getMenus($module, $controller, $action, $this->group_id);
            $this->commit = \Yii::$app->request->post('form_commit');


        }

        $this->assetUrl = \Yii::$app->assetManager->getPublishedUrl('@app/home/misc');
//        Utils::xmp($this->menus);exit;
        return parent::beforeAction($action);
    }


    public function gate($alias)
    {
        $alias = explode('.', $alias);
        $num = count($alias);
        if ($num == 3) {
            $module = $alias[0];
            $controller = $alias[1];
            $action = $alias[2];
        } else if ($num == 2) {
            $module = 'home';
            $controller = $alias[0];
            $action = $alias[1];
        } else {
            $module = $this->module->id;
            $controller = $this->id;
            $action = $alias[0];
        }

        $acfilter = new AclFilter();

        if (in_array(1, $this->group_id) && !\Yii::$app->user->isGuest) {

            return true;

        }

        return $acfilter->checkAcl($module, $controller, $action, \Yii::$app->user->identity->group_id);
    }


    public function afterAction($action, $result)
    {
        if (\Yii::$app->request->isPjax) {
            $result = $this->renderPartial('@app/admin/views/layouts/content.php') . $result;
        }

        if (\Yii::$app->request->isAjax && is_array($result)) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }

    //权限面包屑
    public function getAclName($module, $controller, $action)
    {

        $row = UserAcl::findAll('lower(module)=:m AND lower(controller)=:c AND lower(action)=:a',
            ['m' => strtolower($module), 'c' => strtolower($controller), 'a' => strtolower($action)]);
        if ($row != null) {
            $this->pageTitle = $row['name'];
            $row['url'] = Url::to(["{$module}/{$controller}/{$action}"]);
            $arr2[$row['url']] = $row['name'];
            if ($row && $row['parent_id'] != 0) {
                $arr1 = $this->getParentAcl($row['parent_id']);
            }

            if ($arr1 != null) {
                return array_merge(array_reverse($arr1), $arr2);
            } else {
                return $arr2;
            }
        }
    }

    public function getParentAcl($id)
    {
        $acl = new UserAcl();
        static $arr = array();
        $parent = $acl->find('id=:id', array('id' => $id));
        $parent['url'] = $this->createUrl($parent['controller'] . '/' . $parent['action']);
        $arr[$parent['url']] = $parent['name'];

        if ($parent['parent_id'] != 0) {
            $this->getParentAcl($parent['parent_id']);
        }
        return $arr;
    }


    public function render($view, $params = [])
    {
        if (\Yii::$app->request->isPjax) {

            return parent::renderAjax($view, $params);
        } else {
            return parent::render($view, $params);
        }
    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => \xj\ueditor\actions\Upload::className(),
                'uploadBasePath' => '@webroot/static/files', //file system path
                'uploadBaseUrl' => '@web/static/files', //web path
                'csrf' => true, //csrf校验
                'configPatch' => [
                    'imageMaxSize' => 500 * 1024, //图片
                    'scrawlMaxSize' => 500 * 1024, //涂鸦
                    'catcherMaxSize' => 500 * 1024, //远程
                    'videoMaxSize' => 1024 * 1024, //视频
                    'fileMaxSize' => 1024 * 1024, //文件
                    'imageManagerListPath' => '/', //图片列表
                    'fileManagerListPath' => '/', //文件列表
                ],
                // OR Closure
                'pathFormat' => [
                    'imagePathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'scrawlPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'catcherPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'videoPathFormat' => 'video/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'filePathFormat' => 'file/{yyyy}{mm}{dd}/{time}{rand:6}',
                ],

                // For Closure
                'pathFormat' => [
                    'imagePathFormat' => [$this, 'format'],
                    'scrawlPathFormat' => [$this, 'format'],
                    'snapscreenPathFormat' => [$this, 'format'],
                    'snapscreenPathFormat' => [$this, 'format'],
                    'catcherPathFormat' => [$this, 'format'],
                    'videoPathFormat' => [$this, 'format'],
                    'filePathFormat' => [$this, 'format'],
                ],

                'beforeUpload' => function ($action) {
//          throw new \yii\base\Exception('error message'); //break
                },
                'afterUpload' => function ($action) {
                    /*@var $action \xj\ueditor\actions\Upload */
//
//                    var_dump($action->result);

//                    throw new \yii\base\Exception('error message'); //break
                },
            ],
        ];
    }


    public function format(\xj\ueditor\actions\Uploader $action)
    {
        $fileext = $action->fileType;
        $filehash = sha1(uniqid() . time());
        $p1 = substr($filehash, 0, 2);
        $p2 = substr($filehash, 2, 2);
        return "{$p1}/{$p2}/{$filehash}.{$fileext}";
    }


    public function actionUploadFile()
    {
        $instanceName = \Yii::$app->request->get('name');
        $input_name = \Yii::$app->request->get('input_name');
        $remark = \Yii::$app->request->get('remark');
        $imageFile = UploadedFile::getInstanceByName($instanceName);
        $dir = date("YmdHis") . uniqid(time(), true) . \Yii::$app->session->id;
        $directory = \Yii::getAlias('@webroot/static/docs') . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $imageFile->name;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = \Yii::getAlias('@webroot/static/docs') . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $fileName;
                $attach = new Attachments();
                $attach->user_id = $this->uid;
                $attach->name = $fileName;
                $attach->input_name = $input_name;
                $attach->path = $dir . DIRECTORY_SEPARATOR . $fileName;
                $attach->ext = $imageFile->extension;
                $attach->remark = $remark;
                $attach->size = $imageFile->size;
                $attach->create_at = time();
                $attach->save();
                $deleteUrl = Url::to(['file-delete', 'name' => $fileName, 'id' => $attach->id]);
                return Json::encode([
                    'files' => [[
                        'id' => $attach->id,
                        'name' => $fileName,
                        'input_name' => $input_name,
                        'size' => $imageFile->size,
                        "url" => $path,
                        "thumbnailUrl" => $attach->getPreview(),
                        "deleteUrl" => $deleteUrl,
                        "deleteType" => "POST"
                    ]]
                ]);
            }
        }
        return '';
    }

    public function actionFileDelete($name, $id)
    {
        $model = Attachments::findOne($id);
        $directory = $path = \Yii::getAlias('@webroot/static/docs') . DIRECTORY_SEPARATOR;
        $path = \Yii::getAlias('@webroot/static/docs') . DIRECTORY_SEPARATOR . $model->path;
        if (is_file($path)) {
            unlink($path);
            Attachments::deleteAll(['id' => $id]);
        }

        $output = ['status' => true];
        return Json::encode($output);
    }

    public function actionDownload($url)
    {

        Utils::downfile($url);
    }

}