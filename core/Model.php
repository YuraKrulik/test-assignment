<?php


namespace app\core;


use PDO;

/**
 * Class Model
 * @package app\core
 */
abstract class Model
{
    protected string $table;

    /**
     * Returns everything from table
     * @return array
     */
    public function getAll():array
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function get(array $values):array
    {
        $sql = "SELECT ".implode(", ", $values)." FROM $this->table";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * Creates new record
     * @param array $vals - array of values for new row e.g ['col1'=>'val1', 'col2'=>'val2']
     * @return bool
     */
    public function create(array $vals):bool {
        try {
            $questionMarks = '?';
            for ($i = 0; $i<count($vals)-1; $i++) { //todo:remove this crutch
                $questionMarks .= ', ?';
            }
            $sql = "INSERT INTO $this->table (".implode(', ', array_keys($vals)).") VALUES ($questionMarks)";
            $stmt= Database::$pdo->prepare($sql);
            $stmt->execute(array_values($vals));
            return true;
        }
        catch (\Exception $e) {
            var_dump($e);
        }
    }
}