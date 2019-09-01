<?php

namespace backend\controllers;

use Yii;
use common\models\Parts;
use backend\models\SearchParts;
use common\models\PartsCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        $searchModel = new SearchParts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        $category = PartsCategories::findOne($id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    /**
     * Displays a single Parts model.
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
     * Creates a new Parts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Parts();
        
        $part_category = PartsCategories::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Запчасть добавлена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'part_category' => $part_category
        ]);
    }

    /**
     * Updates an existing Parts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $part_category = PartsCategories::findOne($model->pc_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Запчасть изменена");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'part_category' => $part_category
        ]);
    }

    /**
     * Deletes an existing Parts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $item = $model->pc_id;
        $model->delete();
        Yii::$app->session->setFlash('success', "Запчасть удалена");
        return $this->redirect(['index', 'id' => $item]);
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
}
