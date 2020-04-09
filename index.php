<?php

/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

session_start();

/**
 * Routing
 */
$router = new Core\Router();

var_dump(\App\Config::getConnectionString());

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('init', ['controller' => 'Initializer', 'action' => 'index']);
$router->add('login', ['controller' => 'User', 'action' => 'login']);
$router->add('register', ['controller' => 'User', 'action' => 'register']);
$router->add('register/submit', ['controller' => 'User', 'action' => 'registerSubmit']);
$router->add('logout', ['controller' => 'User', 'action' => 'logout']);
$router->add('login/submit', ['controller' => 'User', 'action' => 'loginSubmit']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
