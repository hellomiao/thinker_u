<?php

namespace app\home\controllers;

use app\home\components\BaseController;
use app\base\lib\Utils;
use app\home\models\UserGroup;
use app\home\models\UserGroupacl;
use Yii;
use app\admin\models\AdminGroup;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use app\admin\models\AdminGroupAcl;

/**
 * GroupController implements the CRUD actions for AdminGroup model.
 */
class GroupController extends BaseController
{


    /**
     * Lists all AdminGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserGroup::find()->where(['platform_id'=>[0,$this->platform_id]]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionSetAcl(){
        $id = Yii::$app->request->get('id');
        $groupAclModel = new UserGroupacl();
        $json =$groupAclModel->getJsonData($id,$this->platform_id);
        $model = UserGroup::findOne($id);
        $group_name = $model->group_name;
        if(Yii::$app->request->isAjax&&!Yii::$app->request->isPjax){
            $ids = Yii::$app->request->post('acl_ids');
            $id = Yii::$app->request->post('id');
            $model = UserGroup::findOne($id);
            $group_name = $model->group_name;
            $isExists=$groupAclModel->find()->where(['group_id'=>$id])->exists();
            if(!$isExists) {
                $groupAclModel->platform_id=$this->platform_id;
                $groupAclModel->group_id = $id;
                $groupAclModel->acl_ids = $ids;
                $groupAclModel->save();
            }else{
                $groupAclModel->updateAll(['acl_ids'=>$ids],['group_id'=>$id]);
            }

            $msg ="更新权限[$group_name]成功";
            Utils::log('setacl',$msg);
            return ['status'=>true,'message'=>$msg];
        }else {
            return $this->render('setAcl', ['json' => $json,"group_name"=>$group_name,'id'=>$id]);
        }
    }



    /**
     * Creates a new AdminGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGroup();

        if ($model->load(Yii::$app->request->post())) {
            $ret=ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            }else{
                $model->platform_id = $this->platform_id;
                $model->create_time=time();
                $model->save();
                $msg ="添加组[$model->group_name]成功";
                Utils::log('create',$msg);
                return ['status'=>true,'message'=>$msg];
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $ret=ActiveForm::validate($model);
            if (!$this->commit) {
                return $ret;
            }else{
                $model->save();
                $msg ="编辑组[$model->group_name]成功";
                Utils::log('update',$msg);
                return ['status'=>true,'message'=>$msg];
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdminGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $msg ="删除组[$model->group_name]成功";
        Utils::log('delete',$msg);
        return ['status'=>true,'message'=>$msg];
    }

    /**
     * Finds the AdminGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
