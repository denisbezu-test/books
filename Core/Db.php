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
            $dsn = 'mysql:host=' . Config::getDbHost() . ';dbname=' . Config::getDbName() . ';charset=utf8';
            if (!empty(Config::getDbPort())) {
                $dsn .= ';port=' . Config::getDbPort();
            }
            self::$db = new PDO($dsn, Config::getDbUser(), Config::getDbPassword());

            // Throw an Exception when an error occurs
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}