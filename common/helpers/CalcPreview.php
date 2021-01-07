<?php

namespace common\helpers;

use Yii;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\CalcPreviewAsset;
use common\helpers\CalcPageStrategy;

class CalcPreview extends CalcPageStrategy
{
    public $deleteConflictScript = 'yii\web\JqueryAsset';
    public static $isPreview = false;


    public function __construct()
    {
        $this->rootPath = self::$front;
        self::$isPreview = true;
        parent::__construct(...func_get_args());
    }

    public function calcPreviewFix()
    {
        $print = vsprintf("
        
        <script type='text/javascript' src='%s/js/lib/jquery-1.8.3.min.js'></script>
        <script type='text/javascript' src='%s/js/core3.js'></script>
        <script type='text/javascript' src='%s/js/zoomImage.js'></script>        
        <link type='text/css' rel='Stylesheet' media='screen' href='%s/css/common.css'/>
        <script type='text/javascript' src='%s/js/lib/jquery-ui.min.js'></script>
        <script type='text/javascript'>
            var PATH = '%s/';            
               
        </script>
        ", array_fill(0, 6, $this->getAssetsRootPath()));
        return $print;
    }



    public function jsScripts()
    {
        $print = vsprintf("
        <script type='text/javascript' src='%s/js/lib/jquery-1.8.3.min.js'></script>
        <script type='text/javascript' src='%s/js/lib/jquery-ui.min.js'></script> 
        <script type='text/javascript'>
            var PATH = '%s/';
        </script>    
        <link type='text/css' rel='Stylesheet' media='screen' href='%s/css/common.css'/>
        ", array_fill(0, 5, self::$front));
        return $print;
    }

    public function skipYiiJquery()
    {
        $from = $this->yiiView->assetBundles;
        isset($from[$this->deleteConflictScript]) and $from[$this->deleteConflictScript]->js = [];
        ob_start(); ?>
        <script>
            jQuery.prototype.alert = function() {
                $('#w1-success .close').click(function() {
                    $('#w1-success').removeClass('in').addClass('out');
                });
            }
        </script>
    <?php ob_end_flush();
        // var_dump($this->yiiView->assetManager); exit;
    }

    public function formBegin()
    {
        $this->yiiView->title = "Превью калькулятора";
        $this->form = ActiveForm::begin([
            'action' => Url::toRoute(['calc-preview/save']),
        ]);
    }

    public function formEnd()
    {
        ActiveForm::end();
    }

    public function getAssetsRootPath()
    {
        return self::$front;
    }

    public function banners()
    {
        return '';
    }

    public function content()
    {

        return '';
    }

    public function modalWindow()
    {
        ob_start();
    ?>
        <div class="modal serviceModal <?= Yii::$app->session->hasFlash('show') ? Yii::$app->session->getFlash('show') : ''; ?>" style="max-height: 120px;">
            <span class="close close-btn"></span>
            <div class="modal-header">
                <h3>Сохранить изменения?</h3>
            </div>
            <div class="modal-body text-center">
                <div class="btnGroup">
                    <!--<input type="text" name="email" value="" placeholder="Ваш e-mail" />-->
                    <?php // echo $this->form->field($this->model, 'email', [
                    // 'inputOptions' => ['placeholder' => 'Ваш e-mail'],
                    // 'template' => "{input}",
                    // 'options' => [
                    //     'tag' => null
                    // ],
                    // ])->textInput() 
                    ?>
                    <?php //echo $this->form->field($this->model, 'phone', [
                    // 'inputOptions' => ['placeholder' => '+7 ( ___ ) ___ - __ - __'],
                    // 'template' => "{input}",
                    // 'options' => [
                    //     'tag' => null
                    // ],
                    // ]); 
                    ?>
                    <input type="hidden" name="type" value="" />
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <button type="submit" name="sendServiceOrder" value="1" class="btn success" style="margin: auto;width: 50%">Да</button>
                    <button type="submit" name="cancel" value="1" class="btn cancelSend" style="margin: auto;width: 50%">Нет</button>
                </div>
                <div class="alert alert-info" style="display: none;">
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

<?php return ob_get_flush();
    }
}
