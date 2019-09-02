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
      
        foreach($cats as $key => $value){
            foreach($parts as $k => $v){
                $model = Parts::find()->where(['title' => $v['name'], 'pc_id' => $value->id])->one();
                if(!$model && $value->alias == $v['system']){
                        $model = new Parts();
                        $brand = Brands::find()->where(['title' => $v['vendor']])->one();
                        if(!$brand){
                            $brand = new Brands();
                            $brand->title = $v['vendor'];
                            $brand->save();
                        }
                        $model->title = $v['partName'];
                        $model->car_id = $value->car_id;
                        $model->pc_id = $value->id;
                        $model->original = $v['original'] ? $v['original'] : null;
                        $model->code = $v['articul'];
                        $model->price = $v['price'];
                        $model->brand_id = $brand->id;
                        $model->save();
                }
             }
          }
      exit();
    }
}
