<?php

$CONFIG = [
    'database' => [
        'name' => 'your_database',
        'username' => 'yourusername',
        'password' => 'yourpassword',
        'connection' => 'mysql:host=localhost',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];