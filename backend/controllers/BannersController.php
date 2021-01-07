<?php

namespace backend\controllers;

use Yii;
use common\models\Banners;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannersController implements the CRUD actions for Banners model.
 */
class BannersController extends SiteController
{
   
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banners::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banners model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banners();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
            $model->tmp_img = Yii::$app->security->generateRandomString();
            $model->img = $model->tmp_img . '.' . $model->image->getExtension();
       //     print_r($model->img);
       //     exit();
            if($model->save()){
                Yii::$app->session->setFlash('success', "Баннер добавлен");
                 return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
            if($model->image && !empty($model->image)){
                if(file_exists(Yii::getAlias('@frontend/web/upload/banners/prev') . '/thumb_' . $model->img)){
                    unlink(Yii::getAlias('@frontend/web/upload/banners/prev') . '/thumb_' . $model->img);
                 }
                 if(file_exists(Yii::getAlias('@frontend/web/upload/banners/original') . $model->img)){
                     unlink(Yii::getAlias('@frontend/web/upload/banners/original/') . $model->img);
                 }
                $model->tmp_img = Yii::$app->security->generateRandomString();
                $model->img = $model->tmp_img . '.' . $model->image->getExtension();
            }
            if($model->save()){
                Yii::$app->session->setFlash('success', "Баннер изменен");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(file_exists(Yii::getAlias('@frontend/web/upload/banners/prev') . '/thumb_' . $model->img)){
           unlink(Yii::getAlias('@frontend/web/upload/banners/prev') . '/thumb_' . $model->img);
        }
        if(file_exists(Yii::getAlias('@frontend/web/upload/banners/original') . $model->img)){
            unlink(Yii::getAlias('@frontend/web/upload/banners/original/') . $model->img);
        }
        $model->delete();
        Yii::$app->session->setFlash('success', "Баннер удален");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Banners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
