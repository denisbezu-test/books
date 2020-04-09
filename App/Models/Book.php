<?php


namespace App\Models;


use Core\Model;

class Book extends Model
{
    public static $table = 'books';

    public static $dbFields = ['name', 'id_author', 'id_genre', 'id_publisher', 'year', 'pages', 'quantity'];

    public $id;

    public $name;

    public $id_author;

    public $id_genre;

    public $id_publisher;

    public $year;

    public $pages;

    public $quantity;

    //region Get-Set

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Book
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * @param mixed $id_author
     * @return Book
     */
    public function setIdAuthor($id_author)
    {
        $this->id_author = $id_author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdGenre()
    {
        return $this->id_genre;
    }

    /**
     * @param mixed $id_genre
     * @return Book
     */
    public function setIdGenre($id_genre)
    {
        $this->id_genre = $id_genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPublisher()
    {
        return $this->id_publisher;
    }

    /**
     * @param mixed $id_publisher
     * @return Book
     */
    public function setIdPublisher($id_publisher)
    {
        $this->id_publisher = $id_publisher;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return Book
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    //endregion
}