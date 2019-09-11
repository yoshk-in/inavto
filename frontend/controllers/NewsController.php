<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use common\models\News;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

/**
 * Description of NewsController
 *
 * @author Vadim
 */
class NewsController extends SiteController{
     
    public function actionIndex()
    {
        $query = News::find()->where(['publish' => 1])->orderBy(['created' => SORT_DESC]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $news = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
        return $this->render('index', ['news' => $news, 'pages' => $pages]);
    }
    
    public function actionPage($alias)
    {
        $model = Yii::$app->cache->get('news_'.$alias);
        if(!$model){
            $model = News::find()->where(['alias' => $alias])->one();
            Yii::$app->cache->set('news_'.$alias, $model, $this->cache_time);
        }
       
        return $this->render('page', ['model' => $model]);
    }
}
