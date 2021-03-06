<?php

namespace Core;

use App\Models\User;

/**
 * Base controller
 *
 * PHP version 7.0
 */
abstract class Controller
{

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $args);
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }



    protected function getRequestByKey($key)
    {
        if (!empty($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }

        return null;
    }

    protected function getPost($key)
    {
        if (!empty($_POST[$key])) {
            return $_POST[$key];
        }

        return null;
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        die;
    }

    protected function redirectHomeIfNotLogged()
    {
        if (is_null(User::getLoggedUser())) {
            $this->redirect('/');
        }
    }
}
