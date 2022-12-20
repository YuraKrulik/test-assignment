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
        $this->render('main', 'books_add_edit', $data);
    }


    public function showEditForm(int $id)
    {
        $data['book'] = (new Book())->getById($id);
        $data['genres'] = (new Genre)->get(['id', 'name']);
        $this->render('main', 'books_add_edit', $data);
    }

    /**
     * Creates new book
     */
    public function store()
    {
        $book_model = new Book();
        if ($book_model->validate($_POST)) {
            if ($book_model->create($_POST)) {
                header("Location: " . $_ENV['APP_URL'] . "./books");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when creating row'];
            header("Location: " . $_ENV['APP_URL'] . "./books/add");
            die();
        } else {
            $_SESSION['errors'] = $book_model->getErrors();
            header("Location: " . $_ENV['APP_URL'] . "./books/add");
            die();
        }
    }

    /**
     * Updates book
     * @param $id
     */
    public function update($id)
    {
        $book_model = new Book();
        if ($book_model->validate($_POST)) {
            if ($book_model->update($id, $_POST)) {
                header("Location: " . $_ENV['APP_URL'] . "./books");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when creating row'];
            header("Location: " . $_ENV['APP_URL'] . "./books/add");
            die();
        } else {
            $_SESSION['errors'] = $book_model->getErrors();
            header("Location: " . $_ENV['APP_URL'] . "./books/edit/$id");
            die();
        }
    }
}