<?php

namespace App\Models;

use Core\Model;

class Genre extends Model
{
    public static $table = 'genres';

    public static $dbFields = ['name'];

    public $id;

    public $name;

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
     * @return Genre
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
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    //endregion
}