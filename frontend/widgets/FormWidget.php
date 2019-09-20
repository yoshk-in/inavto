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
class FormWidget extends Widget{
    
   public $tpl;
   public $menuHtml;
   public $flag;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';
    }

    public function run()
    {
        $this->menuHtml = $this->getMenuHtml($this->flag);
        return $this->menuHtml;
    }

    protected function getMenuHtml($flag){
        $str = $this->catToTemplate($flag);
        return $str;
    }

    protected function catToTemplate($flag){
        ob_start();
        include __DIR__ . '/form/' . $this->tpl;
        return ob_get_clean();
    }
}
