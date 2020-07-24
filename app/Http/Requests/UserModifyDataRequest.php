<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModifyDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'surname' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'birthDate' => 'required|before:2020-01-01',
            'gender' => 'required',
            'city' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле имя должно быть заполнена.',
            'name.regex' => 'Поле имя заполнена неправильно.',
            'name.min' => 'Поле имя должно иметь минимум 2 символа.',
            'surname.required' => 'Поле фамилия должно быть заполнена.',
            'surname.regex' => 'Поле фамилия заполнена неправильно.',
            'surname.min' => 'Поле фамилия должно иметь минимум 2 символа.',
            'birthDate.required' => 'Дата рождения должна быть заполнена.',
            'birthDate.before' => 'Ошибка даты рождения.',
            'gender.required' => 'Поле пол должен быть заполнен.',
            'city.required' => 'Поле город должен быть заполнен.',
        ];
    }
}
