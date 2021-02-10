<?php 
// @changed 8.02.2021
// @changed 9.02.2021
// @changed 10.02.2021
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use common\helpers\Format;
use frontend\models\Orders;
use frontend\widgets\MobileCalcWidget;
?>


<?php $page = @$main_page; $model = $model ?? new Orders(); $rootPath = ''; ?>

<?php  $form = ActiveForm::begin([ 'action' => Url::toRoute(['site/order'])]); ?>

<?php 
if ($this->beginCache('MobilceCalculatorWidget', ['duration' => 60, //'dependency' => [
    // 'class' => 'system.caching.dependencies.CDbCacheDependency',
    // 'sql' => 'SELECT MAX(modified) FROM jobs_rank']
])) {
    echo MobileCalcWidget::widget(['tpl' => 'index', 'car_id' => 2, 'cache_time' => 60]);
    $this->endCache();
}
?>
<?php //if ($this->beginCache('OrderPopup', ['duration' => 60])) : ?>
<div class="modal serviceModal <?= Yii::$app->session->hasFlash('show') ? Yii::$app->session->getFlash('show') : ''; ?>">
            <span class="close close-btn"></span>
            <div class="modal-header">
                <h3>Заявка на техническое обслуживание</h3>
            </div>
            <div class="modal-body text-center">
                <div class="btnGroup">
                    <!--<input type="text" name="email" value="" placeholder="Ваш e-mail" />-->
                    <?= $form->field($model, 'email', [
                        'inputOptions' => ['placeholder' => 'Ваш e-mail'],
                        'template' => "{input}",
                        'options' => [
                            'tag' => null
                        ],
                    ])->textInput() ?>
                    <?= $form->field($model, 'phone', [
                        'inputOptions' => ['placeholder' => '+7 ( ___ ) ___ - __ - __', 'type' => 'tel'],
                        'template' => "{input}",
                        'options' => [
                            'tag' => null
                        ],
                    ])->widget(MaskedInput::className(), ['mask' => Format::PHONE_MASK]); ?>
                    <input type="hidden" name="type" value="" />
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <button type="submit" name="sendServiceOrder" value="1" class="btn success">Отправить данные</button>
                </div>
                <div class="alert alert-info">
                    Данные по работам и запчастям будут моментально отправлены Вам на указанный e-mail.
                </div>
                <?php if (Yii::$app->session->hasFlash('success')) : ?>
                    <div class="alert alert-success">
                        <div><?php echo Yii::$app->session->getFlash('success'); ?></div>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('error')) : ?>
                    <div class="alert alert-error">
                        <div><?php echo Yii::$app->session->getFlash('error'); ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
const state4 = {
    'watch': ['#orders-phone', '#orders-email'],
};

state4.watch.forEach((el) => {
    let prevColor = $(el).css('border-color');
    $(el).on('focusout', (e) => {
        // console.log($(e.target).attr('aria-invalid'));
        
        setTimeout( () => {      
            console.log(el, $(el).attr('aria-invalid'));  
            if ($(e.target).attr('aria-invalid') === 'true') $(e.target).css('border-color', 'red');
        else $(e.target).css('border-color', prevColor);
        }, 300);
    });
})
<?php //endif ?>


<?php //if ($this->beginCache('ScriptsWidget', ['duration' => 60])) : ?>
</script>
        
        <script type="text/javascript" src=<?= $rootPath, "/js/avtoservice/avtoservice_mobile.js" ?>></script>
        <script type="text/javascript" src=<?= $rootPath, "/js/avtoservice/jquery-ui-sortable.min.js" ?>></script>
        <script type="text/javascript" src=<?= $rootPath, "/js/avtoservice/jquery-ui-touch.min.js" ?>></script>
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
// $this->endCache();
// endif;
$form->end();

if(isset($page) && $page->banners && !empty($page->banners)):
     echo \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $page->banners, 'cache_time' => 60]); 
endif
// 
?>
<script> // captcha

    googleCaptcha.registerForm('button[name="sendServiceOrder"]', 'recaptchaResponse');   
</script>

<div class="content">
    <h1><?=$main_page->title; ?></h1>
    <?=$main_page->body; ?>
</div>