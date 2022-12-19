<?php
require_once __DIR__.'../../vendor/autoload.php';
$router = new \Bramus\Router\Router();

$router->get('/', function () {
    echo 'Home';
});
$router->setNamespace('app\controllers');
$router->get('/books', 'BooksController@showBooks');
$router->get('/visitors', 'VisitorsController@showVisitors');
$router->get('/genres','GenresController@showGenres');
$router->get('/records', 'RecordsController@showRecords');

$router->run();