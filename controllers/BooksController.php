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
        $data['genres'] = (new Genre)->get(['id', 'name']);
        $this->render('main', 'books_add', $data);
    }


    public function showEditForm(int $id)
    {
        $data['book'] = (new Book())->getById($id);
        $data['genres'] = (new Genre)->get(['id', 'name']);
        $this->render('main', 'books_add', $data);
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

    /**
     * Updates book
     * @param $id
     */
    public function update($id)
    {
        if((new Book())->update($id, $_POST)) {
            header("Location: ".$_ENV['APP_URL']."./books");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."./books/edit/$id");
    }
}