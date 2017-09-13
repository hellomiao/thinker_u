<?php

namespace app\admin\controllers;

use app\admin\models\PlatformUser;
use app\home\models\searchs\UserSearch;
use Yii;
use app\home\models\User;
use app\base\lib\Utils;
use yii\widgets\ActiveForm;
use app\admin\components\BaseController;
use yii\web\NotFoundHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex($platform_id)
    {
        $platformUser = PlatformUser::findOne($platform_id);
        $searchModel = new UserSearch();
        $parmas = Yii::$app->request->queryParams;
        $parmas['platform_id'] = $platform_id;
        $parmas['group_id'] = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'platformUser'=>$platformUser,
            'platform_id'=>$platform_id
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($platform_id)
    {
        $platformUser = PlatformUser::findOne($platform_id);
        $model = new User();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->platform_id=$platform_id;
                $model->group_id = 1;
                $model->save();
                $msg = "添加平台客户[{$platformUser->name}]账号[$model->username]成功";
                Utils::adminLog('create', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'platformUser'=>$platformUser,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $platformUser = PlatformUser::findOne($model->platform_id);
        $post = Yii::$app->request->post($model->formName());
        if (empty($post['password'])) {

            unset($post['password']);
        }
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                if (!empty($post['password'])) {

                    $model->password = $model->hashPassword($post['password']);
                }
                $model->save();
                $msg = "编辑平台客户[{$platformUser->name}]账号[$model->username]成功";
                Utils::adminLog('update', $msg);
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'platformUser'=>$platformUser
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $platformUser = PlatformUser::findOne($model->platform_id);
        $model->delete();
        $msg = "删除平台客户[{$platformUser->name}]账号[$model->username]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
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


}
