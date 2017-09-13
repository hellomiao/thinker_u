<?php

namespace app\admin\controllers;

use app\admin\components\BaseController;
use app\base\lib\Utils;
use Yii;
use app\admin\models\District;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * DistrictController implements the CRUD actions for District model.
 */
class DistrictController extends BaseController
{

    /**
     * Lists all District models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $level = Yii::$app->request->get('level',1);
        $where = ['level'=>$level];
        if($id){
            $where['parent_id'] = $id;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => District::find()->where($where),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,'id'=>$id,'level'=>$level
        ]);
    }

    /**
     * Displays a single District model.
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
     * Creates a new District model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new District();
        $id = Yii::$app->request->get('id');
        $level = Yii::$app->request->get('level',1);
        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->parent_id = $id;
                $model->level = $level;
                $model->save();
                $msg = "添加区域[$model->name]成功";
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
     * Updates an existing District model.
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
                $msg = "编辑区域[$model->name]成功";
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
     * Deletes an existing District model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the District model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return District the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = District::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
