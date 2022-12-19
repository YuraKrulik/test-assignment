<?php


namespace app\core;

/**
 * Class for establishing database connection
 * Class Database
 * @package app\core
 */
class Database
{
    static public \PDO $pdo;

    public function __construct($dsn, $user, $password)
    {
        self::$pdo = new \PDO($dsn, $user, $password);
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}