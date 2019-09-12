<?php

namespace backend\controllers;

use Yii;
use common\models\PartsCategories;
use backend\models\SearchPartsCategories;
use common\models\Cars;
use common\models\Parts;
use common\models\Brands;
use common\models\UploadFile;
use yii\web\UploadedFile;
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
        
        $dataPParts = new yii\data\ActiveDataProvider([
            'query' => Parts::find()
        ]);
        
        $model = new UploadFile();
        
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                $data = \moonland\phpexcel\Excel::import('uploads/' . $model->file->name, [
                    'setFirstRecordAsKeys' => false,  
                    'setIndexSheetByName' => false
                ]); 
             
                foreach($data as $key => $value){
                    
                    if($value['B'] == 'ID'){
                        continue;
                    }
                    
                    if($value['F'] == 'Да'){
                        $value['F'] = 1;
                    }
                    
                    if($value['G'] == 'Да'){
                        $value['G'] = 1;
                    }
                    
                    $id = $value['B'];
                    $item = Parts::findOne($id);
                    if(!$item){
                        $item = new Parts();
                    }
                    
                    $brand = Brands::find()->where(['title' => $value['H']])->one();
                    if(!$brand){
                        $brand = new Brands();
                        $brand->title = $value['H'];
                        $brand->save();
                    }
                    
                    $categories = explode(', ', $value['I']);
                    
                    $item->title = $value['C'];
                    $item->price = $value['D'];
                    $item->code = $value['E'];
                    $item->check = $value['F'];
                    $item->original = $value['G'];
                    $item->brand_id = $brand->id;
                    $item->categories = $categories;
                    print_r($item->categories);
                }
                Yii::$app->session->setFlash('success', "Импорт выполнен");
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataPParts' => $dataPParts,
            'model' => $model
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
      
            foreach($parts as $k => $v){
                $cats_arr = array();
                foreach($cats as $key => $value){
                    foreach($v['id_car'] as $k_car => $v_car){
                        if($value->car_id == $v_car && $v['alias'] == $value->alias){
                            $cats_arr[] = $value->id;
                        }
                     }
                }
                $model = Parts::find()->where(['title' => $v['title'], 'code' => $v['code'],'price' => $v['price']])->one();
                if(!$model){
                     $model = new Parts();
                }
                $brand = Brands::find()->where(['title' => $v['brand']])->one();
                if(!$brand){
                    $brand = new Brands();
                    $brand->title = $v['brand'];
                    $brand->save();
                }
                $model->title = $v['title'];
                $model->price = $v['price'];
                $model->code = $v['code'];
                $model->original = $v['original'];
                $model->brand_id = $brand->id;
                $model->categories = $cats_arr;
                $model->cars = $v['id_car'];
                $model->generations = $v['id_gen'];;
                $model->save();
              /*  foreach($v['id_car'] as $k_car => $v_car){
                   if($value->car_id == $v_car){
                       $car_arr[] = $value->car_id;
                       $cats_arr[] = $value->id;
                   }
                }
                if($value->car->generations && !empty($value->car->generations)){
                    foreach($value->car->generations as $c_key => $c_gen){
                        foreach($v['id_gen'] as $k_gen => $v_gen){
                            if($c_gen->id == $v_gen){
                               $gen_arr[] = $c_gen->id;
                           }
                        }
                    }
                }*/
                
             }
      exit();
    }
}
