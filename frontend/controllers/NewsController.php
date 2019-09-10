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
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 14]);
        $news = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
        return $this->render('index', ['news' => $news, 'pages' => $pages]);
    }
    
}
