<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */
session_start();
/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['namespace' => 'Home','controller' => 'Index', 'action' => 'index']);
$router->add('admin/index/index', ['namespace' => 'Admin','controller' => 'Index', 'action' => 'index']);
$router->add('index/buildCaptcha', ['controller' => 'Index', 'action' => 'buildCaptcha']);
$router->add('index/test', ['controller' => 'Index', 'action' => 'test']);
//$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->dispatch($_SERVER['QUERY_STRING']);
