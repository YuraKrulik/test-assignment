<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Database;
use app\models\Genre;

class GenresController extends Controller
{
    /**
     * Shows all genres
     */
    public function show()
    {
        $genres_model = new Genre();
        $genres_data = $genres_model->getAll();
        $this->render('main', 'genres', $genres_data);
    }

    /**
     * Shows genre creation form
     */
    public function showForm()
    {
        $this->render('main', 'genres_add_edit');
    }

    public function showEditForm(int $id)
    {
        $data = (new Genre())->getById($id);
        $this->render('main', 'genres_add_edit', $data);
    }

    /**
     * Creates new genre
     */
    public function store()
    {
        $genre_model = new Genre();
        if ($genre_model->validate($_POST)) {
            if($genre_model->create($_POST)) {
                header("Location: ".$_ENV['APP_URL']."./genres");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when creating row'];
            header("Location: ".$_ENV['APP_URL']."./genres/add");
            die();
        }
        else {
            $_SESSION['errors'] = $genre_model->getErrors();
            header("Location: ".$_ENV['APP_URL']."./genres/add");
            die();
        }
    }

    /**
     * Updates genre
     * @param $id
     */
    public function update($id)
    {
        $genre_model = new Genre();
        if ($genre_model->validate($_POST)) {
            if ($genre_model->update($id, $_POST)) {
                header("Location: " . $_ENV['APP_URL'] . "./genres");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when creating row'];
            header("Location: " . $_ENV['APP_URL'] . "./genres/edit/$id");
            die();
        } else {
            $_SESSION['errors'] = $genre_model->getErrors();
            header("Location: " . $_ENV['APP_URL'] . "./genres/edit/$id");
            die();
        }
    }
}