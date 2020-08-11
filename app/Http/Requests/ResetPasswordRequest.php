<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'newPassword' => 'required|string|min:8|confirmed',
            'newPassword_confirmation' => 'required|same:newPassword',
        ];
    }
    public function messages()
    {
        return [
            'newPassword.string' => 'Поле «Новый пароль» пуст.',
            'newPassword.min' => 'Поле «Новый пароль» должен иметь минимум 8 символов.',
            'newPassword.required' => 'Поле «Новый пароль» пуст.',
            'newPassword.confirmed' => 'Поле «Новый пароль» не совпадает.',
            'newPassword_confirmation.required' => 'Поле «Повторите пароль» пуст.',
        ];
    }
}
