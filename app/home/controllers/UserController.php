<?php

namespace app\home\controllers;


use app\base\lib\Utils;
use app\home\components\AclFilter;
use app\home\components\BaseController;
use app\home\models\Driver;
use app\home\models\searchs\UserSearch;
use app\home\models\User;
use Yii;
use app\admin\models\Admin;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for Admin model.
 */
class UserController extends BaseController
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
        $adminSearch = new UserSearch();
        $params = Yii::$app->request->queryParams;
        $params['platform_id'] = $this->platform_id;
        $dataProvider = $adminSearch->search($params);

        return $this->render('index', [
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

        $driver_id = Yii::$app->request->get('driver_id');

        $model = new User();
        if ($driver_id) {
            $driver = Driver::findOne($driver_id);
            $model->username = $driver->phone;
            $model->realname = $driver->username;
            $model->mobile = $driver->phone;
            $model->group_id =2;
        }
        $model->scenario = 'create';
        $hash = substr(uniqid(rand()), -6);
        if ($model->load(Yii::$app->request->post())) {

            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->platform_id = $this->platform_id;
                $rs = $model->save();
                if ($rs && $driver_id) {
                    $driver->user_id = $model->id;
                    $driver->save();
                }
                $msg = "添加员工[$model->username]成功";
                Utils::log('create', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'driver' => $driver
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
                $msg = "更新员工[$model->username]成功";
                Utils::log('update', $msg);
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
        $msg = "删除员工[$model->username]成功";
        Utils::log('delete', $msg);
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
        if (($model = User::findOne($id)) !== null) {
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
        $model->scenario = !isset($post['password'])||empty($post['password'])?'update':'infoupdate';
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
                Utils::log('update', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('info', [
                'model' => $model,
            ]);
        }
    }


}
