<?php


$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$product = require __DIR__ . '/product.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
//        'weather' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=127.0.0.1;dbname=weather;port=3306', // DSN для первой базы данных
//            'username' => 'root', // Имя пользователя
//            'password' => 'Zghjuhfvbcn011', // Пароль
//            'charset' => 'utf8mb4',
//        ],
//        'Product' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=127.0.0.1;dbname=Product;port=3306', // DSN для второй базы данных
//            'username' => 'root', // Имя пользователя
//            'password' => 'Zghjuhfvbcn011', // Пароль
//            'charset' => 'utf8mb4',
//        ],
//        'mailer' => [
//            'class' => \yii\symfonymailer\Mailer::class,
//            'transport' => [
//                'scheme' => 'stmps',
//                'host' => 'smtp.mail.ru',
//                'username' => '4you.19885@mail.ru',
//                'password' => 'M0XatPL4qBc4vJrp6nZj',
//                'port' => 465,
//                'dsn' => 'native://default',
//            ],
//            'viewPath' => '@app/mail',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure transport
//            // for the mailer to send real emails.
//            'useFileTransport' => false,
//        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'some secret',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => $db,
        'product' => $product,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'telega' => [
            'class' => \TelegramBot\Api\BotApi::class,
            'token' => '7822712623:AAH32zSizy5HzPB-eIuRIYg-P_dbmNTpYKU',
        ]
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

return $config;
