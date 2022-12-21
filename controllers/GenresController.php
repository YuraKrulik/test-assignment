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

    /**
     * Shows form for editing
     * @param int $id - id of row being edited
     */
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
                header("Location: ".$_ENV['APP_URL']."/genres");
                die();
            }
            Error::setSessionErrors(array('unknown' => ['unknown' => 'error when creating row']), "/genres/add");
        }
        else {
            Error::setSessionErrors($genre_model->getErrors(), "/genres/add");
        }
    }

    /**
     * Updates genre
     * @param $id
     */
    public function update($id)
    {
        $genre_model = new Genre();
        $data = $_POST;
        $data['id'] = $id;
        if ($genre_model->validate($data, true)) {
            if ($genre_model->update($id, $_POST)) {
                header("Location: " . $_ENV['APP_URL'] . "/genres");
                die();
            }
            Error::setSessionErrors(array('unknown' => ['unknown' => 'error when updating row']), "/genres/edit/$id");
        } else {
            Error::setSessionErrors($genre_model->getErrors(), "/genres/edit/$id");
        }
    }
}