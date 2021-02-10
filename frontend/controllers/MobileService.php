<?php
// @changed 8.02.2021
namespace frontend\controllers;

use common\models\Generations;
use common\models\JobsCategories;
use Yii;

trait MobileService
{
    public function loadServiceModels($page, $renderEngine = true)
    {
        $cars_and_keys = $this->fromCacheOr('cars_generations_engines', function () {
            $gens = Generations::find()->with(['car', 'engines'])->asArray()->indexBy('car_id')->all();

            $cars = array();
            $car_keys = array();
            array_map(function ($gen) use (&$cars, &$car_keys) {
                $car_key = $gen['car_id'];
                $car_keys[$car_key] = $car_key;
                if (!isset($cars[$car_key])) {
                    $cars[$car_key] = $gen['car'];
                    unset($gen['car']);
                }
                $cars[$car_key]['generations'][$gen['id']] = $gen;
            }, $gens);
            return ['cars' => $cars, 'keys' => $car_keys];
        });
        $parents = $this->fromCacheOr('parents_cats_jobs2', function () use ($cars_and_keys) {
            return JobsCategories::find()->select(['alias', 'car_id'])->where('service=1')->andWhere(['is', 'parent', null])
                        ->orderBy(['car_id' => $cars_and_keys['keys']])->asArray()->indexBy('car_id')->all();
        });
      
        return $this->render('mobile_index', [
            'page' => $page,
            'init_cars_to_js' => $cars_and_keys['cars'],
            'serviceAliases' => $parents,
            'render_engine' => $renderEngine
        ]);
    }


    protected function fromCacheOr($cacheId, $ifNoCacheSearch)
    {
        $search = Yii::$app->cache->get($cacheId);
        if (!$search) {
            // $parents = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['service' => 1])->all();
            $search = $ifNoCacheSearch();
            Yii::$app->cache->set($cacheId, $search, $this->cache_time);
        }
        return $search;
    }
}

