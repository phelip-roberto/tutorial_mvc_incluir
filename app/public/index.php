<?php

require '../vendor/autoload.php'; //autoloader do composer

$router = new Slim\App();

require __DIR__ . '/../src/dependencies.php';
require __DIR__ . '/../src/routes.php';

$router->run();

//o index serve como um ponto de entrada (entry point)