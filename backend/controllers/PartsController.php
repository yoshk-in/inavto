<?php

namespace backend\controllers;

use Yii;
use common\models\Parts;
use backend\models\SearchParts;
use common\models\PartsCategories;
use common\models\Jobs;
use common\models\Cars;
use common\models\Generations;
use common\models\Engines;
use common\models\PartcatsParts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * PartsController implements the CRUD actions for Parts model.
 */
class PartsController extends Controller
{
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Lists all Parts models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $cats = \yii\helpers\ArrayHelper::map(PartcatsParts::find()->where(['part_category_id' => $id])->select('id, part_id')->all(), 'id', 'part_id');
        $dataProvider = new ActiveDataProvider([
            'query' => Parts::find()->where(['id' => $cats])
        ]);
        
        $part_category = PartsCategories::findOne($id);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'part_category' => $part_category
        ]);
    }
    
    public function actionOut()
    {
        $cats = \yii\helpers\ArrayHelper::map(PartcatsParts::find()->select('id, part_id')->all(), 'id', 'part_id');
        $dataProvider = new ActiveDataProvider([
            'query' => Parts::find()->where(['not', ['id' => $cats]])
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Parts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cat_id, $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'cat_id' => $cat_id
        ]);
    }
    /**
     * Creates a new Parts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Parts();
        
        $current_category = PartsCategories::findOne($id);
        $value_cats = $current_category->id;
        $part_categories = \yii\helpers\ArrayHelper::map(PartsCategories::find()
                ->where(['>', 'parent', 0])
                ->andWhere(['alias' => $current_category->alias])
                ->all(), 'id', 'title');
        $generations = \yii\helpers\ArrayHelper::map((Generations::find()->where(['car_id' => $current_category->car_id])->indexBy('id')->asArray()->all()), 'id', 'id');
        $engines = Engines::find()->where(['generation_id' => $generations])
                    ->select(['engines.id', 'engines.title', 'engines.generation_id'])
                    ->with([
                         'generation' => function($query){
                             $query->select('id, alter_title');
                         },
                    ])
                    ->indexBy('id')->asArray()->all();
        
        $value_cars = $current_category->car->id;
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->all(), 'id', 'title');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Запчасть добавлена");
            return $this->redirect(['view', 'cat_id' => $current_category->id, 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'part_categories' => $part_categories,
            'current_category' => $current_category,
            'value_cats' => $value_cats,
            'engines' => $engines,
            'cars' => $cars,
            'value_cars' => $value_cars,
        ]);
    }
    /**
     * Updates an existing Parts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cat_id, $id)
    {
        $model = $this->findModel($id);
        
        $selected_categories = PartsCategories::find()->where(['id' => \yii\helpers\ArrayHelper::map($model->cats, 'id', 'id')])->all();
        $selected_cars = Cars::find()->where(['id' => \yii\helpers\ArrayHelper::map($model->avtos, 'id', 'id')])->all();
        $value_cats = \yii\helpers\ArrayHelper::map($selected_categories, 'id', 'id');
        $value_cars = \yii\helpers\ArrayHelper::map($selected_cars, 'id', 'id');
        $current_category = PartsCategories::find()->where(['id' => $cat_id])->one();
        $part_categories = \yii\helpers\ArrayHelper::map(PartsCategories::find()
                ->where(['>', 'parent', 0])
                ->andWhere(['alias' => $current_category->alias])
                ->all(), 'id', 'title');
        $generations = \yii\helpers\ArrayHelper::map((Generations::find()->where(['car_id' => $value_cars])->indexBy('id')->asArray()->all()), 'id', 'id');
        $engines = Engines::find()->where(['generation_id' => $generations])
                    ->select(['engines.id', 'engines.title', 'engines.generation_id'])
                    ->with([
                         'generation' => function($query){
                             $query->select('id, alter_title');
                         },
                    ])
                    ->indexBy('id')->asArray()->all();
        
        $cars = \yii\helpers\ArrayHelper::map(Cars::find()->all(), 'id', 'title');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Запчасть изменена");
            return $this->redirect(['view', 'cat_id' => $current_category->id, 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'part_categories' => $part_categories,
            'current_category' => $current_category,
            'value_cats' => $value_cats,
            'engines' => $engines,
            'cars' => $cars,
            'value_cars' => $value_cars,
        ]);
    }
    /**
     * Deletes an existing Parts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cat_id, $id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Запчасть удалена");
        return $this->redirect(['index', 'id' => $cat_id]);
    }
    /**
     * Finds the Parts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parts::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionGenerations($id = null, $current_id = null)
    {
        $arr = array();
        $default_arr = array();
        if($id){
            $arr = explode(',',$id);
        }
        if($current_id){
            $default_arr = explode(',',$current_id);
        }
        $data = \common\models\Generations::find()->select(['id', 'title', 'car_id'])->where(['car_id' => $arr])->all();
        return $this->renderAjax('_option_generations', compact('data', 'default_arr'));
    }
    
    public function actionEngines($id = null, $current_id = null)
    {
        $arr = array();
        $default_arr = array();
        if($id){
            $arr = explode(',',$id);
        }
        if($current_id){
            $default_arr = explode(',', $current_id);
        }
        $data = \common\models\Engines::find()->select(['id', 'title', 'generation_id'])->where(['generation_id' => $arr])->all();
        return $this->renderAjax('_option_engines', compact('data', 'default_arr'));
    }
    
    public function actionJobs($id = null, $current_id = null)
    {
        $arr = array();
        $default_arr = array();
        $job_cats = array();
        if($id){
            $arr = explode(',',$id);
            $job_cats = \common\models\JobsCategories::find()
                    ->select(['id', 'car_id'])
                    ->with([
                        'car' => function($query){
                            $query->select('id, title');
                        },
                        'jobs' => function($query){
                            $query->select('id, title');
                        }
                      ])
                    ->where(['car_id'=>$arr])->asArray()->all();
             $data = array();
             foreach($job_cats as $key => $value){
                 foreach($value['jobs'] as $k => $v){
                     $data[$v['id']] = $value['car']['title'] . ' - ' . $v['title'];
                 }
             }
             
        }
        if($current_id){
            $default_arr = explode(',', $current_id);
        }
        return $this->renderAjax('_option_jobs', compact('data', 'default_arr'));
    }
}
