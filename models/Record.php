<?php


namespace app\models;


use app\core\Database;
use app\core\Model;
use PDO;

class Record extends Model
{
    protected $table = 'records';

    public function getAll()
    {
        $sql = "SELECT t.id, v.name as visitor_name, b.name as book_name, t.issue_date
                FROM $this->table as t
                JOIN visitors as v
                ON t.visitor_id = v.id
                JOIN books as b
                ON t.book_id=b.id
                WHERE t.return_date IS NULL;";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}