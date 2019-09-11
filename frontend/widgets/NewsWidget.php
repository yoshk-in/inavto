<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\News;
use Yii;
/**
 * Description of MenuWidget
 *
 * @author Вадим
 */
class NewsWidget extends Widget{
    
   public $tpl;
   public $cache_time;
   public $data;
   public $menuHtml;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';
    }

    public function run()
    {
        $last_news = Yii::$app->cache->get('last_news');
        if(!$last_news){
            $last_news = News::find()->where(['publish' => '1'])->asArray()->orderBy(['created' => SORT_DESC])->limit(4)->all();
            Yii::$app->cache->set('last_news', $last_news, $this->cache_time);
        }
        
        $this->menuHtml = $this->getMenuHtml($last_news);
       
        return $this->menuHtml;
    }

    protected function getMenuHtml($data){
        $str = $this->catToTemplate($data);
        return $str;
    }

    protected function catToTemplate($data){
        ob_start();
        include __DIR__ . '/news/' . $this->tpl;
        return ob_get_clean();
    }
}
