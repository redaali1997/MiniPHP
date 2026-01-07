<?php
namespace App;

use PDO;
use ReflectionClass;

abstract class Model
{
    protected $table;
    protected $attributes = [];
    protected static $db;

    public function __construct()
    {
        if (!$this->table) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName()) . 's';
        }
    }

    public static function getDb()
    {
        if (!self::$db) {
            self::$db = App::container()->get(Database::class)->connect();
        }

        return self::$db;
    }

    public static function all()
    {
        $tableName = (new static)->table;
        $query = "SELECT * FROM {$tableName}";
        $stmt = self::getDb()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function find($id)
    {
        $tableName = (new static)->table;
        $query = "SELECT * FROM {$tableName} WHERE id = :id";
        $stmt = self::getDb()->prepare($query);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_CLASS, static::class);
    }

    public function save() {
        $attributes = $this->attributes;
        $columns = implode(', ', array_keys($attributes));
        $placeholders = ':' . implode(', :', array_keys($attributes));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        $stmt = self::getDb()->prepare($query);

        return $stmt->execute($attributes);
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }
}