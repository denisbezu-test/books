<?php

/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';
//pour avoir les namespaces
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

$router->add('genres', ['controller' => 'Genre', 'action' => 'list']);
$router->add('genres/create', ['controller' => 'Genre', 'action' => 'create']);
$router->add('genres/edit', ['controller' => 'Genre', 'action' => 'edit']);
$router->add('genres/delete', ['controller' => 'Genre', 'action' => 'delete']);
$router->add('genres/create/submit', ['controller' => 'Genre', 'action' => 'createSubmit']);
$router->add('genres/edit/submit', ['controller' => 'Genre', 'action' => 'editSubmit']);

$router->add('publishers', ['controller' => 'Publisher', 'action' => 'list']);
$router->add('publishers/create', ['controller' => 'Publisher', 'action' => 'create']);
$router->add('publishers/edit', ['controller' => 'Publisher', 'action' => 'edit']);
$router->add('publishers/delete', ['controller' => 'Publisher', 'action' => 'delete']);
$router->add('publishers/create/submit', ['controller' => 'Publisher', 'action' => 'createSubmit']);
$router->add('publishers/edit/submit', ['controller' => 'Publisher', 'action' => 'editSubmit']);

$router->add('readers', ['controller' => 'Reader', 'action' => 'list']);
$router->add('readers/create', ['controller' => 'Reader', 'action' => 'create']);
$router->add('readers/edit', ['controller' => 'Reader', 'action' => 'edit']);
$router->add('readers/delete', ['controller' => 'Reader', 'action' => 'delete']);
$router->add('readers/create/submit', ['controller' => 'Reader', 'action' => 'createSubmit']);
$router->add('readers/edit/submit', ['controller' => 'Reader', 'action' => 'editSubmit']);

$router->add('books', ['controller' => 'Book', 'action' => 'list']);
$router->add('books/create', ['controller' => 'Book', 'action' => 'create']);
$router->add('books/edit', ['controller' => 'Book', 'action' => 'edit']);
$router->add('books/delete', ['controller' => 'Book', 'action' => 'delete']);
$router->add('books/create/submit', ['controller' => 'Book', 'action' => 'createSubmit']);
$router->add('books/edit/submit', ['controller' => 'Book', 'action' => 'editSubmit']);

$router->add('rents', ['controller' => 'Rent', 'action' => 'list']);
$router->add('rents/create', ['controller' => 'Rent', 'action' => 'create']);
$router->add('rents/edit', ['controller' => 'Rent', 'action' => 'edit']);
$router->add('rents/delete', ['controller' => 'Rent', 'action' => 'delete']);
$router->add('rents/return', ['controller' => 'Rent', 'action' => 'return']);
$router->add('rents/create/submit', ['controller' => 'Rent', 'action' => 'createSubmit']);
$router->add('rents/edit/submit', ['controller' => 'Rent', 'action' => 'editSubmit']);

$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
