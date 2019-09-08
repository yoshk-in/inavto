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

    public function run(){
       
        /*$this->data = Yii::$app->cache->get('catalog');
        if(!$this->data){
            $this->data = Categories::find()->where(['parent_code' => ''])->indexBy('id')->orderBy(['sort' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('catalog', $this->data, $this->cache_time);
        }
        
       $this->menuHtml = $this->getMenuHtml($this->data);
       */
        $this->menuHtml = $this->getMenuHtml($this->data);
        return $this->menuHtml;
    }

    protected function getMenuHtml($data){
        $str = '';
       // foreach ($data as $brand) {
            $str .= $this->catToTemplate($brand);
     //   }
        return $str;
    }

    protected function catToTemplate($brand){
        ob_start();
        include __DIR__ . '/news/' . $this->tpl;
        return ob_get_clean();
    }
}
