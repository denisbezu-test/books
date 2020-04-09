<?php

namespace App\Models;

use Core\Model;

class Publisher extends Model
{
    public static $table = 'publishers';

    public static $dbFields = ['name', 'dimension'];

    public $id;

    public $name;

    public $dimension;

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

    /**
     * @return mixed
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @param mixed $dimension
     * @return Publisher
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    //endregion
}