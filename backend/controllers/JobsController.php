<?php

namespace backend\controllers;

use Yii;
use common\models\Jobs;
use common\models\JobsCategories;
use common\models\JobcatsJobs;
use common\models\Generations;
use common\models\Engines;
use common\models\Years;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends Controller
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
     * Lists all Jobs models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $cats = \yii\helpers\ArrayHelper::map(JobcatsJobs::find()->where(['job_category_id' => $id])->select('id, job_id')->all(), 'id', 'job_id');
        $dataProvider = new ActiveDataProvider([
            'query' => Jobs::find()->where(['id' => $cats])
        ]);
        
        $job_category = JobsCategories::findOne($id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'job_category' => $job_category
        ]);
    }

    /**
     * Displays a single Jobs model.
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
     * Creates a new Jobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Jobs();
        
        $current_category = JobsCategories::findOne($id);
        $vaule_cats = $current_category->id;
        $job_categories = \yii\helpers\ArrayHelper::map(JobsCategories::find()
                ->where(['>', 'parent', 0])
                ->andWhere(['car_id' => $current_category->car_id, 'alias' => $current_category->alias])
                ->all(), 'id', 'title');
        $generations = \common\helpers\HelpersFunctions::idList(Generations::find()->where(['car_id' => $current_category->car_id])->indexBy('id')->asArray()->all());
        $engines = Engines::find()->where(['generation_id' => $generations])
                    ->select(['engines.id', 'engines.title', 'engines.generation_id'])
                    ->with([
                         'generation' => function($query){
                             $query->select('id, alter_title');
                         },
                    ])
                    ->indexBy('id')->asArray()->all();
     //   $engines = \common\helpers\HelpersFunctions::arrForEnginesList($engines, $job_category->car->title);
        
        $years = \yii\helpers\ArrayHelper::map(Years::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
        /*if($model->Load(Yii::$app->request->post())){
            print_r($model);
            exit();
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Работа добавлена");
            return $this->redirect(['view', 'cat_id' => $current_category->id, 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'job_categories' => $job_categories,
            'current_category' => $current_category,
            'vaule_cats' => $vaule_cats,
            'engines' => $engines,
            'years' => $years
        ]);
    }

    /**
     * Updates an existing Jobs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cat_id, $id)
    {
        $model = $this->findModel($id);
        
        $selected_categories = JobsCategories::find()->where(['id' => \yii\helpers\ArrayHelper::map($model->cats, 'id', 'id')])->all();
        $vaule_cats = \yii\helpers\ArrayHelper::map($selected_categories, 'id', 'id');
        $current_category = JobsCategories::find()->where(['id' => $cat_id])->one();
       
       // $job_categories = \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['>', 'parent', 0])->all(), 'id', 'title');
        $job_categories = \yii\helpers\ArrayHelper::map(JobsCategories::find()
                ->where(['>', 'parent', 0])
                ->andWhere(['car_id' => $current_category->car_id, 'alias' => $current_category->alias])
                ->all(), 'id', 'title');
        $generations = \common\helpers\HelpersFunctions::idList(Generations::find()->where(['car_id' => $current_category->car_id])->indexBy('id')->asArray()->all());
        $engines = Engines::find()->where(['generation_id' => $generations])
                    ->select(['engines.id', 'engines.title', 'engines.generation_id'])
                    ->with([
                         'generation' => function($query){
                             $query->select('id, alter_title');
                         },
                    ])
                    ->indexBy('id')->asArray()->all();
        
        $years = \yii\helpers\ArrayHelper::map(Years::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Работа изменена");
            return $this->redirect(['view', 'cat_id' => $cat_id, 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'job_categories' => $job_categories,
            'current_category' => $current_category,
            'vaule_cats' => $vaule_cats,
            'engines' => $engines,
            'years' => $years
        ]);
    }

    /**
     * Deletes an existing Jobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cat_id, $id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Работа удалена");
        return $this->redirect(['index', 'id' => $cat_id]);
    }
    
    public function actionGenerations($id = null, $current_id = null)
    {
        $arr = array();
        if($current_id){
            $arr = str_split($current_id);
        }
        $data = \common\models\Generations::find()->select(['id', 'title'])->where(['car_id' => $id])->all();
        return $this->renderAjax('_option_generations', compact('data', 'arr'));
    }
    
    public function actionEngines($id = null, $current_id = null)
    {
        $arr = array();
        $default_arr = array();
        if($id){
            $arr = str_split($id);
        }
        if($current_id){
            $default_arr = str_split($current_id);
        }
        $data = \common\models\Engines::find()->select(['id', 'title'])->where(['generation_id' => $arr])->all();
        return $this->renderAjax('_option_engines', compact('data', 'default_arr'));
    }

    /**
     * Finds the Jobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
