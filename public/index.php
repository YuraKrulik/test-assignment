<?php
require_once __DIR__.'../../vendor/autoload.php';
$router = new \Bramus\Router\Router();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'../../');
$dotenv->load();
$database = new \app\core\Database($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
$router->get('/', function () {
    echo 'Home';
});
$router->setNamespace('app\controllers');
$router->get('/books', 'BooksController@showBooks');
$router->get('/visitors', 'VisitorsController@showVisitors');
$router->get('/genres','GenresController@showGenres');
$router->get('/records', 'RecordsController@showRecords');

$router->run();