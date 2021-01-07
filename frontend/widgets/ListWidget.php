<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\PartsCategories;
use common\models\JobsCategories;
use Yii;
/**
 * Description of MenuWidget
 *
 * @author Вадим
 */
class ListWidget extends Widget{
    
   public $tpl;
   public $cache_time;
   public $flag = 'zapchasti';
   public $data;
   public $menuHtml;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';
    }

    public function run(){
        
       if($this->flag == 'zapchasti'){
           $this->data = Yii::$app->cache->get('parts_cats_list');
            if(!$this->data){
                $this->data = PartsCategories::find()->where(['is', 'parent', null])->indexBy('id')->asArray()->all();
                Yii::$app->cache->set('parts_cats_list', $this->data, $this->cache_time);
            }
       }
       
       if($this->flag == 'remont'){
           $this->data = Yii::$app->cache->get('remont_cats_list');
            if(!$this->data){
                $this->data = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['is', 'service', null])->indexBy('id')->asArray()->all();
                Yii::$app->cache->set('remont_cats_list', $this->data, $this->cache_time);
            }
       }
       
        if($this->flag == 'obsluzhivanie'){
           $this->data = Yii::$app->cache->get('obsluzhivanie_cats_list');
            if(!$this->data){
                $this->data = JobsCategories::find()->where(['is', 'parent', null])->andWhere(['service' => 1])->indexBy('id')->asArray()->all();
                Yii::$app->cache->set('obsluzhivanie_cats_list', $this->data, $this->cache_time);
            }
       }
       
       $this->menuHtml = $this->getMenuHtml($this->data, $this->flag);
       
       return $this->menuHtml;
    }

    protected function getMenuHtml($data, $flag){
        $str = '';
        $str .= $this->catToTemplate($data, $flag);
        return $str;
    }

    protected function catToTemplate($data, $flag){
        ob_start();
        include __DIR__ . '/list/' . $this->tpl;
        return ob_get_clean();
    }
}
