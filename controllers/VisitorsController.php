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
        $this->render('main', 'visitors_add');
    }

    /**
     * Creates new visitor
     */
    public function store()
    {
        if((new Visitor)->create($_POST)) {
            header("Location: ".$_ENV['APP_URL']."./visitors");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."./visitors/add");
    }
}