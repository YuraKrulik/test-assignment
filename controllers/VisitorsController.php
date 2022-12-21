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

    /**
     * Shows form for editing
     * @param int $id - id of row being edited
     */
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
                header("Location: ".$_ENV['APP_URL']."/visitors");
                die();
            }
            Error::setSessionErrors(array('unknown' => ['unknown' => 'error when updating row']), "/visitors/add");
        }
        else {
            Error::setSessionErrors($visitor_model->getErrors(), "/visitors/add");
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
                header("Location: ".$_ENV['APP_URL']."/visitors");
                die();
            }
            Error::setSessionErrors(array('unknown' => ['unknown' => 'error when updating row']), "/visitors/edit/$id");
        } else {
            Error::setSessionErrors($visitor_model->getErrors(), "/visitors/edit/$id");
        }
    }
}