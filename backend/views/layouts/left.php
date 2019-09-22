<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel 
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php // $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
         /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Автомобили', 'icon' => 'circle-o', 'url' => ['/cars'],],
                    ['label' => 'Работы', 'icon' => 'circle-o', 'url' => ['/jobs_categories'],],
                    ['label' => 'Запчасти', 'icon' => 'circle-o', 'url' => ['/parts_categories'],],
                    ['label' => 'Заказы', 'icon' => 'circle-o', 'url' => ['/orders'],],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Справочник',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Года эксплуатации', 'icon' => 'circle-o', 'url' => ['/years'],],
                            ['label' => 'Бренды', 'icon' => 'circle-o', 'url' => ['/brands'],],
                            ['label' => 'Сервисные центры', 'icon' => 'circle-o', 'url' => ['/services'],],
                            ['label' => 'Контакты', 'icon' => 'circle-o', 'url' => ['/contacts'],],
                        ],
                    ],
                    ['label' => 'Страницы', 'icon' => 'circle-o', 'url' => ['/pages'],],
                    ['label' => 'Новости', 'icon' => 'circle-o', 'url' => ['/news'],],
                    ['label' => 'Сообщения', 'icon' => 'circle-o', 'url' => ['/messages'],],
                ],
            ]
        ) ?>

    </section>

</aside>
