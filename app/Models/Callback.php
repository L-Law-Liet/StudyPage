<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Callback extends Model
{
    protected $table = 'callback';
    protected $fillable = ['name', 'email', 'phone', 'question', 'answer'];

    public static function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'question' => 'required',
        ];
    }

    public static function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'question' => 'Вопрос',
        ];
    }

    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }
}
