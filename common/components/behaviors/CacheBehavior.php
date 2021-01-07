<?php 

namespace common\components\behaviors;

use frontend\widgets\CalculatorWidget;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class CacheBehavior extends Behavior
{
    //id кэша - название в виде массива
    public $cache_id;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'deleteCache',
            ActiveRecord::EVENT_AFTER_UPDATE => 'deleteCache',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteCache',
        ];
    }
 
    public function deleteCache()
    {
        //Удаление массива кэшированных элементов (виджеты, модели...)
        foreach ($this->cache_id as $id){
        Yii::$app->cache->set($id,  \frontend\widgets\CalculatorWidget::widget(['tpl' => 'index', 'car_id' => 2 ]));
        }
        // var_dump($out); exit;
    }
}