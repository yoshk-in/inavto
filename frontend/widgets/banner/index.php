<?php
use yii\widgets\ActiveForm;
?>
<section class="topBanner">
	<!--<div class="slide s1">
		<a href="/news/skidka-10-na-vsjo" target="_blank">
			<strong>Новогодняя акция: ждём Вас на бесплатный осмотр Вашего автомобиля</strong>
			<em>акция действует во всех сервис-центрах до конца года</em>
		</a>
	</div>-->
        <?php if($banners && !empty($banners)): ?>
        <?php foreach($banners as $key => $value): ?>
	<div class="slide s<?=$key+1; ?>">
            <span style="background-image: url('/upload/banners/prev/thumb_<?=$value->img?>');"></span>
		<a href="<?=$value->link; ?>" target="_blank">
			<strong><?=$value->slogan_one?></strong>
                        <?php if($value->slogan_two && !empty($value->slogan_two)): ?>
			<em><?=$value->slogan_two; ?></em>
                        <?php endif; ?>
                        <?php if(!Yii::$app->user->isGuest): ?>
                        <i class="update-link" id="update-link_<?=$value->id; ?>">Редактировать ссылку</i>
                        <?php endif; ?>
		</a>
	</div>
        <?php if(!Yii::$app->user->isGuest): ?>
        <div class="modal partsModal <?=Yii::$app->session->hasFlash('show_'.$value->id) ? Yii::$app->session->getFlash('show_'.$value->id) : ''; ?>" id="banner-link_<?=$value->id; ?>">
            <span class="close close-btn"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></span>
            <div class="modal-header">
                    <h3>Редактировать ссылку</h3>
            </div>
            <div class="modal-body text-center">
    <?php
                    $form = ActiveForm::begin([
                        'action'=>\yii\helpers\Url::to(['site/banner', 'id' => $value->id]),
                    ]); 
                ?>
                            <?= $form->field($value, 'link', [
                                       'inputOptions'=>['placeholder' => 'Ссылка'],
                                       'template'=>"{input}",
                              ]); ?>
                               <?=$form->field($value, 'id', ['template' => "{input}"])->hiddenInput(['value' => $value->id]) ?>

                            <button type="submit" name="sendPartsOrder" value="1" class="btn success">Сохранить</button>
                      <?php ActiveForm::end(); ?>
                            <?php if( Yii::$app->session->hasFlash('success_'.$value->id) ): ?>
                                <div class="alert alert-success">
                                    <div><?php echo Yii::$app->session->getFlash('success_'.$value->id); ?></div>
                                </div>
                            <?php endif;?>
                            <?php if( Yii::$app->session->hasFlash('error_'.$value->id) ): ?>
                                <div class="alert alert-error">
                                    <div><?php echo Yii::$app->session->getFlash('error_'.$value->id); ?></div>
                                </div>
                            <?php endif;?>
    </div>
    </div>
    <script>
        function closeAllModals<?=$value->id; ?>() {
                    $('.backdrop').toggleClass('show',false);
                    $('#banner-link_<?=$value->id; ?>').toggleClass('show',false);
            }

            function showPartsOrder<?=$value->id; ?>() {
                    $('#banner-link_<?=$value->id; ?>').toggleClass('show',true);
                    $('.backdrop').toggleClass('show',true);
                    return false;
            }

            $(document).ready(function(){

                    $('#update-link_<?=$value->id; ?>').click(showPartsOrder<?=$value->id; ?>);

                    $('.backdrop').click(closeAllModals<?=$value->id; ?>);
                    $('#banner-link_<?=$value->id; ?> .close-btn').click(closeAllModals<?=$value->id; ?>);

            });
    </script>
    <?php if(Yii::$app->session->hasFlash('show_'.$value->id)): ?>
    <div class="backdrop show"></div>
    <?php endif; ?>
    <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
</section>