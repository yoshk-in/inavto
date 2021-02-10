<?php
// @changed 8.02.2021
namespace common\helpers;

abstract class CalcPageStrategy
{
    protected static $init;
    const ADMIN_PROD = 'https://adm.inavtospb.ru';
    const ADMIN_DEV = 'http://localhost:8080';
    public static $admin = self::ADMIN_PROD;
    const FRONT_DEV = 'http://localhost:8081';
    const FRONT_PROD = 'https://inavtospb.ru';
    public static $front = self::FRONT_PROD;
    public $rootPath;
    public $cars;
    public $yiiView;
    public $form;
    public $model;
    public $main_page;

    protected function __construct()
    {
       
    }



    public static function init()
    {
        if (self::$init === null) return self::$init = new static(...func_get_args());
        return self::$init;
    }


    public function skipYiiJquery()
    {
        // var_dump($this->yiiView->assetManager); exit;
    }


    
    public function banners()
    {
        if ($this->main_page->banners && !empty($this->main_page->banners))
            echo \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $this->main_page->banners, 'cache_time' => 60]);
    }

    abstract function formBegin();
    abstract function formEnd();
    abstract function modalWindow();
    abstract function jsScripts();
    abstract function getAssetsRootPath();
    abstract function content();

    public function calcScripts()
    {
        ob_start(); 
        $cars = $this->cars;
?>
        <script type="text/javascript" src=<?= $this->rootPath, "/js/avtoservice/avtoservice5.js" ?>></script>
        <script type="text/javascript" src=<?= $this->rootPath, "/js/avtoservice/jquery-ui-sortable.min.js" ?>></script>
        <script type="text/javascript" src=<?= $this->rootPath, "/js/avtoservice/jquery-ui-touch.min.js" ?>></script>
        <script type="text/javascript"> 
            function manualSortingCalcOption(lists, options) {

                let order = {
                    totalLength: 0,
                    lastLi: null,
                    animateEl: function(el, text) {
                        el.hide('fast').text(text).show('slow')
                    },
                    animateTxt: function(el, text, delay) {
                        el.fadeOut('fast', () => el.fadeIn('slow', () => el.text(text)));
                    },
                    reorder: function() {
                        let list = this.lastLi;
                        let order = this;
                        return function(event, ui) {
                            let li = $(list.name);
                            let delay = 0;
                            for (i = 0; i < li.length; ++i) {
                                let el = $(li[i]);
                                txt = i + list.offset + 1;
                                if (ui.item.index() === i + 1) {
                                    order.animateTxt(el, txt, delay);
                                    continue;
                                }
                                order.animateEl(el, txt, delay);
                                delay += order.delay;
                            }
                        }
                    },
                    addList: function(list) {
                        let li = {
                            name: list,
                            offset: order.totalLength,
                        }
                        this.lastLi = li;
                        this.totalLength = $(li.name).length;
                    }
                }
                
                for (list of lists) {
                    order.addList(list + ' ' + options.number);
                    $(list).sortable({
                        items: options.listItem,
                        axis: options.axis ?? 'y',
                        opacity: 0.5,
                        sort: function(event, ui) {
                            ui.item.css('cursor', 'move');
                            order.stopId = ui.item.index();
                        },
                        stop: order.reorder()
                    });

                    $(list).children(options.listItemSelector).hover(function() {
                        $(this)
                            .css('cursor', 'pointer')
                            .attr('title', 'Кликнув и удерживая левой кнопкой мыши элементы списка,' +
                                ' вы можете сортировать порядок выполнения работ');
                    })
                }
            };
            var srv = new avtoservice('serviceCalc', 'serviceWorks', 'sendToData', manualSortingCalcOption);

            var cars = {
                <?php
                $flag = 0;
                $len_cars = count($cars);
                foreach ($cars as $key => $value) : ?> 'c<?= $value->id ?>': {
                        'model': '<?= str_replace('/', '', $value->title) ?>',
                        'id_car': '<?= $value->id ?>',
                        'generations': {
                            <?php $i = 0;
                            $len_gen = count($value->generations);
                            foreach ($value->generations as $k => $v) : ?> 'g<?= $v->id; ?>': {
                                    'id_gen': '<?= $v->id; ?>',
                                    'generation': '<?= $v->alter_title; ?>',
                                    'motors': [
                                        <?php $item = 0;
                                        $len = count($v->engines);
                                        foreach ($v->engines as $e_k => $e_v) : ?> {
                                                'id_motor': '<?= $e_v->id; ?>',
                                                'motorName': '<?= $e_v->title; ?>',
                                                'power': '0'
                                            }
                                            <?= $item == $len - 1 ? '' : ',' ?>
                                            <?php $item++; ?>
                                        <?php endforeach; ?>
                                    ],
                                    'year_begin': '<?= $v->start; ?>',
                                    'year_end': '<?= $v->end; ?>'
                                }
                                <?= $i == $len_gen - 1 ? '' : ',' ?>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        }
                    }
                    <?= $flag == $len_cars - 1 ? '' : ',' ?>
                    <?php $flag++; ?>
                <?php endforeach; ?>
                
            };            
        </script>
<?php 
        return ob_get_clean();
    }
}
