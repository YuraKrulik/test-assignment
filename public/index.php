<?php
require_once __DIR__.'../../vendor/autoload.php';
$router = new \Bramus\Router\Router();
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'../../');
$dotenv->load();
$database = new \app\core\Database($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
$router->get('/', function () {
    header("Location: ".$_ENV['APP_URL']."./visitors");
    die();
});
$router->setNamespace('app\controllers');

$router->get('/books', 'BooksController@show');
$router->get('/books/add','BooksController@showForm');
$router->post('/books/add', 'BooksController@store');
$router->get('/books/edit/(\d+)', 'BooksController@showEditForm');
$router->post('/books/edit/(\d+)', 'BooksController@update');

$router->get('/visitors', 'VisitorsController@show');
$router->get('/visitors/add', 'VisitorsController@showForm');
$router->post('/visitors/add', 'VisitorsController@store');
$router->get('/visitors/edit/(\d+)', 'VisitorsController@showEditForm');
$router->post('/visitors/edit/(\d+)', 'VisitorsController@update');

$router->get('/genres','GenresController@show');
$router->get('/genres/add','GenresController@showForm');
$router->post('/genres/add', 'GenresController@store');
$router->get('/genres/edit/(\d+)', 'GenresController@showEditForm');
$router->post('/genres/edit/(\d+)', 'GenresController@update');

$router->get('/records', 'RecordsController@show');
$router->get('/records/add','RecordsController@showForm');
$router->post('/records/add', 'RecordsController@store');
$router->post('/records/edit/(\d+)', 'RecordsController@update');

$router->run();