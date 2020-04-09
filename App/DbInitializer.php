<?php


namespace App;


use App\Models\User;
use Core\Db;

class DbInitializer
{
    public function initDb()
    {
        $this->createAuthorTable();
        $this->createGenreTable();
        $this->createPublisherTable();
        $this->createBookTable();
        $this->createReaderTable();
        $this->createRentTable();
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

    private function createAuthorTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS authors
            (
              id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
              name VARCHAR(150) NOT NULL,
              lastname VARCHAR(150) NOT NULL
            );
        ';

        return Db::getInstance()->exec($query);
    }

    private function createGenreTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS genres
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(150) NOT NULL UNIQUE
            )
        ';

        return Db::getInstance()->exec($query);
    }

    private function createPublisherTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS publishers
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(150) NOT NULL UNIQUE,
                dimension VARCHAR(50) NULL
            )
        ';

        return Db::getInstance()->exec($query);
    }

    private function createBookTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS books
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(150) NOT NULL UNIQUE,
                id_author INT NULL DEFAULT NULL,
                id_genre INT NULL DEFAULT NULL,
                id_publisher INT NULL DEFAULT NULL,
                year INT NOT NULL,
                pages INT NOT NULL,
                quantity INT NOT NULL DEFAULT 0,
                FOREIGN KEY (id_author) REFERENCES authors(id),
                FOREIGN KEY (id_publisher) REFERENCES publishers(id),
                FOREIGN KEY (id_genre) REFERENCES genres(id) 
            )
        ';

        return Db::getInstance()->exec($query);
    }

    private function createReaderTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS readers
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(150) NOT NULL,
                lastname VARCHAR(150) NOT NULL,
                birthdate date NOT NULL,
                phone VARCHAR(15) NOT NULL  
            );
        ';

        return Db::getInstance()->exec($query);
    }

    public function createRentTable()
    {
        $query = '
            CREATE TABLE IF NOT EXISTS rents
            (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                id_book INT NULL DEFAULT NULL,
                id_reader INT NULL DEFAULT NULL,
                date_rent date NOT NULL,
                date_return date NULL DEFAULT NULL,
                FOREIGN KEY (id_book) REFERENCES books(id),
                FOREIGN KEY (id_reader) REFERENCES readers(id)
            );
        ';

        return Db::getInstance()->exec($query);
    }
}