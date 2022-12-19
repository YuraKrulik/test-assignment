<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Database;
use app\models\Genres;

class GenresController extends Controller
{
    public function showGenres()
    {
        $genres_model = new Genres();
        $genres_data = $genres_model->getAll();
        $this->render('main', 'genres', $genres_data);
    }
}