<?php


namespace App\Controllers;


use Core\Controller;
use Core\View;

class User extends Controller
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function loginAction($args = [])
    {
        View::renderTemplate('User/login.html.twig', $args);
    }

    /**
     * @param $args
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function registerAction($args = [])
    {
        View::renderTemplate('User/register.html.twig', $args);
    }

    public function registerSubmitAction()
    {
        $login = $this->getPost('email');
        $password = $this->getPost('password');
        $firstname = $this->getPost('firstname');
        $lastname = $this->getPost('lastname');

        if (empty($login)) {
            return $this->registerAction(['error' => 'Login cannot be empty']);
        }
        if (empty($password) || strlen($password) < 6) {
            return $this->registerAction(['error' => 'Password cannot be less than 6 symbols']);
        }
        if (empty($firstname)) {
            return $this->registerAction(['error' => 'Firstname cannot be empty']);
        }
        if (empty($lastname)) {
            return $this->registerAction(['error' => 'Lastname cannot be empty']);
        }

        if (!is_null(\App\Models\User::getUserByEmail($login))) {
            return $this->registerAction(['error' => 'User already exists']);
        }

        $user = \App\Models\User::createUser($login, $password, $firstname, $lastname);
        $_SESSION['login_user'] = $login;

        $this->redirect('/');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function loginSubmitAction()
    {
        $errorMessage = 'Email or password are not valid';
        $login = $this->getPost('email');
        $password = $this->getPost('password');

        if (empty($password) || empty($login)) {
            return $this->loginAction(['error' => $errorMessage]);
        }
        $user = \App\Models\User::tryLogin($login, $password);
        if (!$user) {
            return $this->loginAction(['error' => $errorMessage]);
        }

        $_SESSION['login_user'] = $login;

        $this->redirect('/');
    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/');
    }
}