<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Database;

class GenresController extends Controller
{
    public function showGenres()
    {
        $this->render('main', 'genres');
    }
}