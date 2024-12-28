<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport'=>'false',
//            'viewPath' => '@app/mail',
//            'transport' => [
//                    'class' => 'Swift_SmtpTransport',
//                    'host' => '', // Укажите ваш SMTP-сервер
//                    'username' => 'viktorkorochanskiy@rambler.ru', // Ваш логин
//                    'password' => 'Goozman011', // Ваш пароль
//                    'port' => 587, // Порт (обычно 587 для TLS или 465 для SSL)
//                    'encryption' => 'tls',
//                    'streamOptions' => [
//                        'ssl' => [
//                            'verify_peer' => false,
//                            'verify_peer_name' => false,
//                            'allow_self_signed' => true
//                    ]
//                ]
//            ],
//        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'transport' => [
                'scheme' => 'smtps',
                'host' => 'smtp.mail.ru',
                'username' => '4you.19885@mail.ru',
                'password' => 'M0XatPL4qBc4vJrp6nZj',
                'port' => 465,
                'dsn' => 'native://default',
            ],
            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],

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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
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

return $config;
