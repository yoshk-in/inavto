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
class MenuWidget extends Widget{
    
   public $tpl;
   public $cache_time;
   public $services_cats;
   public $repairs_cats;
   public $parts_cats;
   public $menuHtml;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';
    }

    public function run()
    {
        $this->services_cats = Yii::$app->cache->get('services_cats');
        if(!$this->services_cats){
            $this->services_cats = JobsCategories::find()->where(['in_menu' => '1', 'service' => 1])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('services_cats', $this->services_cats, $this->cache_time);
        }
        
        $this->repairs_cats = Yii::$app->cache->get('repairs_cats');
        if(!$this->repairs_cats){
            $this->repairs_cats = JobsCategories::find()->where(['in_menu' => '1'])->andWhere(['service' => 0])->orWhere(['is', 'service', null])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('repairs_cats', $this->repairs_cats, $this->cache_time);
        }
        
        $this->parts_cats = Yii::$app->cache->get('parts_cats');
        if(!$this->parts_cats){
            $this->parts_cats = PartsCategories::find()->where(['in_menu' => '1'])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('parts_cats', $this->parts_cats, $this->cache_time);
        }
        
        $this->menuHtml = $this->getMenuHtml($this->getTree($this->services_cats), $this->getTree($this->repairs_cats), $this->getTree($this->parts_cats));
        
        return $this->menuHtml;
    }

    protected function getMenuHtml($service_cats = array(), $repair_cats = array(), $parts_cats = array())
    {
        $str = '';
        $str .= $this->catToTemplate($service_cats, $repair_cats, $parts_cats);
        return $str;
    }

    protected function catToTemplate($service_cats, $repair_cats, $parts_cats)
    {
        ob_start();
        include __DIR__ . '/menu/' . $this->tpl;
        return ob_get_clean();
    }
    
    protected function getTree($arr = array())
    {
        $new_arr = array();
        foreach($arr as $key => &$value){
            if(!$value['parent']){
                $new_arr[$key] = &$value;
            }else{
                $arr[$value['parent']]['childs'][$value['id']] = &$value;
            }
        }
        return $new_arr;
    }
}
