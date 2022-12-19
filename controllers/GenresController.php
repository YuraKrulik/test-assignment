<?php


namespace app\controllers;


use app\core\Controller;

class GenresController extends Controller
{
    public function showGenres()
    {
        $this->render('main', 'genres');
    }
}