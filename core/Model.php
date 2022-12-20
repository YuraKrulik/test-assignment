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

    /**
     * returns rows with specified columns
     * @param array $values - array with column names
     * @return array
     */
    public function get(array $values):array
    {
        $sql = "SELECT ".implode(", ", $values)." FROM $this->table";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * Returns row by id
     * @param int $id - id of searched row
     * @return array
     */
    public function getById(int $id):array
    {
        $sql = "SELECT *
                FROM $this->table
                WHERE id = $id;";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    /**
     * Creates new record
     * @param array $vals - array of values for new row e.g ['col1'=>'val1', 'col2'=>'val2']
     * @return bool
     */
    public function create(array $vals):bool
    {
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
            return false;
        }
    }

    /**
     * @param int $id - id of row to update
     * @param array $vals  - array of cols and values for update ['col1'=>'val1', 'col2'=>'val2']
     * @return bool
     */
    public function update(int $id, array $vals):bool
    {
        try {

            $vals_string = '';
            foreach ($vals as $key=>$value) {
                $vals_string .= "$key = \"$value\", ";
            }
            $vals_string = rtrim($vals_string, ', ');
            $sql = "UPDATE $this->table
                    SET $vals_string
                    WHERE id = $id;";
            var_dump($sql);
            $stmt= Database::$pdo->prepare($sql);
            $stmt->execute();
            return true;
        }
        catch (\Exception $e) {
            var_dump($e);
            return false;
        }
    }
}