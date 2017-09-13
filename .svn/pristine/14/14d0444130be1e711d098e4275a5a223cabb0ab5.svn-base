<?php

namespace app\admin\controllers;

use app\admin\components\BaseController;
use app\admin\models\searchs\ApisSearch;
use app\base\lib\Utils;
use app\base\models\Config;
use kartik\form\ActiveForm;
use Yii;
use app\admin\models\Apis;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApisController implements the CRUD actions for apis model.
 */
class ApisController extends BaseController
{


    /**
     * Lists all apis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $config=new Config();
        $info = $config->getData('apis_info');
        $apisSearch = new ApisSearch();
        $dataProvider = $apisSearch->search(Yii::$app->request->get());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'apisSearch'=>$apisSearch,
            'info'=>$info
        ]);


    }

    /**
     * Displays a single apis model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model=$this->findModel($id);
        $model->params=json_decode($model->params,true);
        $params=$model->params;
        $params['method']=$model->method;
        $model->params=json_encode($params);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new apis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new apis();

        if ($model->load(Yii::$app->request->post())) {
            $ret=ActiveForm::validate($model);
            if(!$this->commit) {
                return $ret;
            }else{
                $model->save();
                $msg ="添加api[$model->name]成功";
                Utils::adminLog('create',$msg);
                return ['status'=>true,'message'=>$msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing apis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $ret=ActiveForm::validate($model);
            if(!$this->commit) {
                return $ret;
            }else{
                $model->save();
                $msg ="编辑api[$model->name]成功";
                Utils::adminLog('update',$msg);
                return ['status'=>true,'message'=>$msg];
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing apis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();
        $msg ="删除api[$model->name]成功";
        Utils::adminLog('delete',$msg);
        return ['status'=>true,'message'=>$msg];
    }

    /**
     * Finds the apis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return apis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = apis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInfo(){
        $config = new Config();
        if (Yii::$app->request->isPost && $this->commit) {

            $info = Yii::$app->request->post('info');
            $config->updateAll(['data' => $info], ['name' => 'apis_info']);
            return ['status' => true, 'message' => '编辑api说明成功'];
        }else {
            $info = $config->getData('apis_info');
            return $this->render('info', ['info' => $info]);
        }
    }
}
