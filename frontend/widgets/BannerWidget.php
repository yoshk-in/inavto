<?php
// @changed 8.02.2021
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
class BannerWidget extends Widget{
    
   public $tpl;
   public $cache_time;
   public $data;
   public $menuHtml;
   public $banners;
   /** on mobile no background image */
   public $styleFnc;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';

        if (Yii::$app->deviceDetect->isMobileLayout()) $this->styleFnc = function () { return '';};

        else $this->styleFnc = function ($value) {
            return 'background-image: url(\'/upload/banners/prev/thumb_' . $value . '\');';
        };
    }

    public function run(){
       
        /*$this->data = Yii::$app->cache->get('catalog');
        if(!$this->data){
            $this->data = Categories::find()->where(['parent_code' => ''])->indexBy('id')->orderBy(['sort' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('catalog', $this->data, $this->cache_time);
        }
        
       $this->menuHtml = $this->getMenuHtml($this->data);
       */
      
        $this->menuHtml = $this->getMenuHtml($this->banners);
        return $this->menuHtml;
    }

    protected function getMenuHtml($banners){
        $str = '';
        // var_dump($banners, Yii::$app->deviceDetect->isMobile()); exit;
       // foreach ($data as $brand) {
            $str .= $this->catToTemplate($banners);
     //   }
        return $str;
    }

    protected function catToTemplate($banners){
        $styleBackgroundImage = $this->styleFnc;
        ob_start();
        include __DIR__ . '/banner/' . $this->tpl;
        return ob_get_clean();
    }
}
