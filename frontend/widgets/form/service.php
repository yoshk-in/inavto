<?php
// @changed 8.02.2021
// @changed 9.02.2021
// @changed 10.02.2021
use common\helpers\Format;
use common\models\Messages;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<div class="modal repairModal <?=Yii::$app->session->hasFlash('show'.$flag) ? Yii::$app->session->getFlash('show'.$flag) : ''; ?>">
	<span class="close close-btn"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></span>
	<div class="modal-header">
		<h3>Запись на сервис</h3>
	</div>
	<div class="modal-body text-center">
            <?php if(!Yii::$app->session->hasFlash('success2') ): ?>
            <?php
                if(!isset($message)) $message = new \common\models\ExtendedMessages;
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
                                   'inputOptions'=>['placeholder' => 'e-mail', 'type' => 'email'],
                                   'template'=>"{input}",
                                ])->textInput() ?>
			<?= $form->field($message, 'avto', [
                                   'inputOptions'=>['placeholder' => 'Ваш автомобиль'],
                                   'template'=>"{input}",
                                ]); ?>
			<?= $form->field($message, 'message', [
                                   'inputOptions'=>['placeholder' => 'дополнительная информация'],
                                   'template'=>"{input}",
                                ])->textarea(['rows' => 3]); ?>
                         <input type="hidden" name="recaptcha_response" id="recaptchaResponse3">
			<button type="submit" name="sendExtendedMessageAction" value="1" class="btn success">Записаться на сервис</button>
                  <?php ActiveForm::end(); ?>
                        <?php endif;?>
                        <?php if( Yii::$app->session->hasFlash('success2') ): ?>
                            <div class="alert alert-success">
                                <div><?php echo Yii::$app->session->getFlash('success2'); ?></div>
                            </div>
                        <?php endif;?>
                        <?php if( Yii::$app->session->hasFlash('error2') ): ?>
                            <div class="alert alert-error">
                                <div><?php echo Yii::$app->session->getFlash('error2'); ?></div>
                            </div>
                        <?php endif;?>
                        
</div>
</div>
<script>
const state2 = {
    'watch': ['#extendedmessages-phone', '#extendedmessages-email'],
};

state2.watch.forEach((el) => {
    let prevColor = $(el).css('border-color');
    $(el).parent().on('focusout', (e) => {
        
        setTimeout( () => {        
        if ($(e.target).parent().hasClass('has-error')) $(e.target).css('border-color', 'red');
        else $(e.target).css('border-color', prevColor);
        }, 300);
    });
})

</script>
<script>

    googleCaptcha.registerForm('button[name="sendExtendedMessageAction"]', 'recaptchaResponse3');
</script>
<script>
        // @change on new recaptcha
        // grecaptcha.ready(function () {
        //     grecaptcha.execute('6LdA1L4UAAAAAIyOJGnOLhyeBaSHBfnRbrSHUhVb', { action: 'contact' }).then(function (token) {
        //         var recaptchaResponse = document.getElementById('recaptchaResponse3');
        //         recaptchaResponse.value = token;
        //     });
        // });
    </script>
<script type="text/javascript">

	function closeAllModals() {
		$('.backdrop').toggleClass('show',false);
		$('.modal').toggleClass('show',false);
	}

	function showRepairOrder() {
		$('.modal.repairModal').toggleClass('show',true);
		$('.backdrop').toggleClass('show',true);
		$('.modal.repairModal').find('input[name="city"]').val('m'+'a'+'rocco');
		setTimeout(function(){ $('.modal.repairModal input[name="phone"]').focus() }, 100);
	}

	$(document).ready(function(){
		
		$('.repairButton').click(showRepairOrder);

		$('.backdrop').click(closeAllModals);
		$('.modal .close-btn').click(closeAllModals);

	});
</script>