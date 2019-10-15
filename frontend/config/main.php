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
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true,
                'path' =>'/',
                'domain' => '.volvo.loc',
             ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-backend',
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
                'contacts/' => 'contacts/index',
                'news/' => 'news/index',
                'news/<alias:[\w_-]+>' => 'news/page',
                '<alias:[\w_-]+>' => 'site/page',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.spaceweb.ru',
                'username' => 'newsite@inavtospb.ru',
                'password' => 'Aa6861827',
                'port' => '2525',
                'encryption' => 'tls',
            ]
        ],
    ],
    'params' => $params,
];
