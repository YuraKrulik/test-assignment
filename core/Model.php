<?php


namespace app\core;


use PDO;

/**
 * Class Model
 * @package app\core
 */
abstract class Model
{
    protected $table;

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}