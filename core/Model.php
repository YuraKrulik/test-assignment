<?php


namespace app\core;


use PDO;

abstract class Model
{
    protected $table;

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}