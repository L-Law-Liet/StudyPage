<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Proposal extends Model
{
    protected $table = 'proposal';
    protected $fillable = ['email', 'contact_phone', 'university_name', 'contact_name'];

    public static function rules()
    {
        return [
            'email' => 'required|email',
            'contact_phone' => 'required',
            'university_name' => 'required',
            'contact_name' => 'required',
        ];
    }

    public static function attributes()
    {
        return [
            'email' => 'Email',
            'contact_phone' => 'Контактный телефон',
            'university_name' => 'Название учебного заведения',
            'contact_name' => 'Имя контактного лица',
        ];
    }

    public static function validate($data){ //Валидация берет массив данных
        $validator = Validator::make($data, self::rules());
        $validator->setAttributeNames(self::attributes());
        return $validator;
    }
}
