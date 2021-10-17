<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'eZd-FBcrYAuv8ZycMt5_YDr9go8sMUDC',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'cto' => 'site/cto',
                'site-optimization-seo' => 'site/site-optimization-seo',
                'programming-and-development' => 'site/programming-and-development',
                'testing' => 'site/testing',
                'technical-writer' => 'site/technical-writer',
                'project-management' => 'site/project-management',
                'analyst' => 'site/analyst',
                'dentist' => 'site/dentist',
                'pediatrician' => 'site/pediatrician',
                'copywriter' => 'site/copywriter',
                'accountant' => 'site/accountant',
                'lawyer' => 'site/lawyer',
                'courier' => 'site/courier',
                'security' => 'site/security',
                'trainer' => 'site/trainer',
                'waiter' => 'site/waiter',
                'psychologist' => 'site/psychologist',
                'biotechnologist' => 'site/biotechnologist',
                'roboticist' => 'site/roboticist',
                'marketer' => 'site/marketer',
                'designer' => 'site/designer',
                'geneticist' => 'site/geneticist',
                'information-security' => 'site/information-security',
                'teacher' => 'site/teacher',
                'data' => 'site/data',
                'driver' => 'site/driver',
                'translator' => 'site/translator',
                'cashier' => 'site/cashier',
                'cleaning-lady' => 'site/cleaning-lady',
                'profession' => 'table/profession',
                'skills' => 'table/skills',
                'analytics' => 'site/analytics'
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
