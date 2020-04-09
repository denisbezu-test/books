<?php

namespace App\Models;

use Core\Model;

class Author extends Model
{
    public static $table = 'users';

    public static $dbFields = ['name', 'lastname'];

    public $id;

    public $name;

    public $lastname;

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
     * @return Author
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