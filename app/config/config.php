<?php

$config = [
    'database' => [
        'driver' => 'pdo_mysql',
        'charset' => 'utf8',
    ],

    'log' => [
        'name' => 'mvc_tutorial',
        'path' =>  __DIR__ . '/../logs/tutorial.log',
        'level' => \Monolog\Logger::DEBUG,
    ],
];

return array_merge_recursive(
    $config,
    require_once __DIR__ . '/config.local.php'
);