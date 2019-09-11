<?php

namespace frontend\controllers;

use Yii;
use common\models\JobsCategories;
use common\models\Jobs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RemontController implements the CRUD actions for JobsCategories model.
 */
class RemontController extends SiteController
{
    public function actionIndex()
    {
        $final_arr = Yii::$app->cache->get('all_remont_jobs');
        if(!$final_arr){
            $links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()
                ->where([
                    'job_category_id' => \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['is', 'service', null])->orWhere(['service' => 0])->all(), 'id', 'id')
                ])->all(), 'id', 'job_id');
            $jobs = Jobs::find()->where(['id' => $links])->with([
                'cats' => function($query){
                    return $query->where('service is null')->orWhere('service = 0');
                },
                'motors' => function($query){
                    return $query->select('id, title, generation_id')->orderBy('title')->with('generation');
                },
                'parts' => function($query){
                    return $query->select('id, price');
                }
            ])->asArray()->all();
            $remont_parents = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['service' => 0])->orWhere(['is', 'service', null])->andWhere(['is', 'parent', null])->with(['car'])->asArray()->all();
            $final_arr = $this->finalArr($remont_parents, $this->getTree($jobs));
            Yii::$app->cache->set('all_remont_jobs', $final_arr, $this->cache_time);
        }
    
       return $this->render('index',[
           'jobs' => $final_arr
       ]);
    }

    /**
     * Displays a single JobsCategories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategory($alias)
    {
        $model = JobsCategories::find()->where(['alias' => $alias, 'service' => 0])->orWhere(['is', 'service', null])->andWhere(['alias' => $alias])->one();
       
        if(!$model){
             throw new \yii\web\HttpException(404, 'Такой страницы нет');
        }
        
         if(@$_COOKIE['fModel'] && $_COOKIE['fModel'] != $model->id){
            setcookie('fModel', $model->id, 0, '/');
            setcookie('fGen', '', time() - 100, '/');
            setcookie('fMotor', '', time() - 100, '/');
        }
        
        $slug = '';
        if(Yii::$app->request->get('s')){
            $slug = Yii::$app->request->get('s');
        }
        
        $car = $model->car;
        
        $f_gen = '';
        $f_motor = '';
        $gen_links = array();
        $current_engines = array();
        
        if (@$_COOKIE['fModel'] && @$_COOKIE['fGen']) {
            $f_gen = $_COOKIE['fGen'];
            $current_engines = \common\models\Engines::find()->where(['generation_id' => $f_gen])->all();
            $gen_links = array('id' => \yii\helpers\ArrayHelper::map(\common\models\JobsGenerations::find()
                ->where([
                    'generation_id' => $f_gen
                ])->all(), 'id', 'job_id'));
        }
        
        
        $gen_motors = array();
        if (@$_COOKIE['fModel'] && @$_COOKIE['fGen'] && @$_COOKIE['fMotor']) {
            $f_motor = $_COOKIE['fMotor'];
            $gen_motors = array('id' => \yii\helpers\ArrayHelper::map(\common\models\EnginesJobs::find()
                ->where([
                    'engine_id' => $f_motor
                ])->all(), 'id', 'job_id'));
        }
        
        $final_arr = Yii::$app->cache->get('service_jobs_'.$alias.'_'.$f_gen.$f_motor);
        if(!$final_arr){
            $links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()
                ->where([
                    'job_category_id' => \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => $model->id])->andWhere(['is', 'service', null])->orWhere(['service' => 0])->andWhere(['parent' => $model->id])->all(), 'id', 'id')
                ])->all(), 'id', 'job_id');
            $jobs = Jobs::find()->where(['id' => $links])->andWhere($gen_links)->andWhere($gen_motors)->with([
                'cats' => function($query){
                    return $query->where('service is null')->orWhere('service = 0');
                },
                'motors' => function($query) use($f_gen){
                    if($f_gen){
                        $query->where('generation_id = '.$f_gen);
                    }
                    return $query->select('id, title, generation_id')->with('generation');
                },
                'parts' => function($query){
                    return $query->select('id, price');
                }
            ])->asArray()->all();
            $final_arr = $this->getTree($jobs);
            Yii::$app->cache->set('service_jobs_'.$alias.'_'.$f_gen.$f_motor, $final_arr, $this->cache_time);
        }
        
        $parents = Yii::$app->cache->get('parents_cats_jobs');
        if(!$parents){
            $parents = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['is', 'service', null])->orWhere(['service' => 0])->all();
            Yii::$app->cache->set('parents_cats_jobs', $parents, $this->cache_time);
        }
        
        return $this->render('view', [
            'jobs' => $final_arr,
            'model' => $model,
            'parents' => $parents,
            'f_gen' => $f_gen,
            'f_motor' => $f_motor,
            'slug' => $slug,
            'current_engines' => $current_engines,
            'car' => $car
        ]);
    }

    protected function findModel($id)
    {
        if (($model = JobsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function getTree($arr )
    {
        if(!$arr){
            return false;
        }
        $new_arr = array();
        $cats = array();
        foreach($arr as $key => $value){
            $cats[$value['cats'][0]['id']]['title'] = $value['cats'][0]['title'];
            $cats[$value['cats'][0]['id']]['alias'] = $value['cats'][0]['alias'];
            $cats[$value['cats'][0]['id']]['parent'] = $value['cats'][0]['parent'];
            $cats[$value['cats'][0]['id']]['jobs'] = array();
        }
        foreach($cats as $key => $value){
            $cat_jobs = array();
            foreach($arr as $k => $v){
              if($v['cats'][0]['id'] == $key){
                  if(in_array($v['title'], $cat_jobs)){
                   //   unset($v);
                      $new_arr[$key]['jobs'][array_search($v['title'], $cat_jobs)]['info'][$v['id']]['engines'] = $v['motors'];
                      $new_arr[$key]['jobs'][array_search($v['title'], $cat_jobs)]['info'][$v['id']]['price'] = $v['price'];
                      $new_arr[$key]['jobs'][array_search($v['title'], $cat_jobs)]['info'][$v['id']]['parts'] = $v['parts'];
                      continue;
                  }
                  $cat_jobs[$v['id']] = $v['title'];
                  $new_arr[$key]['title'] = $value['title'];
                  $new_arr[$key]['alias'] = $value['alias'];
                  $new_arr[$key]['parent'] = $value['parent'];
                  $new_arr[$key]['jobs'][$v['id']] = $v;
                  unset($new_arr[$key]['jobs'][$v['id']]['cats']);
                  $new_arr[$key]['jobs'][$v['id']]['info'][$v['id']]['engines'] = $v['motors'];
                  $new_arr[$key]['jobs'][$v['id']]['info'][$v['id']]['price'] = $v['price'];
                  $new_arr[$key]['jobs'][$v['id']]['info'][$v['id']]['parts'] = $v['parts'];
                  unset($new_arr[$key]['jobs'][$v['id']]['motors']);
                  unset($new_arr[$key]['jobs'][$v['id']]['parts']);
              }
            }
        }
        return $new_arr;
    }
    
    protected function finalArr($cats, $jobs)
    {
        if(!$cats || !$jobs){
            return false;
        }
        $new_arr = array();
        foreach($cats as $key => $value){
            foreach($jobs as $k => $v){
                if($v['parent'] == $value['id']){
                    $new_arr[$key]['id'] = $value['id'];
                    $new_arr[$key]['title'] = $value['title'];
                    $new_arr[$key]['alias'] = $value['alias'];
                    $new_arr[$key]['car'] = $value['car'];
                    $new_arr[$key]['jobs'][$k] = $v;
                    
                }
            }
        }
        return $new_arr;
    }
}
