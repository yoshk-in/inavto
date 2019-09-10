<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'zapchasti/' => 'zapchasti/index',
                'zapchasti/<alias:[\w_-]+>' => 'zapchasti/category',
                'zapchasti/<alias:[\w_-]+>?s=<slug:[\w_-]+>' => 'zapchasti/subcategory',
                'remont/' => 'remont/index',
                'remont/<alias:[\w_-]+>' => 'remont/category',
                'remont/<alias:[\w_-]+>?s=<slug:[\w_-]+>' => 'remont/subcategory',
                'obsluzhivanie/' => 'obsluzhivanie/index',
                'obsluzhivanie/<alias:[\w_-]+>' => 'obsluzhivanie/category',
                'obsluzhivanie/<alias:[\w_-]+>?s=<slug:[\w_-]+>' => 'obsluzhivanie/subcategory',
                'site/calculator' => 'site/calculator',
                'news/' => 'news/index',
                '<alias:[\w_-]+>' => 'site/page',
            ],
        ],
    ],
    'params' => $params,
];
