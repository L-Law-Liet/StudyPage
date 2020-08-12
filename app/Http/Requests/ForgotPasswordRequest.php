<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Это поле должно быть заполнено.',
            'email.email' => 'Неправильный формат электронной почты.',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        session(['forgot' => true]);
        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }
}