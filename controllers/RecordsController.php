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
        if ($this->validate($data)) {
            if ((new Record)->create($data)) {
                header("Location: " . $_ENV['APP_URL'] . "./records");
                die();
            }
            header("Location: " . $_ENV['APP_URL'] . "./records/add");
        }
        header("Location: " . $_ENV['APP_URL'] . "./records/add");
    }

    protected function validate($data)
    {
        return (new Record)->checkIfBookAvailable($data['book_id']);
    }
}