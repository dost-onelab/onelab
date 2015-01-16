<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            
            'dsn' => 'mysql:host=localhost;dbname=onelabDB',
            'username' => 'onelabdb',
            'password' => 'D057-0n3l4bDB',
            'charset' => 'utf8',
            
            /*
			'dsn' => 'mysql:host=10.9.4.224;dbname=onelabDB',
            'username' => 'onelabdb',
            'password' => 'D057-0n3l4bDB',
            'charset' => 'utf8',
            */
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
