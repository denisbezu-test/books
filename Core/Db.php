<?php


namespace Core;

use PDO;
use App\Config;

class Db
{

    protected static $db = null;

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    public static function getInstance()
    {
        if (self::$db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            self::$db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}