<?php

namespace App\Models;

use Core\Model;

class Genre extends Model
{
    public static $table = 'genres';

    public static $dbFields = ['name'];

    public $name;

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
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    //endregion
}