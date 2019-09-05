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
        
        $slug = '';
        if(Yii::$app->request->get('s')){
            $slug = Yii::$app->request->get('s');
        }
        
        $cats = Yii::$app->cache->get('parts_subcats_'.$model->alias);
        if(!$cats){
            $cats = PartsCategories::find()->where(['parent' => $model->id])->with(['parts'])->all();
            Yii::$app->cache->set('parts_subcats_'.$model->alias, $cats, $this->cache_time);
        }
        
        $parents = Yii::$app->cache->get('parents_cats_parts');
        if(!$parents){
            $parents = PartsCategories::find()->where(['is', 'parent', null])->all();
            Yii::$app->cache->set('parents_cats_parts', $parents, $this->cache_time);
        }
        
        $f_gen = '';
        if ($_COOKIE['fGen'] !== null) {
            $f_gen = $_COOKIE['fGen'];
        }
        if($_COOKIE['fModel'] && $_COOKIE['fModel'] != $model->id){
            setcookie('fModel', '', time() - 100, '/');
            setcookie('fGen', '', time() - 100, '/');
            $f_gen = '';
        }
        
        return $this->render('view', [
            'model' => $model,
            'cats' => $cats,
            'parents' => $parents,
            'f_gen' => $f_gen,
            'slug' => $slug
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
