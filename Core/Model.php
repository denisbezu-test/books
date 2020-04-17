<?php

namespace Core;

use App\Models\Author;
use PDO;
use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    public static $table = '';

    public static $dbFields = [];

    protected $id;

    public function __construct($id = null)
    {
        if (!is_null($id)) {
            $this->initModelFormArray($this->getModelById($id));
        }
    }

    protected function initModelFormArray($data) //initialisation d'objets
    {
        if (!empty($data)) {
            foreach ($data as $property => $value) {
                $this->{$property} = $value;
            }
        }

        return $this;
    }

    /**
     * @param $id
     * @return array
     */
    protected function getModelById($id)
    {
        $db = Db::getInstance();
        $query = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Get all models as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = Db::getInstance();
        $stmt = $db->query('SELECT * FROM ' . static::$table);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if (empty($this->id)) {
            return $this->add();
        }

        return $this->update();
    }

    public function add()
    {
        $query = 'INSERT INTO ' . static::$table . '(' . implode(', ', static::$dbFields) . ') VALUES ';
        $query .= '(' . $this->getFieldsInsert() . ');';

        if (Db::getInstance()->exec($query)) {
            return Db::getInstance()->lastInsertId();
        }

        return false;
    }

    public function update()
    {
        $query = 'UPDATE ' . static::$table;
        $query .= ' SET ' . $this->getFieldsUpdate();
        $query .= ' WHERE id = :id';

        $stmt = Db::getInstance()->prepare($query);

        return $stmt->execute(['id' => $this->id]);
    }

    private function getFieldsUpdate()
    {
        $fields = '';
        foreach (static::$dbFields as $index => $dbField) {
            $fields .= $dbField . '= \'' . $this->{$dbField} . '\'';
            if (($index + 1) != count(static::$dbFields)) {
                $fields .= ', ';
            }
        }

        return $fields;
    }

    private function getFieldsInsert()
    {
        $fields = '';
        foreach (static::$dbFields as $index => $dbField) {
            $fields .= '\'' . $this->{$dbField} . '\'';
            if (($index + 1) != count(static::$dbFields)) {
                $fields .= ', ';
            }
        }

        return $fields;
    }

    public function delete()
    {
        $db = Db::getInstance();
        $query = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
        $stmt = $db->prepare($query);

        return $stmt->execute(['id' => $this->id]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Model
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
