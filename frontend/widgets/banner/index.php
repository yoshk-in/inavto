<?php
// @changed 8.02.2021
use yii\widgets\ActiveForm;

?>

<section class="topBanner">
	<!--<div class="slide s1">
		<a href="/news/skidka-10-na-vsjo" target="_blank">
			<strong>Новогодняя акция: ждём Вас на бесплатный осмотр Вашего автомобиля</strong>
			<em>акция действует во всех сервис-центрах до конца года</em>
		</a>
	</div>-->
        <?php if ($banners && !empty($banners)): ?>
                <script type="text/javascript">
                const bannerState = {
                        'banners': null,
                        'period': 10000,
                        'current': 0,
                        'next': null,
                        init() {
                                this.banners = $('.topBanner').children('.slide-banner');
                                this.next = this.banners[this.current];
                                this.toggle();
                                setInterval(() => this.nextSlide(), this.period);
                        },
                        toggle() {
                                $(this.next).toggleClass('bannerDisable');
                                $(this.next).toggleClass('slide');
                        },
                        nextSlide() {
                                console.log('next slide');
                                this.toggle();
                                this.next = this.banners[++this.current];
                                if (this.next === undefined) this.next = this.banners[this.current = 0];
                                this.toggle();
                        }
                };
                $(document).ready(() => {
                    bannerState.init();
                });
                       
                </script>
        
                
                                <?php// var_dump($banners); exit; ?>
        <?php foreach ($banners as $key => $value): ?>
        <?php $key = $key + 1; ?>
        <div class="slide-banner bannerDisable s<?= $key ?>" >  
        <!-- <div class="slide">   -->
        
                <span style="<?= $styleBackgroundImage($value->img) ?>" ></span>
		<a href="<?=$value->link; ?>" target="_blank" >
			<strong><?=$value->slogan_one?></strong>
                        <?php if ($value->slogan_two && !empty($value->slogan_two)): ?>
			<em><?=$value->slogan_two; ?></em>
                        <?php endif; ?>
                        <?php if (!Yii::$app->user->isGuest): ?>
                        <i class="update-link" id="update-link_<?=$value->id; ?>">Редактировать ссылку</i>
                        <?php endif; ?>
		</a>
	</div>

        <?php if (!Yii::$app->user->isGuest): ?>

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
                            <?php if (Yii::$app->session->hasFlash('success_'.$value->id)): ?>
                                <div class="alert alert-success">
                                    <div><?php echo Yii::$app->session->getFlash('success_'.$value->id); ?></div>
                                </div>
                            <?php endif;?>
                            <?php if (Yii::$app->session->hasFlash('error_'.$value->id)): ?>
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
    <?php if (Yii::$app->session->hasFlash('show_'.$value->id)): ?>
    <div class="backdrop show"></div>
    <?php endif; ?>
    <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
</section>
