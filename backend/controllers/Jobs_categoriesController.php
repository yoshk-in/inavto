<?php

namespace backend\controllers;

use Yii;
use common\models\JobsCategories;
use common\models\Cars;
use common\models\Jobs;
use common\models\JobcatsJobs;
use backend\models\SearchJobsCategories;
use common\models\UploadFile;
use yii\web\UploadedFile;
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
        
        $dataJobs = new yii\data\ActiveDataProvider([
            'query' => Jobs::find()
        ]);
        
        $model = new UploadFile();
        
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                $data = \moonland\phpexcel\Excel::import('uploads/' . $model->file->name, [
                    'setFirstRecordAsKeys' => false,  
                    'setIndexSheetByName' => true
                ]); 
             unset($data[1]);
            
                foreach($data as $key => $value){
                    
                    $new_val = array_values($value);
                    
                    $id = $new_val[1];
                    $item = Jobs::findOne($id);
                    if(!$item){
                        $item = new Jobs();
                    }
                    
                    $categories = explode(',', $new_val[4]);
                    $new_arr = array();
                    foreach($categories as $k => $v){
                        if(!$v){
                            continue;
                        }
                        $new_arr[] = (int) trim($v);
                    }
                   
                    $generations = explode(',', $new_val[6]);
                    $new_arr2 = array();
                    foreach($generations as $k => $v){
                        if(!$v){
                            continue;
                        }
                        $new_arr2[] = (int) trim($v);
                    }
                    
                    $engines = explode(',', $new_val[7]);
                    $new_arr3 = array();
                    foreach($engines as $k => $v){
                        if(!$v){
                            continue;
                        }
                        $new_arr3[] = (int) trim($v);
                    }
                    
                    $item->title = (string) $new_val[2];
                    $item->price = (int) $new_val[3];
                    $item->works = $new_arr;
                    $item->generations = $new_arr2;
                    $item->engines = $new_arr3;
                    $item->save();
                }
                Yii::$app->session->setFlash('success', "Импорт выполнен");
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJobs' => $dataJobs,
            'model' => $model
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
    
    public function actionSetcats()
    {
        /*
        $parents = JobsCategories::find()->where(['parent' => null, 'service' => 1])->all();
       // $cats_titles = \yii\helpers\ArrayHelper::map(JobsCategories::find()->select('id', 'title')->all(), 'id', 'title');
    //    $cats_cars = \yii\helpers\ArrayHelper::map(JobsCategories::find()->select('id', 'car_id')->all(), 'id', 'car_id');
        foreach($parents as $key => $value){
            $childs = JobsCategories::find()->where(['parent' => $value->parent]);
            foreach($childs as $k => $v){
                $model = new Jobs();
                $model->title = $v['name'];
                $model->service = null;
                $model->car_id = $value->car->id;
                $model->parent = $value->id;
                $model->save();
            }
        }
        Yii::$app->session->setFlash('success', "Категории занесены");
        return $this->redirect(['index']);
         * /
         */
    //  print_r(\common\helpers\HelpersFunctions::jobsArr());
      $cats = JobsCategories::find()->where(['>', 'parent', 0])->all();
      $jobs = \common\helpers\HelpersFunctions::jobsArr();
      $arr_types = [0 => 'repair',1 => 'service'];
      
      foreach($arr_types as $t_key => $t_value){
        foreach($cats as $key => $value){
            foreach($jobs as $k => $v){
                $job_cat = \yii\helpers\ArrayHelper::map(JobcatsJobs::find()->where(['job_category_id' => $value->id])->all(), 'id', 'job_id');
                if(!$job_cat){
                    $job_cat = 1;
                }
                $model = Jobs::find()->where(['title' => $v['name'], 'id' => $job_cat])->one();

                if(!$model && $value->alias == $v['system']){
                    if(($value->service == $t_key && $v['type'] == $t_value) || ($value->service == 1 && $v['type'] == 'mixed')){
                        $model = new Jobs();
                        $model->title = $v['name'];
                        $model->works = array($value->id);
                        $model->save();
                    }      
                }
             }
          }
      }
      exit();
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
