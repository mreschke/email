<?php

return [

    // From address as a single address, or in this format: From Name <from@example.com>
	'from' => 'From Name <from@example.com>',

	// Supported drivers: smtp, mailgun
	'driver' => 'smtp',

	'mailgun' => [
		'domain' => 'mailgun.example.com',
		'secret' => 'key-123456789'
	],

    'smtp' => [
        'server' => 'smtp.gmail.com',
        'port' => 465, // Common: 25, 465, 587
        'username' => 'example@gmail.com',
        'password' => 'passwordhere',
        'ssl' => true
    ]

];
