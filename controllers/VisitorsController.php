<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Visitor;

/**
 * Class VisitorsController
 */
class VisitorsController extends Controller
{
    /**
     * Shows list of visitors
     */
    public function show()
    {
        $visitors_model = new Visitor;
        $visitors_data = $visitors_model->getAll();
        $this->render('main', 'visitors', $visitors_data);
    }

    /**
     * Show visitor creation form
     */
    public function showForm()
    {
        $this->render('main', 'visitors_add_edit');
    }

    public function showEditForm(int $id)
    {
        $data = (new Visitor)->getById($id);
        $this->render('main', 'visitors_add_edit', $data);
    }

    /**
     * Creates new visitor
     */
    public function store()
    {
        $visitor_model = new Visitor();
        if ($visitor_model->validate($_POST)) {
            if($visitor_model->create($_POST)) {
                header("Location: ".$_ENV['APP_URL']."./visitors");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when creating row'];
            header("Location: ".$_ENV['APP_URL']."./visitors/add");
            die();
        }
        else {
            $_SESSION['errors'] = $visitor_model->getErrors();
            header("Location: ".$_ENV['APP_URL']."./visitors/add");
            die();
        }
    }

    /**
     * Updates visitor
     * @param $id
     */
    public function update($id)
    {
        $visitor_model = new Visitor();
        $data = $_POST;
        $data['id'] = $id;
        if ($visitor_model->validate($data, true)) {
            if($visitor_model->update($id, $_POST)) {
                header("Location: ".$_ENV['APP_URL']."./visitors");
                die();
            }
            $_SESSION['errors']['unknown'] = ['unknown' => 'error when updating row'];
            header("Location: " . $_ENV['APP_URL'] . "./visitors/edit/$id");
            die();
        } else {
            $_SESSION['errors'] = $visitor_model->getErrors();
            header("Location: " . $_ENV['APP_URL'] . "./visitors/edit/$id");
            die();
        }
    }
}