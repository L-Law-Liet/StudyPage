<?php
return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 465),
    'from' => [
        'address' => env('MAIL_FROM','info.studypage@gmail.com'),
        'name' => env('MAIL_NAME','StudyPage'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
    'username' => env('MAIL_USERNAME','info.studypage@gmail.com'),
    'password' => env('MAIL_PASSWORD','JCnthjbl19561960'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];