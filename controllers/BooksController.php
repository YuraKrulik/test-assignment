<?php


namespace app\controllers;


use app\core\Controller;
use app\models\Book;

class BooksController extends Controller
{
    public function showBooks()
    {
        $books_model = new Book();
        $books_data = $books_model->getAll();
        $this->render('main', 'books', $books_data);
    }
}