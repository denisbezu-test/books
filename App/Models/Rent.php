<?php

namespace App\Models;

use Core\Model;

class Rent extends Model
{
    public static $table = 'rents';

    public static $dbFields = ['id_book', 'id_reader', 'date_rent', 'is_returned'];

    public $id_book;

    public $id_reader;

    public $date_rent;

    public $is_returned;

    //region Get-Set

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
    public function getIsReturned()
    {
        return $this->is_returned;
    }

    /**
     * @param mixed $is_returned
     */
    public function setIsReturned($is_returned)
    {
        $this->is_returned = $is_returned;
    }

    //endregion

    public static function getDisplayList()
    {
        $rents = self::getAll();
        foreach ($rents as &$rent) {
            $rent['book'] = new Book($rent['id_book']);
            $rent['reader'] = new Reader($rent['id_reader']);
        }

        return $rents;
    }
}