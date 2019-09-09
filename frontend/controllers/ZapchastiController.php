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
        return $this->render('index');
    }

    /**
     * Displays a single PartsCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategory($alias)
    {
        $model = $this->addToCache('part_category_'.$alias, PartsCategories::find()->where(['alias' => $alias])->andWhere(['is', 'parent', null])->orWhere(['parent' => 0])->one());
        
        if(!$model){
             throw new \yii\web\HttpException(404, 'Такой страницы нет');
        }
        
        if(@$_COOKIE['fModel'] && $_COOKIE['fModel'] != $model->id){
            setcookie('fModel', $model->id, 0, '/');
            setcookie('fGen', '', time() - 100, '/');
            setcookie('fMotor', '', time() - 100, '/');
        }
        
        $cat_id = $model->id;
        $car_id = $model->car->id;
        $car = $model->car;
        
        $slug = '';
        if(Yii::$app->request->get('s')){
            $slug = Yii::$app->request->get('s');
        }
        
        $f_gen = '';
        $gen_links = array();
        if (@$_COOKIE['fGen']) {
            $f_gen = $_COOKIE['fGen'];
            $gen_links = array('id' => \yii\helpers\ArrayHelper::map(\common\models\PartsGenerations::find()
                ->where([
                    'generation_id' => $f_gen
                ])->all(), 'id', 'part_id'));
        }
        
        $links = \yii\helpers\ArrayHelper::map(\common\models\PartcatsParts::find()
                ->where([
                    'part_category_id' => \yii\helpers\ArrayHelper::map(PartsCategories::find()->where(['parent' => $model->id])->all(), 'id', 'id')
                ])->all(), 'id', 'part_id');
        
        $parts = $this->addToCache(
            'parts_subcats_'.$model->alias .'_' . $f_gen,
            \common\models\Parts::find()->where(['parts.id' => $links])->andWhere($gen_links)->with([
                'generation' => function($query) use($car_id){
                    return $query->select('generations.id, generations.alter_title, generations.title')
                            ->where('car_id = ' . $car_id); 
                    },
                'cats' => function($query) use($cat_id){
                    return $query->select('parts_categories.id, parts_categories.title, parts_categories.alias')
                            ->where('parent = ' . $cat_id);
                },
                 'brand'
             ])->asArray()->all()
         );
          $cats = $this->getTree($parts);
          
        $parents = $this->addToCache('parents_cats_parts', PartsCategories::find()->where(['is', 'parent', null])->orWhere(['parent' => 0])->all());
      
        return $this->render('view', [
            'model' => $model,
            'cats' => $cats,
            'parents' => $parents,
            'f_gen' => $f_gen,
            'slug' => $slug,
            'car' => $car
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
    
    protected function addToCache($cache_name, $data = null)
    {
        $cache_data = Yii::$app->cache->get($cache_name);
        if(!$cache_data){
            $cache_data = $data;
            Yii::$app->cache->set($cache_name, $cache_data, $this->cache_time);
        }
        return $cache_data;
    }
    
    protected function getTree($arr)
    {
        $new_arr = array();
        $cats = array();
        foreach($arr as $key => $value){
            $cats[$value['cats'][0]['id']]['title'] = $value['cats'][0]['title'];
            $cats[$value['cats'][0]['id']]['alias'] = $value['cats'][0]['alias'];
            $cats[$value['cats'][0]['id']]['parts'] = array();
        }
        foreach($cats as $key => $value){
            foreach($arr as $k => $v){
              if($v['cats'][0]['id'] == $key){
                  $new_arr[$key]['title'] = $value['title'];
                  $new_arr[$key]['alias'] = $value['alias'];
                  $new_arr[$key]['parts'][$k] = $v;
                  unset($new_arr[$key]['parts'][$k]['cats']);
              }
            }
        }
        return $new_arr;
    }
}
