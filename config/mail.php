<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@app/views/',
    //'useFileTransport' => true, //Put the list in the local mail, e-mail can open the test

    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'mail.welsa.net',
        'username' => 'noanswer@cyborg.su',
        'password' => 'N234567a',
        'port' => '465',
        'encryption' => 'ssl',
    ]
];