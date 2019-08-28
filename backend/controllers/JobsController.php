<?php

namespace backend\controllers;

use Yii;
use common\models\Jobs;
use common\models\JobsCategories;
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
        $dataProvider = new ActiveDataProvider([
            'query' => Jobs::find()->where(['jc_id' => $id]),
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        
        $job_category = JobsCategories::findOne($id);
        $generations = \common\helpers\HelpersFunctions::idList(Generations::find()->where(['car_id' => $job_category->car_id])->indexBy('id')->asArray()->all());
        $engines = Engines::find()->where(['generation_id' => $generations])
                    ->select(['engines.id', 'engines.title', 'engines.generation_id'])
                    ->with([
                         'generation' => function($query){
                             $query->select('id, alter_title');
                         },
                    ])
                    ->indexBy('id')->asArray()->all();
     //   $engines = \common\helpers\HelpersFunctions::arrForEnginesList($engines, $job_category->car->title);
        
        $years =  \common\helpers\HelpersFunctions::arrForList(Years::find()->select(['id', 'title'])->asArray()->all());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Работа добавлена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'job_category' => $job_category,
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $job_category = JobsCategories::findOne($model->jc_id);
        $generations = \common\helpers\HelpersFunctions::idList(Generations::find()->where(['car_id' => $job_category->car_id])->indexBy('id')->asArray()->all());
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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'job_category' => $job_category,
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
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $item = $model->jc_id;
        $model->delete();
        Yii::$app->session->setFlash('success', "Работа удалена");
        return $this->redirect(['index', 'id' => $item]);
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
