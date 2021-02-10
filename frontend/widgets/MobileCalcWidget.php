<?php
// @changed 8.02.2021
namespace frontend\widgets;

use yii\base\Widget;

class MobileCalcWidget extends Widget
{
    public $tpl;
    public $cache_time;
    public $data;
    public $menuHtml;
    public $car_id = 2;
     
     public function init(){
         parent::init();
       //  $this->tpl = 'index';
         $this->tpl = 'mobile.php';
     }
 
     public function run()
     {
         $cars = \common\models\Cars::find()->all();
         $curent_car = \common\models\Cars::findOne($this->car_id);
        
         /*$this->data = Yii::$app->cache->get('catalog');
         if(!$this->data){
             $this->data = Categories::find()->where(['parent_code' => ''])->indexBy('id')->orderBy(['sort' => 'DESC'])->asArray()->all();
             Yii::$app->cache->set('catalog', $this->data, $this->cache_time);
         }
         
        $this->menuHtml = $this->getMenuHtml($this->data);
        */
         $this->menuHtml = $this->getMenuHtml($cars, $curent_car);
         return $this->menuHtml;
     }
 
     protected function getMenuHtml($cars, $curent_car){
         $str = '';
        // foreach ($data as $brand) {
             $str .= $this->catToTemplate($cars, $curent_car);
      //   }
         return $str;
     }
 
     protected function catToTemplate($cars, $curent_car){
         ob_start();
         include __DIR__ . '/calculator/' . $this->tpl;
         return ob_get_clean();
     }

}

