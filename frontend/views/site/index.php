<?php

use common\helpers\{DefaultCalcPage, CalcPreview, CalcPageStrategy};
use \frontend\models\Orders;
use frontend\widgets\CalculatorWidget;


$cacl_page = isset($is_backend_preview) ? CalcPreview::class : DefaultCalcPage::class;

/** @var CalcPageStrategy $cacl_page */
$cacl_page = $cacl_page::init();
$cacl_page->model = $model ?? new Orders;
$cacl_page->cars = $cars;
$cacl_page->main_page = $main_page ?? null;
$cacl_page->yiiView = $this;

$cacl_page->formBegin();

if ($this->beginCache('CalculatorWidget', ['duration' => 60, //'dependency' => [
    // 'class' => 'system.caching.dependencies.CDbCacheDependency',
    // 'sql' => 'SELECT MAX(modified) FROM jobs_rank']
])) {
    echo CalculatorWidget::widget(['tpl' => 'index', 'car_id' => 2, 'cache_time' => 60]);
    $this->endCache();
}

echo $cacl_page->modalWindow();
$cacl_page->formEnd();
$cacl_page->banners();

if ($this->beginCache('ScriptsWidget', ['duration' => 60])) :
    echo $cacl_page->jsScripts($this), $cacl_page->calcScripts();
    $this->endCache();
endif;
echo $cacl_page->content();
