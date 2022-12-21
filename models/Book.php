<?php


namespace app\models;


use app\core\Database;
use app\core\Model;
use PDO;

/**
 * Class Book
 */
class Book extends Model
{
    protected string $table = 'books';
    
    /**
     * Returns everything from table and names from connected tables
     * @return array
     */
    public function getAll():array
    {
        $sql = "SELECT books.id, books.name, books.author, books.release_year, genres.name as genre
                FROM $this->table
                JOIN genres ON books.genre_id=genres.id;";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required'],
            'author' => ['required'],
            'release_year' => ['required', 'max:4'],
            'genre_id' => ['required'],
        ];
    }
}