<?php

namespace app\controllers;

use app\core\Controller;
use app\models\VisitorModel;

class VisitorsController extends Controller
{
    public function showVisitors()
    {
        $visitors_model = new VisitorModel;
        $visitors_data = $visitors_model->getAll();
        $this->render('main', 'visitors', $visitors_data);
    }
}