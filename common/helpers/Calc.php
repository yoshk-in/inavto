<?php

namespace common\helpers;

use common\models\JobsRank;
use yii\helpers\ArrayHelper;

class Calc
{

    public static function findJobs($req)
    {
        $req['motorId'] = 1;
        $req['genId'] = 1;
        $req['range'] = 1;
        $engine_id = $req['motorId'];
        $generation_id = $req['genId'];
        $year_id = $req['range'];

        $categories_links = \yii\helpers\ArrayHelper::map(\common\models\JobcatsJobs::find()->where(['job_category_id' => \yii\helpers\ArrayHelper::map(\common\models\JobsCategories::find()->where(['service' => 1])->all(), 'id', 'id')])->all(), 'id', 'job_id');
        $engine_links = \yii\helpers\ArrayHelper::map(\common\models\EnginesJobs::find()->where(['engine_id' => $engine_id])->all(), 'id', 'job_id');
        $generations_links = \yii\helpers\ArrayHelper::map(\common\models\JobsGenerations::find()->where(['generation_id' => $generation_id])->all(), 'id', 'job_id');
        $years_links = \yii\helpers\ArrayHelper::map(\common\models\YearsJobs::find()->where(['year_id' => $year_id])->all(), 'id', 'job_id');
        $jobs_arr = array_intersect($engine_links, $generations_links, $years_links, $categories_links);
        $jobs = \common\models\Jobs::find()->where(['id' => $jobs_arr,])
            ->with([
                'parts' => function ($query) {
                    return $query->with('brand');
                }
            ])
            ->asArray()
            ->all();

        $jobs = self::sortByRank($jobs_arr, $jobs);
        return self::getJobs($jobs, $req['requestId']);
    }
    

    public static function sortByRank($arr = [], $jobs = [])
    {        
        $jobs_rank = ArrayHelper::map(JobsRank::find()->where(['job_id' => $arr])->asArray()->all(),'job_id', 'ranking');
        
        $result = [];
        foreach ($jobs as $key => $job) {
            if (!isset( $jobs_rank[$job['id']] )) continue;
            $rank = $jobs_rank[$job['id']];     
            $job['rank'] = $rank;
            $result[$rank][] = $job; 
            unset($jobs[$key]);
        }   
        ksort($result);
        return array_merge(array_merge(...$result), $jobs);
    }

    public static function getJobs($arr = [], $req)
    {
        $responce = array();
        $responce['requestId'] = $req;
        $responce['mandatoryWorksPrice'] = 0;
        $responce['mandatoryPartsMin'] = 0;
        $responce['recommendedWorksPrice'] = 0;
        $responce['recommendedPartsMin'] = 0;
        $k1 = 0;
        $k2 = 0;
        foreach ($arr as $key => $value) {
            if (@$value['recomended']) {
                $responce['works']['recommended'][$k1] = self::getJob($value);
                if (@$responce['works']['recommended'][$k1]['price']) {
                    $responce['recommendedWorksPrice'] += $responce['works']['recommended'][$k1]['price'];
                }
                if (@$responce['works']['recommended'][$k1]['minPartsPrice']) {
                    $responce['recommendedPartsMin'] += $responce['works']['recommended'][$k1]['minPartsPrice'];
                }
                $k1++;
            } else {
                $responce['works']['mandatory'][$k2] = self::getJob($value);
                if (@$responce['works']['mandatory'][$k2]['price']) {
                    $responce['mandatoryWorksPrice'] += $responce['works']['mandatory'][$k2]['price'];
                }
                if (@$responce['works']['mandatory'][$k2]['minPartsPrice']) {
                    $responce['mandatoryPartsMin'] += $responce['works']['mandatory'][$k2]['minPartsPrice'];
                }
                $k2++;
            }
        }
        $responce['totalPrice'] = $responce['mandatoryWorksPrice'] + $responce['mandatoryPartsMin'] + $responce['recommendedWorksPrice'] + $responce['recommendedPartsMin'];
        return $responce;
    }

    public static function getJob($job = null)
    {
        $new_job = array();
        $new_job['id_work'] = $job['id'];
        $new_job['name'] = $job['title'];
        $new_job['type'] = 'service';
        $new_job['price'] = $job['price'];
        $new_job['minPartsPrice'] = 0;
        $new_job['maxPartsPrice'] = 0;
        $new_job['sets'] = array();
        if ($job['parts'] && !empty($job['parts'])) {
            $original_count_price = 0;
            $analog_count_price = 0;
            $flag = 0;
            $key1 = 0;
            $key2 = 0;
            $prices = array();
            $original_prices = array();
            $analog_prices = array();
            foreach ($job['parts'] as $key => $value) {
                if ($value['original']) {
                    $original_count_price += $value['price'];
                    $new_job['sets'][0]['id_set'] = 'original_' . $flag;
                    $new_job['sets'][0]['setName'] = 'Оригинал';
                    $new_job['sets'][0]['price'] = $original_count_price;
                    $prices[0] = $original_count_price;
                    $new_job['sets'][0]['parts'][$key1]['count'] = 1;
                    $new_job['sets'][0]['parts'][$key1]['price'] = $value['price'];
                    $original_prices[] = $value['price'];
                    $new_job['sets'][0]['parts'][$key1]['id_part'] = $value['id'];
                    $new_job['sets'][0]['parts'][$key1]['partName'] = $value['title'];
                    $new_job['sets'][0]['parts'][$key1]['articul'] = $value['code'];
                    $new_job['sets'][0]['parts'][$key1]['original'] = $value['original'];
                    $new_job['sets'][0]['parts'][$key1]['vendor'] = $value['brand']['title'];
                    $new_job['sets'][0]['parts'][$key1]['totalPrice'] = $value['price'];
                    $key1++;
                } else {
                    $analog_count_price += $value['price'];
                    $new_job['sets'][1]['id_set'] = 'analog_' . $flag;
                    $new_job['sets'][1]['setName'] = 'Аналог';
                    $new_job['sets'][1]['price'] = $analog_count_price;
                    $prices[1] = $analog_count_price;
                    $new_job['sets'][1]['parts'][$key2]['count'] = 1;
                    $new_job['sets'][1]['parts'][$key2]['price'] = $value['price'];
                    $analog_prices[] = $value['price'];
                    $new_job['sets'][1]['parts'][$key2]['id_part'] = $value['id'];
                    $new_job['sets'][1]['parts'][$key2]['partName'] = $value['title'];
                    $new_job['sets'][1]['parts'][$key2]['articul'] = $value['code'];
                    $new_job['sets'][1]['parts'][$key2]['original'] = $value['original'];
                    $new_job['sets'][1]['parts'][$key2]['vendor'] = $value['brand']['title'];
                    $new_job['sets'][1]['parts'][$key2]['totalPrice'] = $value['price'];
                    $key2++;
                }
                $flag++;
            }
            $new_job['sets'] = array_values($new_job['sets']);
            $new_job['minPartsPrice'] = min($prices);
            $new_job['maxPartsPrice'] = max($prices);
        }
        return $new_job;
    }

    public static function getCars()
    {
        return \common\models\Cars::find()->all();
    }
}
