<?php

require 'src/autoload.php';

$router = new Nedius\Core\Router();

$router->add('GET', '/', 'Nedius\Controllers\HomeController::home');
$router->add('GET', '/add-product', 'Nedius\Controllers\HomeController::add');
$router->add('GET', '/products', 'Nedius\Controllers\ProductController::get');
$router->add('POST', '/products/add', 'Nedius\Controllers\ProductController::add');
$router->add('POST', '/products/delete', 'Nedius\Controllers\ProductController::delete');

$router->go($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);