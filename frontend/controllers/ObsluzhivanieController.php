<?php

namespace frontend\controllers;

use Yii;
use common\models\JobsCategories;
use common\models\Jobs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ObsluzhivanieController implements the CRUD actions for JobsCategories model.
 */
class ObsluzhivanieController extends SiteController
{
    public function actionIndex()
    {
        $links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()
                ->where([
                    'job_category_id' => \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['service' => 1])->all(), 'id', 'id')
                ])->all(), 'id', 'job_id');
        $jobs = $this->addToCache('obsluzhivanie_jobs', Jobs::find()->where(['id' => $links])->with([
            'cats' => function($query){
                return $query->where('service = 1');
            },
            'motors' => function($query){
                return $query->select('id, title, generation_id')->orderBy('title')->with('generation');
            },
            'parts' => function($query){
                return $query->select('id, price');
            }
        ])->asArray()->all());
        
        $remont_parents = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['service' => 1])->with(['car'])->asArray()->all();
        
        $final_arr = $this->finalArr($remont_parents, $this->getTree($jobs));
    //    print_r($final_arr);
    //    exit();
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
        $model = JobsCategories::find()->where(['alias' => $alias, 'service' => 1])->one();
       
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
        
        $f_motor = '';
        $gen_motors = array();
        if (@$_COOKIE['fModel'] && @$_COOKIE['fGen'] && @$_COOKIE['fMotor']) {
            $f_motor = $_COOKIE['fMotor'];
            $gen_motors = array('id' => \yii\helpers\ArrayHelper::map(\common\models\EnginesJobs::find()
                ->where([
                    'engine_id' => $f_motor
                ])->all(), 'id', 'job_id'));
        }
        
        $links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()
                ->where([
                    'job_category_id' => \yii\helpers\ArrayHelper::map(JobsCategories::find()->where(['parent' => $model->id])->andWhere(['service' => 1])->all(), 'id', 'id')
                ])->all(), 'id', 'job_id');
        
        $jobs = $this->addToCache('obsluzhivanie_jobs_'.$alias.'_'.$f_gen.$f_motor, Jobs::find()->where(['id' => $links])->andWhere($gen_links)->andWhere($gen_motors)->with([
            'cats' => function($query){
                return $query->where('service = 1');
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
        ])->asArray()->all());
        
        $final_arr = $this->getTree($jobs);
        
        $parents = $this->addToCache('parents_cats_jobs2', JobsCategories::find()->where(['is', 'parent', null])->andWhere(['service' => 1])->all());
     //   print_r($this->getTree($jobs));
     //   exit();
        
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
    
    protected function addToCache($cache_name, $data = null)
    {
        $cache_data = Yii::$app->cache->get($cache_name);
        if(!$cache_data){
            $cache_data = $data;
            Yii::$app->cache->set($cache_name, $cache_data, $this->cache_time);
        }
        return $cache_data;
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
