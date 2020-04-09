<?php

namespace App\Models;

use Core\Db;
use Core\Model;
use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends Model
{
    public static $table = 'users';

    public static $dbFields = ['email', 'name', 'lastname', 'password'];

    public $id;

    public $email;

    public $name;

    public $lastname;

    public $password;

    //region Get-Set

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    //endregion

    public static function getUserByEmail($email)
    {
        $db = Db::getInstance();
        $query = 'SELECT * FROM ' . static::$table . ' WHERE email = :email';
        $stmt = $db->prepare($query);
        $stmt->execute(['email' => $email]);
        $userArray = $stmt->fetch();

        if ($userArray) {
            return new User($userArray['id']);
        }

        return null;
    }

    public static function createUser($email, $password, $name = '', $lastname = '')
    {
        if (!is_null(User::getUserByEmail($email))) {
            throw new \Exception('User already exist');
        }

        $user = new User();
        $user->setEmail($email);
        $user->setName($name);
        $user->setLastname($lastname);

        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $user->setPassword($hash);
        $user->id = $user->save();

        return $user;
    }

    public static function tryLogin($email, $password)
    {
        $user = self::getUserByEmail($email);
        if (is_null($user)) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    public static function getLoggedUser()
    {
        if (isset($_SESSION['login_user'])) {
            return self::getUserByEmail($_SESSION['login_user']);
        }

        return null;
    }
}
