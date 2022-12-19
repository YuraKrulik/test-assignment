<?php


namespace app\controllers;


use app\core\Controller;

class BooksController extends Controller
{
    public function showBooks()
    {
        $this->render('main', 'books');
    }
}