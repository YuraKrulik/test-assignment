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
    protected array $errors = [];

    /**
     * Getter for errors
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $key - key for error
     * @param string $message -error message
     */
    public function addError(string $key, string $message)
    {
        $this->errors[$key][] = $message;
    }

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

    protected function checkIfExists(string $column_name, $value): bool
    {
        $sql = "SELECT 1
                FROM $this->table
                WHERE $column_name = \"$value\";";
        var_dump($sql);
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();
        if(empty($res)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $value -email value
     * @param int $id - row id to exclude from search
     * @return bool
     */
    protected function checkIfEmailExistsUpdate(string $value, int $id): bool
    {
        $sql = "SELECT 1
                FROM $this->table
                WHERE email = \"$value\" AND id <> $id";
        var_dump($sql);
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();
        if(empty($res)) {
            return true;
        }
        return false;
    }

    /**
     * @return array - should return array of validation rules for example [
     *   'col1' => ['required'],
     *   'col2' => ['required', 'email'],
     *   'col3' => ['max:8'],
     *   ]
     */
    protected abstract function rules():array;

    /**
     * Validates given data
     * @param array $data - data to validate according to rules()
     * @param bool $is_update -specifies if updating for email validation
     * @return bool
     */
    public function validate(array $data, bool $is_update = false) {
        foreach ($this->rules() as $key=>$rules) {
            foreach ($rules as $rule) {
                if ($rule === 'required' && empty($data[$key]))
                    $this->addError($key, "$key is required");
                if ($rule === 'email') {
                    if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                        $this->addError($key, "$key field should be a valid email");
                        continue;
                    }
                    elseif ($is_update ? !$this->checkIfEmailExistsUpdate($data[$key], $data['id']) : !$this->checkIfExists($key, $data[$key])) {
                        $this->addError($key, "$key already exists");
                    }
                }
                if (str_contains($rule, "max:")) {
                    $parts = explode(':',$rule);
                    if (strlen($data[$key]) > $parts[1])
                        $this->addError($key, "$key maximum length is $parts[1] characters");
                }
                if ($rule === 'unique') {
                    if (!$this->checkIfExists($key, $data[$key]))
                        $this->addError($key, "$key already exists");
                }
            }
        }
        if (empty($this->getErrors()))
            return true;
        return false;
    }
}