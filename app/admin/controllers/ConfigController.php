<?php

namespace app\admin\controllers;

use app\admin\components\BaseController;
use app\base\lib\Utils;
use app\project\models\Project;
use Yii;
use app\base\models\Config;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends BaseController
{

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Config::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Config model.
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
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();

        if ($model->load(Yii::$app->request->post())) {
            $ret = ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            } else {
                $model->create_time = time();
                $model->save();
                $msg = "创建配置[$model->name]成功";
                Utils::adminLog('create', $msg);
                Yii::$app->config->save();
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionReload()
    {
        Yii::$app->config->clear();
        Yii::$app->config->save();
        $msg = "重载配置成功";
        Utils::adminLog('reload', $msg);
        return ['status' => true, 'message' => $msg];
    }

    /**
     * Updates an existing Config model.
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
                $msg = "编辑配置[$model->name]成功";
                Utils::adminLog('update', $msg);
//                Yii::$app->config->save();
                return ['status' => true, 'message' => $msg];
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->updateAll(['is_del' => 1], ['id' => $id]);
        $msg = "删除项目[$model->name]成功";
        Utils::adminLog('delete', $msg);
        return ['status' => true, 'message' => $msg];
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLevel()
    {
        $model=Config::find()->where(['name' => 'warning_info'])->one();
        $data=json_decode($model->data,true);
        if (Yii::$app->request->isPost) {
            $low = Yii::$app->request->post('low');
            $middle = Yii::$app->request->post('middle');
            $high = Yii::$app->request->post('high');
            $data=[];
            $data['low']=$low;
            $data['middle']=$middle;
            $data['high']=$high;
            $model->data=json_encode($data);
            if($model->save()) {
                $msg = "配置成功";
                Utils::adminLog('update', $msg);
                return ['status' => true, 'message' => $msg];
            }else{
                return ['status' => false, 'message' => '配置失败'];
            }

        }
        return $this->render('level', ['model' => $model,'data'=>$data]);
    }
}
