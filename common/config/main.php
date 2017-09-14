<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [  
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'GMT+3',
            'dateFormat' => 'php:d M Y',
            'datetimeFormat' => 'php:d M Y H:i:s',
            'timeFormat' => 'H:i:s',
        ],
        'emailService' => [
            'class' => 'common\components\EmailService',
        ],
    ],  
];