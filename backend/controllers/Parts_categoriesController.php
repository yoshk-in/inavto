<?php

namespace backend\controllers;

use Yii;
use common\models\PartsCategories;
use backend\models\SearchPartsCategories;
use common\models\Cars;
use common\models\Parts;
use common\models\Brands;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PartsCategoriesController implements the CRUD actions for PartsCategories model.
 */
class Parts_categoriesController extends SiteController
{
    /**
     * Lists all PartsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPartsCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PartsCategories model.
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
     * Creates a new PartsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PartsCategories();
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(PartsCategories::find()->where(['parent' => null])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');

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
     * Updates an existing PartsCategories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');
        
        $parents = \yii\helpers\ArrayHelper::map(PartsCategories::find()->where(['parent' => null])->andWhere(['!=', 'id', $id])->select(['id', 'title'])->asArray()->indexBy('id')->all(), 'id', 'title');

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
     * Deletes an existing PartsCategories model.
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
    
    public function actionSet()
    {
      $cats = PartsCategories::find()->where(['>', 'parent', 0])->all();
      $parts = \common\helpers\HelpersFunctions::jobsArr();
    //  print_r($parts);
        foreach($cats as $key => $value){
            $car_arr = array();
            $cats_arr = array();
            foreach($parts as $k => $v){
                if(in_array($value->car_id, $v['id_car'])){
                    if(!in_array($value->car_id, $car_arr)){
                        $car_arr[] = $value->car_id;
                    }
                    if(!in_array($value->id, $cats_arr)){
                        $cats_arr[] = $value->id;
                    }
                    $gen_arr = array();
                    foreach($value->car->generations as $g_k => $g_v){
                        if(in_array($g_v->id, $v['id_gen'])){
                            if(!in_array($g_v->id, $gen_arr)){
                                $gen_arr[] = $g_v->id;
                            }
                            $model = Parts::find()->where(['title' => $v['title'], 'code' => $v['code'],'price' => $v['price']])->one();
                            if(!$model){
                                $model = new Parts();
                            }
                            $brand = Brands::find()->where(['title' => $v['brand']])->one();
                            if(!$brand){
                                $brand = new Brands();
                                $brand->title = $v['vendor'];
                                $brand->save();
                            }
                            $model->title = $v['title'];
                            $model->price = $v['price'];
                            $model->code = $v['code'];
                            $model->original = $v['original'];
                            $model->brand_id = $brand->id;
                            $model->generations = $gen_arr;
                            $model->cars = $car_arr;
                            $model->categories = $cats_arr;
                            $model->save();
                        }
                    }
                }
             }
          }
      exit();
    }
}
