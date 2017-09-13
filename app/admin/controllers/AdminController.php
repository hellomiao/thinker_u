<?php

namespace app\admin\controllers;

use app\admin\components\AclFilter;
use app\admin\components\BaseController;
use app\admin\models\AdminGroup;
use app\admin\models\searchs\AdminSearch;
use app\admin\models\searchs\AdminSearchRecyle;
use app\base\lib\Utils;
use app\project\models\Project;
use app\project\models\ProjectDetail;
use Yii;
use app\admin\models\Admin;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use PHPExcel;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_IOFactory;

/**
 * UserController implements the CRUD actions for Admin model.
 */
class AdminController extends BaseController
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AclFilter::className(),
                'except' => ['info']
            ]
        ];
    }
    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $adminSearch = new AdminSearch();
        $params=Yii::$app->request->get();
        $dataProvider = $adminSearch->search($params);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'adminSearch' => $adminSearch,
        ]);
    }


    public function actionRecycle()
    {
        $adminSearch = new AdminSearchRecyle();
        $dataProvider = $adminSearch->search(Yii::$app->request->get());

        return $this->render('recycle', [
            'dataProvider' => $dataProvider,
            'adminSearch' => $adminSearch,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Admin();
        $model->scenario = 'create';
        $hash = substr(uniqid(rand()), -6);
        if ($model->load(Yii::$app->request->post())) {

            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->save();
                $msg = "添加用户[$model->username]成功";
                Utils::adminLog('create', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post($model->formName());
        if (empty($post['password'])) {

            unset($post['password']);
        }
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {

            $ret = ActiveForm::validate($model);
            if (!empty($ret)) {
                return $ret;
            } else {
                if (!empty($post['password'])) {

                    $model->password = $model->hashPassword($post['password']);
                }
                $model->save();
                $msg = "更新用户[$model->username]成功";
                Utils::adminLog('update', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $msg = "删除用户[$model->username]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }


    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->updateAll(['is_del' => 0], ['id' => $id]);
        $msg = "还原用户[$model->username]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }


    public function actionRedel()
    {
        $model = new Admin();
        $model->deleteAll(['is_del' => 1]);
        $msg = "删除全部回收站用户[$model->username]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionInfo()
    {
        $id = $this->uid;
        $model = $this->findModel($id);

        $post = Yii::$app->request->post($model->formName());
        if (empty($post['password'])) {

            unset($post['password']);
        }
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {

            $ret = ActiveForm::validate($model);
            if (!empty($ret)) {
                $msg='';
                foreach($ret as $v){
                    $msg.=$v[0];
                }
                return ['status'=>false,'message'=>$msg];
            } else {
                if (!empty($post['password'])) {

                    $model->password = $model->hashPassword($post['password']);
                }
                $model->save(false);
                $msg = "更新个人信息[$model->username]成功";
                Utils::adminLog('update', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('info', [
                'model' => $model,
            ]);
        }
    }







}
