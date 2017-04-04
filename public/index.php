<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */
if (!session_id()) session_start();

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
$router->add('index/list', ['namespace' => 'Home','controller' => 'Index', 'action' => 'list']);
$router->add('User/test', ['controller' => 'User', 'action' => 'test']);
$router->add('user/buildCaptcha', ['controller' => 'Index', 'action' => 'buildCaptcha']);
$router->add('User/mail', ['controller' => 'User', 'action' => 'mail']);
$router->add('User/login', ['controller' => 'User', 'action' => 'login']);
$router->add('User/dologin', ['controller' => 'User', 'action' => 'dologin']);
$router->add('User/logout', ['controller' => 'User', 'action' => 'logout']);
$router->add('User/register', ['controller' => 'User', 'action' => 'register']);

//$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->dispatch($_SERVER['QUERY_STRING']);
