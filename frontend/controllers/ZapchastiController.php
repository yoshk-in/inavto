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
        $page = \backend\models\Pages::find()->where(['alias' => 'zapchasti'])->one();
        $this->setMeta($page->meta_title, $page->keywords, $page->description);
        if($this->layout == 'mobile'){
           return $this->render('mobile_index', [
                'page' => $page,
            ]); 
        }
        return $this->render('index', ['page' => $page]);
    }

    /**
     * Displays a single PartsCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategory($alias)
    {
        $model = Yii::$app->cache->get('part_category_'.$alias);
        if(!$model){
            $model = PartsCategories::find()->where(['alias' => $alias])->andWhere(['is', 'parent', null])->orWhere(['parent' => 0])->one();
            Yii::$app->cache->set('part_category_'.$alias, $model, $this->cache_time);
        }
        
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
        
        $cats = Yii::$app->cache->get('parts_subcats_'.$model->alias .'_' . $f_gen);
        if(!$cats){
            $parts = \common\models\Parts::find()->where(['parts.id' => $links])->andWhere($gen_links)->with([
                'generation' => function($query) use($car_id){
                    return $query->select('generations.id, generations.alter_title, generations.title')
                            ->where('car_id = ' . $car_id); 
                    },
                'cats' => function($query) use($cat_id){
                    return $query->select('parts_categories.id, parts_categories.title, parts_categories.alias')
                            ->where('parent = ' . $cat_id);
                },
                 'brand'
             ])->asArray()->all();
            $cats = $this->getTree($parts);
            Yii::$app->cache->set('parts_subcats_'.$model->alias .'_' . $f_gen, $cats, $this->cache_time);
        }
            
        $parents = Yii::$app->cache->get('parents_cats_parts');
        if(!$parents){
            $parents = PartsCategories::find()->where(['is', 'parent', null])->orWhere(['parent' => 0])->all();
            Yii::$app->cache->set('parents_cats_parts', $parents, $this->cache_time);
        }
        
        $this->setMeta($model->meta_title, $model->keywords, $model->description);
        Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => \yii\helpers\Url::to(['zapchasti/category', 'alias' => $alias], true)]);
        
        if($this->layout == 'mobile'){
           return $this->render('mobile_view', [
                'model' => $model,
                'cats' => $cats,
                'parents' => $parents,
                'f_gen' => $f_gen,
                'slug' => $slug,
                'car' => $car
            ]); 
        }
        
        return $this->render('view', [
            'model' => $model,
            'cats' => $cats,
            'parents' => $parents,
            'f_gen' => $f_gen,
            'slug' => $slug,
            'car' => $car
        ]);
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
