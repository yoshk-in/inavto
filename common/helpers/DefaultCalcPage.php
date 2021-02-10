<?php
// @changed 8.02.2021
// @changed 9.02.2021
// @changed 10.02.2021
namespace common\helpers;

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use Yii;
use yii\widgets\MaskedInput;
use common\helpers\Format;

class DefaultCalcPage extends CalcPageStrategy
{
    public $main_page;
    public $model;
    public $form;
    public $yiiView;

    public function __construct()
    {       
        $this->rootPath = '';
        parent::__construct(...func_get_args());
    }

    

    // public function banners()
    // {
    //     if ($this->main_page->banners && !empty($this->main_page->banners))
    //         echo \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $this->main_page->banners, 'cache_time' => 60]);
    // }

    public function formBegin()
    {
        $this->form = ActiveForm::begin([
            'action' => Url::toRoute(['site/order']),
        ]);
    }

    public function formEnd()
    {
        ActiveForm::end();
    }

    public function modalWindow()
    {
        ob_start();
?>
        <div class="modal serviceModal <?= Yii::$app->session->hasFlash('show') ? Yii::$app->session->getFlash('show') : ''; ?>">
            <span class="close close-btn"></span>
            <div class="modal-header">
                <h3>Заявка на техническое обслуживание</h3>
            </div>
            <div class="modal-body text-center">
                <div class="btnGroup">
                    <!--<input type="text" name="email" value="" placeholder="Ваш e-mail" />-->
                    <?= $this->form->field($this->model, 'email', [
                        'inputOptions' => ['placeholder' => 'Ваш e-mail'],
                        'template' => "{input}",
                        'options' => [
                            'tag' => null
                        ],
                    ])->textInput() ?>
                    <?= $this->form->field($this->model, 'phone', [
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
const state3 = {
    'watch': ['#orders-phone', '#orders-email'],
};

state3.watch.forEach((el) => {
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

</script>


    <?php return ob_get_clean();
    }

    public function googleCaptchaScript()
    {
        ob_start();
    ?>
    <script>
    
    googleCaptcha.registerForm('button[name="sendServiceOrder"]', 'recaptchaResponse');
    </script>
        <script>
            // @change on new recaptcha
            // ('undefined' != typeof grecaptcha) && grecaptcha.ready(function() {
            //     grecaptcha.execute('6LdA1L4UAAAAAIyOJGnOLhyeBaSHBfnRbrSHUhVb', {
            //         action: 'contact'
            //     }).then(function(token) {
            //         var recaptchaResponse = document.getElementById('recaptchaResponse');
            //         recaptchaResponse.value = token;
            //     });
            // });
        </script>;
    <?php return ob_get_clean();
    }

    public function jsScripts()
    {
        return $this->googleCaptchaScript();
    }

    public function getAssetsRootPath()
    {
        return "";
    }

    public function content()
    {
        ob_start();
    ?>
        <section class="content">

            <div class="row">
                <div class="span9 rpadd">
                    <?php if (@$this->main_page) : ?>
                        <h1><?= $this->main_page->title; ?></h1>
                        <?= $this->main_page->body; ?>
                    <?php endif; ?>
                </div>
                <div class="span3">
                    <?php
                    if ($this->yiiView->beginCache('NewsWidget', ['duration' => 60])) {
                        echo  \frontend\widgets\NewsWidget::widget(['tpl' => 'index', 'cache_time' => 60]);
                        $this->yiiView->endCache();
                    }
                    ?>
                </div>
            </div>
        </section>
        <style>
            .map {
                height: 400px;
                width: 100%;
            }
        </style>
        <?= \frontend\widgets\MapWidget::widget(['tpl' => 'index', 'cache_time' => 60]) ?>
<?php
        return ob_get_clean();
    }
}
