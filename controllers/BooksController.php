<?php


namespace app\controllers;


use app\core\Controller;
use app\models\Book;
use app\models\Genre;

class BooksController extends Controller
{
    /**
     * Shows all books
     */
    public function show()
    {
        $books_model = new Book();
        $books_data = $books_model->getAll();
        $this->render('main', 'books', $books_data);
    }

    /**
     * Shows book creation form
     */
    public function showForm()
    {
        $genres_model = new Genre();
        $genres = $genres_model->get(['id', 'name']);
        $this->render('main', 'books_add', $genres);
    }

    /**
     * Creates new book
     */
    public function store()
    {
        if((new Book)->create($_POST)) {
            header("Location: ".$_ENV['APP_URL']."./books");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."./books/add");
    }
}