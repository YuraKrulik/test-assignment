<?php


namespace app\models;


use app\core\Model;

class Visitor extends Model
{
    protected string $table = 'visitors';

    protected function rules(): array
    {
        return [
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ];
    }
}