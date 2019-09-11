<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Services;
use Yii;
/**
 * Description of MenuWidget
 *
 * @author Вадим
 */
class ContactsWidget extends Widget{
    
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
        $services = Services::find()->with(['contacts'])->all();
        $arr = array(0 => 'Нет', 1 => 'Мастер', 2 => 'Запчасти', 3 => 'Факс');
        $this->menuHtml = $this->getMenuHtml($services, $arr);
       
        return $this->menuHtml;
    }

    protected function getMenuHtml($services, $arr){
        $str = $this->catToTemplate($services, $arr);
        return $str;
    }

    protected function catToTemplate($services, $arr){
        ob_start();
        include __DIR__ . '/contacts/' . $this->tpl;
        return ob_get_clean();
    }
}
