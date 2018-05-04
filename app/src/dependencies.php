<?php

use TutorialMvc\Controller\ProductController;
use TutorialMvc\Model\Product;

$container = $router->getContainer();

$config = require __DIR__ . '/../config/config.php';
$container['config'] = $config;

$container['log'] = function($c){
    $config = $c->get('config')['log'];
    $log = new Monolog\Logger($config['name']);
    $log->pushProcessor(new Monolog\Processor\UidProcessor());
    $log->pushHandler(new Monolog\Handler\StreamHandler($config['path'], $config['level']));
    return $log;
};

$container[PDO::class] = function($c) {
    $config = $c->get('config')['database'];
    return new PDO(
        'mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset='. $config['charset'],
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
};

$container[Product::class] = function($c) {
    $pdo = $c->get(PDO::class);
    $log = $c->get('log');
    $log->info('Instânciando Product!');
    return new Product($pdo, $log);
};

$container[ProductController::class] = function($c) {
    $p = $c->get(Product::class);
    $log = $c->get('log');
    $log->info('Instânciando ProductController!');
    return new ProductController($p, $log);
};
