<?php

namespace App\Models;

use Core\Model;

class Rent extends Model
{
    public static $table = 'rents';

    public static $dbFields = ['id_book', 'id_reader', 'date_rent', 'date_return'];

    public $id;

    public $id_book;

    public $id_reader;

    public $date_rent;

    public $date_return;

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
     * @return Rent
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdBook()
    {
        return $this->id_book;
    }

    /**
     * @param mixed $id_book
     * @return Rent
     */
    public function setIdBook($id_book)
    {
        $this->id_book = $id_book;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdReader()
    {
        return $this->id_reader;
    }

    /**
     * @param mixed $id_reader
     * @return Rent
     */
    public function setIdReader($id_reader)
    {
        $this->id_reader = $id_reader;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateRent()
    {
        return $this->date_rent;
    }

    /**
     * @param mixed $date_rent
     * @return Rent
     */
    public function setDateRent($date_rent)
    {
        $this->date_rent = $date_rent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateReturn()
    {
        return $this->date_return;
    }

    /**
     * @param mixed $date_return
     * @return Rent
     */
    public function setDateReturn($date_return)
    {
        $this->date_return = $date_return;
        return $this;
    }

    //endregion
}