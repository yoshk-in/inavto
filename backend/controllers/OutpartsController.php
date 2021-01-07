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
 * OutpartsController implements the CRUD actions for Parts model.
 */
class OutpartsController extends SiteController
{
    public function actionIndex()
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        
        $selected_categories = PartsCategories::find()->where(['id' => \yii\helpers\ArrayHelper::map($model->cats, 'id', 'id')])->all();
        $selected_cars = Cars::find()->where(['id' => \yii\helpers\ArrayHelper::map($model->avtos, 'id', 'id')])->all();
        $value_cars = \yii\helpers\ArrayHelper::map($selected_cars, 'id', 'id');
        $value_cats = \yii\helpers\ArrayHelper::map($selected_categories, 'id', 'id');
        $part_categories = \yii\helpers\ArrayHelper::map(PartsCategories::find()
                ->where(['>', 'parent', 0])
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
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'part_categories' => $part_categories,
            'engines' => $engines,
            'cars' => $cars,
            'value_cats' => $value_cats,
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
