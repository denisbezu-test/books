<?php

namespace App\Models;

use Core\Model;

class Author extends Model
{
    public static $table = 'authors';

    public static $dbFields = ['name', 'lastname'];

    public $name;

    public $lastname;

    //region Get-Set

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return Author
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    //endregion
}