<?php


namespace App;


use App\Models\User;
use Core\Db;

class DbInitializer
{
    public function initDb()
    {
        $this->createUsersTable();
    }

    private function createUsersTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS users
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                email VARCHAR(150) NOT NULL,
                name VARCHAR(50) NULL,
                lastname VARCHAR(100) NULL,
                password VARCHAR(150) NOT NULL,
                UNIQUE KEY(email) 
            );
        ';

        $userId = User::createUser('denys.bezu@gmail.com', 'kb230699');

        return Db::getInstance()->exec($query);
    }

}