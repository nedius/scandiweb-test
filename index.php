<?php

require 'src/autoload.php';

$router = new Nedius\Core\Router();

$router->add('GET', '/', 'Nedius\Controllers\HomeController::index');
$router->add('GET', '/products/show', 'Nedius\Controllers\HomeController::show');
// $router->add('GET', '/products/add', 'Nedius\Controllers\HomeController::add');
// $router->add('POST', '/products/add', 'Nedius\Controllers\HomeController::add');
// $router->add('POST', '/products/delete', 'Nedius\Controllers\HomeController::delete');

$router->go($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);