<?php

require '../vendor/autoload.php'; //autoloader do composer
$router = new Slim\App();
require '../src/routes.php';

$router->run();

//o index serve como um ponto de entrada (entry point)