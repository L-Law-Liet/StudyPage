<?php
return [
    'driver' => env('MAIL_Mailer', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
    'port' => env('MAIL_PORT', 2525),
    'from' => [
        'address' => env('MAIL_FROM','info.studypage@gmail.com'),
        'name' => env('MAIL_NAME','StudyPage'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME','e2141b4830aa26'),
    'password' => env('MAIL_PASSWORD','6808e4497a3d28'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];
