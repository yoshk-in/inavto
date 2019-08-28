<?php

namespace backend\controllers;

use Yii;
use common\models\JobsCategories;
use common\models\Cars;
use backend\models\SearchJobsCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * JobsCategoriesController implements the CRUD actions for JobsCategories model.
 */
class Jobs_categoriesController extends SiteController
{
    /**
     * Lists all JobsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchJobsCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobsCategories model.
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
     * Creates a new JobsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JobsCategories();
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => null])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Категория добавлена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cars' => $cars,
            'parents' => $parents
        ]);
    }

    /**
     * Updates an existing JobsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => null])->andWhere(['!=', 'id', $id])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Категория изменена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cars' => $cars,
            'parents' => $parents
        ]);
    }

    /**
     * Deletes an existing JobsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Категория удалена");
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
   /* public function setAlias($model)
    {
        if(!$model->alias){
            $model->on(JobsCategories::EVENT_AFTER_INSERT, function($event){
               $cat = $this->findModel($event->data);
               $cat->alias = \common\helpers\HelpersFunctions::translit($cat->menu_title);
               $cat->save();
            }, $model->id);
            $model->trigger(JobsCategories::EVENT_AFTER_INSERT);
        }
    }*/
    
}
