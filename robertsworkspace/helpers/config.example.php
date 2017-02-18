<?php

$CONFIG = [
    'database' => [
        'name' => 'yourDB',
        'username' => 'yourUsername',
        'password' => 'yourPassword',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];