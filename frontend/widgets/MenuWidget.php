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
use common\models\Pages;
use Yii;
/**
 * Description of MenuWidget
 *
 * @author Вадим
 */
class MenuWidget extends Widget{
    
   public $tpl;
   public $cache_time;
   public $menuHtml;
    
    public function init(){
        parent::init();
      //  $this->tpl = 'index';
        $this->tpl .= '.php';
    }

    public function run()
    {
        $services_cats = Yii::$app->cache->get('services_cats');
        if(!$services_cats){
            $services_cats = JobsCategories::find()->where(['in_menu' => '1', 'service' => 1])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('services_cats', $services_cats, $this->cache_time);
        }
        
        $repairs_cats = Yii::$app->cache->get('repairs_cats');
        if(!$repairs_cats){
            $repairs_cats = JobsCategories::find()->where(['in_menu' => '1'])->andWhere(['service' => 0])->orWhere(['is', 'service', null])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('repairs_cats', $repairs_cats, $this->cache_time);
        }
        
        $parts_cats = Yii::$app->cache->get('parts_cats');
        if(!$parts_cats){
            $parts_cats = PartsCategories::find()->where(['in_menu' => '1'])->indexBy('id')->orderBy(['id' => 'DESC'])->asArray()->all();
            Yii::$app->cache->set('parts_cats', $parts_cats, $this->cache_time);
        }
        
        $pages = Yii::$app->cache->get('pages_list');
        if(!$pages){
            $pages = Pages::find()->select(['id', 'title', 'alias', 'introtext', 'image'])->where(['menu' => 1])->all();
            Yii::$app->cache->set('pages_list', $pages, $this->cache_time);
        }
        $this->menuHtml = $this->getMenuHtml($this->getTree($services_cats), $this->getTree($repairs_cats), $this->getTree($parts_cats), $pages);
        
        return $this->menuHtml;
    }

    protected function getMenuHtml($service_cats = array(), $repair_cats = array(), $parts_cats = array(), $pages = array())
    {
        $str = '';
        $str .= $this->catToTemplate($service_cats, $repair_cats, $parts_cats, $pages);
        return $str;
    }

    protected function catToTemplate($service_cats, $repair_cats, $parts_cats, $pages)
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
