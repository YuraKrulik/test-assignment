<?php

namespace app\controllers;

use app\core\Controller;

class VisitorsController extends Controller
{
    public function showVisitors()
    {
        $this->render('main', 'visitors');
    }
}