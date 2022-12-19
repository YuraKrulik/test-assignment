<?php


namespace app\controllers;


use app\core\Controller;

class RecordsController extends Controller
{
    public function showRecords()
    {
        $this->render('main', 'records');
    }
}