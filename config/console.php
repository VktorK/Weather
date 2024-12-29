<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//            ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport'=>'false',
//            'viewPath' => '@app/mail',
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.mail.ru', // Укажите ваш SMTP-сервер
//                'username' => '4you.19885@mail.ru', // Ваш логин
//                'password' => 'M0XatPL4qBc4vJrp6nZj', // Ваш пароль
//                'port' => 587, // Порт (обычно 587 для TLS или 465 для SSL)
//                'encryption' => 'tls',
//                'streamOptions' => [
//                    'ssl' => [
//                        'verify_peer' => false,
//                        'verify_peer_name' => false,
//                        'allow_self_signed' => true
//                    ]
//                ]
//            ],
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
