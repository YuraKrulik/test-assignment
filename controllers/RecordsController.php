<?php


namespace app\controllers;


use app\core\Controller;
use app\models\Book;
use app\models\Record;
use app\models\Visitor;

class RecordsController extends Controller
{
    /**
     * Displays all records
     */
    public function show()
    {
        $records_data = (new Record)->getAll();
        $this->render('main', 'records', $records_data);
    }

    /**
     * Displays record creation form
     */
    public function showForm()
    {
        $data['visitors'] = (new Visitor)->get(['id', 'name']);
        $data['books'] = (new Book)->get(['id', 'name']);
        $this->render('main', 'records_add', $data);
    }

    /**
     * Creates new record
     */
    public function store()
    {
        $data = $_POST;
        $data['issue_date'] = date('Y-m-d');
        $record_model = new Record();
        if ($record_model->validate($data)) {
            if ($record_model->create($data)) {
                header("Location: " . $_ENV['APP_URL'] . "/records");
                die();
            }
            Error::setSessionErrors(array('unknown' => ['unknown' => 'error when creating row']), "/records/add");
        }
        else {
            Error::setSessionErrors($record_model->getErrors(), "/records/add");
        }
    }

    /**
     * Updates record
     * @param $id
     */
    public function update($id)
    {
        $data['return_date'] = date("Y-m-d H:i:s");
        if((new Record)->update($id, $data)) {
            header("Location: ".$_ENV['APP_URL']."/records");
            die();
        }
        header("Location: ".$_ENV['APP_URL']."/records/edit/$id");
    }

    protected function validate($data)
    {
        return (new Record)->checkIfBookAvailable($data['book_id']);
    }
}