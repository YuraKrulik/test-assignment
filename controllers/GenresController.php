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
        $this->render('main', 'genres_add');
    }

    public function showEditForm(int $id)
    {
        $data = (new Genre())->getById($id);
        $this->render('main', 'genres_add', $data);
    }

    /**
     * Creates new genre
     */
    public function store()
    {
        if((new Genre)->create($_POST)) {
            header("Location: ".$_ENV['APP_URL']."./genres");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."./genres/add");
    }

    /**
     * Updates genre
     * @param $id
     */
    public function update($id)
    {
        if((new Genre)->update($id, $_POST)) {
            header("Location: ".$_ENV['APP_URL']."./genres");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."./genres/edit/$id");
    }
}