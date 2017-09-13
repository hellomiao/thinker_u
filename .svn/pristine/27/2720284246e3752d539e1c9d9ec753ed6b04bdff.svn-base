<?php

namespace app\admin\controllers;

use app\home\models\UserGroup;
use Yii;
use app\admin\models\PlatformUser;
use app\admin\models\searchs\PlatformUserSearch;
use app\base\lib\Utils;
use yii\widgets\ActiveForm;
use app\admin\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlatformUserController implements the CRUD actions for PlatformUser model.
 */
class PlatformUserController extends BaseController
{

    /**
     * Lists all PlatformUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlatformUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlatformUser model.
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
     * Creates a new PlatformUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlatformUser();

        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                if ($model->save()) {
                    $msg = "添加平台客户[$model->name]成功";
                    Utils::adminLog('create', $msg);
                    return ['status' => true, 'message' => $msg];
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlatformUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->save();
                $msg = "编辑平台客户[$model->name]成功";
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
     * Deletes an existing PlatformUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $msg = "删除平台客户[$model->name]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }

    /**
     * Finds the PlatformUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PlatformUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlatformUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
