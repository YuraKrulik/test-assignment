<?php


namespace app\controllers;


use app\core\Controller;
use app\models\Record;

class RecordsController extends Controller
{
    public function showRecords()
    {
        $records_model = new Record();
        $records_data = $records_model->getAll();
        $this->render('main', 'records', $records_data);
    }
}