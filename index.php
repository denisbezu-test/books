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

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('init', ['controller' => 'Initializer', 'action' => 'index']);
$router->add('login', ['controller' => 'User', 'action' => 'login']);
$router->add('register', ['controller' => 'User', 'action' => 'register']);
$router->add('register/submit', ['controller' => 'User', 'action' => 'registerSubmit']);
$router->add('logout', ['controller' => 'User', 'action' => 'logout']);
$router->add('login/submit', ['controller' => 'User', 'action' => 'loginSubmit']);

$router->add('authors', ['controller' => 'Author', 'action' => 'list']);
$router->add('authors/create', ['controller' => 'Author', 'action' => 'create']);
$router->add('authors/edit', ['controller' => 'Author', 'action' => 'edit']);
$router->add('authors/delete', ['controller' => 'Author', 'action' => 'delete']);
$router->add('authors/create/submit', ['controller' => 'Author', 'action' => 'createSubmit']);
$router->add('authors/edit/submit', ['controller' => 'Author', 'action' => 'editSubmit']);



$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
