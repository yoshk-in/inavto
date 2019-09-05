<?php

namespace frontend\controllers;

use Yii;
use common\models\PartsCategories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ZapchastiController implements the CRUD actions for PartsCategories model.
 */
class ZapchastiController extends SiteController
{
    /**
     * Lists all PartsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PartsCategories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PartsCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategory($alias)
    {
        $model = Yii::$app->cache->get('part_category_'.$alias);
        if(!$model){
            $model = PartsCategories::find()->where(['alias' => $alias])->andWhere(['is', 'parent', null])->one();
            Yii::$app->cache->set('part_category_'.$model->alias, $model, $this->cache_time);
        }
        if(!$model){
             throw new \yii\web\HttpException(404, 'Такой страницы нет');
        }
        $cats = Yii::$app->cache->get('parts_subcats_'.$model->alias);
        if(!$cats){
            $cats = PartsCategories::find()->where(['parent' => $model->id])->with(['parts'])->all();
            Yii::$app->cache->set('parts_subcats_'.$model->alias, $cats, $this->cache_time);
        }
        
        return $this->render('view', [
            'model' => $model,
            'cats' => $cats
        ]);
    }

    /**
     * Creates a new PartsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PartsCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PartsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PartsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PartsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PartsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PartsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
