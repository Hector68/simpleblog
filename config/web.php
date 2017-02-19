<?php
use yii\helpers\ArrayHelper;
use yii2mod\user\models\UserModel;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'layoutPath' => '@app/modules/simplebolg/views/layouts',
    'bootstrap' => ['log'],
    'defaultRoute' => '/simpleblog/site/index',
    'modules' => [

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '2GVdzYsS7AJTf59an-cuMoJ6yOt1_N22',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => UserModel::class,
            'loginUrl' => ['/simpleblog/user/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<module:\w+>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],

        'i18n' => [
            'translations' => [
                'yii2mod.user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/user/messages',
                ],
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/rbac/messages',
                ],
            ],

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
$common = include __DIR__ . '/common.php';
return ArrayHelper::merge(
    $common,
    $config
);
