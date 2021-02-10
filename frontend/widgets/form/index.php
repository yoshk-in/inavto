<?php
// @changed 8.02.2021
// @changed 9.02.2021
use common\helpers\Format;
use common\models\Messages;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<div class="modal partsModal <?=Yii::$app->session->hasFlash('show'.$flag) ? Yii::$app->session->getFlash('show'.$flag) : ''; ?>">
	<span class="close close-btn"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></span>
	<div class="modal-header">
		<h3>Заказ запчастей</h3>
	</div>
	<div class="modal-body text-center">
            <?php if (!Yii::$app->session->hasFlash('success1')): ?>
<?php
                if (!isset($message)) {
                    $message = new \common\models\Messages;
                }
                $form = ActiveForm::begin([
                    'action'=>\yii\helpers\Url::to(['site/message']),
                ]);
            ?>
                            <?= $form->field($message, 'phone', [
                                   'inputOptions'=> ['placeholder' => '+7 ( ___ ) ___ - __ - __', 'type' => 'tel'],
                                   'template'=>"{input}",
                                ])->widget(MaskedInput::className(), ['mask' => Messages::PHONE_MASK]); ?>
			<div>
                            <?=$form->field($message, 'flag', ['template' => "{input}"])->hiddenInput(['value' => $flag]) ?>
                            
                                <?= $form->field($message, 'service_id', [
                                    'options'=>['tag' => null],
                                   'template'=>"{input}"
                                ])->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Services::find()->all(), 'id', 'title'), ['prompt' => 'Выберите  сервисную станцию']) ?>
				
			</div>
			<?= $form->field($message, 'email', [
                                   'inputOptions'=>['placeholder' => 'e-mail'],
                                   'template'=>"{input}",
                                ])->textInput() ?>
			<?= $form->field($message, 'avto', [
                                   'inputOptions'=>['placeholder' => 'Ваш автомобиль'],
                                   'template'=>"{input}",
                                ]); ?>
			<?= $form->field($message, 'message', [
                                   'inputOptions'=>['placeholder' => 'номера запчастей и дополнительная информация'],
                                   'template'=>"{input}",
                                ])->textarea(['rows' => 3]); ?>
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse2">
			<button type="submit" name="sendMessageAction" value="1" class="btn success">Отправить заявку</button>
                  <?php ActiveForm::end(); ?>
                        <?php endif;?>
                        <?php if (Yii::$app->session->hasFlash('success1')): ?>
                            <div class="alert alert-success">
                                <div><?php echo Yii::$app->session->getFlash('success1'); ?></div>
                            </div>
                        <?php endif;?>
                        <?php if (Yii::$app->session->hasFlash('error1')): ?>
                            <div class="alert alert-error">
                                <div><?php echo Yii::$app->session->getFlash('error1'); ?></div>
                            </div>
                        <?php endif;?>
</div>
</div>
<script>
const state = {
    'watch': ['#messages-phone', '#messages-email'],
};

state.watch.forEach((el) => {
    let prevColor = $(el).css('border-color');
    $(el).on('focusout', (e) => {
        
        setTimeout( () => {        
        if ($(e.target).parent().hasClass('has-error')) $(e.target).css('border-color', 'red');
        else $(e.target).css('border-color', prevColor);
        }, 300);
    });
})

</script>
<script>
        const googleCaptcha = function (jqueryElm) {
            grecaptcha.ready(function () {
            grecaptcha.execute('6LdA1L4UAAAAAIyOJGnOLhyeBaSHBfnRbrSHUhVb', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse2');
                recaptchaResponse.value = token;                 
            });
        });
    };
        
    if ('undefined'!= typeof grecaptcha) {
        $('button[name="sendMessageAction"]').click(() => googleCaptcha($(this)));
    }
    
</script>
<script type="text/javascript">

	function closeAllModals() {
		$('.backdrop').toggleClass('show',false);
		$('.modal').toggleClass('show',false);
	}

	function showPartsOrder() {
		$('.modal.partsModal').toggleClass('show',true);
		$('.modal.partsModal').find('input[name="city"]').val('m'+'a'+'rocco');
		$('.backdrop').toggleClass('show',true);
		setTimeout(function(){ $('.modal.partsModal input[name="phone"]').focus() }, 100);
	}

	$(document).ready(function(){
		
		$('.parts').click(showPartsOrder);

		$('.backdrop').click(closeAllModals);
		$('.modal .close-btn').click(closeAllModals);

	});
</script>