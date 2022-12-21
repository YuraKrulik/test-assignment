<?php


namespace app\models;


use app\core\Database;
use app\core\Model;
use PDO;

class Record extends Model
{
    protected string $table = 'records';

    /**
     * Returns everything from table and names from connected tables
     * @return array
     */
    public function getAll():array
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

    /**
     * Checks if the book in available
     * @param int $book_id
     * @return bool
     */
    public function checkIfBookAvailable(int $book_id):bool
    {
        $sql = "SELECT 1
                FROM $this->table
                WHERE return_date IS NULL AND book_id = $book_id;";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();
        if(empty($res)) {
            return true;
        }
        $this->addError('book', "book is unavailable");
        return false;
    }

    public function validate(array $data, bool $is_update = false):bool
    {
        if(parent::validate($data)){
            return $this->checkIfBookAvailable($data['book_id']);
        }
        return false;
    }

    protected function rules(): array
    {
        return [
            'visitor_id' => ['required'],
            'book_id' => ['required']
        ];
    }
}