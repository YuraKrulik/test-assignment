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
     * Shows list of users
     */
    public function showVisitors()
    {
        $visitors_model = new Visitor;
        $visitors_data = $visitors_model->getAll();
        $this->render('main', 'visitors', $visitors_data);
    }
}