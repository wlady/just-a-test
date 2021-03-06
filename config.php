<?php

return [
    'session' => [
        'save_path' => '/tmp',
        'coockie_lifetime' => 3600,
    ],
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=test;charset=utf8',
        'user' => 'root',
        'password' => '',
    ],
    'listener' => [
        'address' => '127.0.0.1',
        'port' => 5000,
    ],
    'twig' => [
        'templates' => __DIR__ . '/resources/twig',
    ],
    'keys' => [
        'google_api_key' => 'AIzaSyBZ-0vIDNzaPta70oZmoI4zibWN3QXWE8I',
    ],
];
