<?php


namespace app\models;


use app\core\Model;

class Genre extends Model
{
    protected string $table = 'genres';


    protected function rules(): array
    {
        return [
          'name' => ['required']
        ];
    }
}