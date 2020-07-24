<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserModifyDataRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function edit(UserModifyDataRequest $request){
        if ($request->input('email') != User::find(Auth::id())->email){
            $request->validate([
                'email' => 'required|unique:users'
            ]);
        }
        if ($request->input('phone') != User::find(Auth::id())->phone){
            $request->validate([
                'phone' => 'required|unique:users|numeric'
            ]);
        }
        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->birthDate = $request->input('birthDate');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->region = $request->input('city');
        $user->save();
        return redirect('cabinet')->withSuccess('Данные успешно обновлены!');
    }
    public function resetPassword(ResetPasswordRequest $request){
        $user = User::find(Auth::id());

        if ($user && Hash::check($request->input('passwd'), $user->password)) {
            $user->password = Hash::make($request->input('newPassword'));
            $user->save();
            return redirect()->route('change-pwd')->withSuccess('Пароль успешно обновлен!');
        }
        else {
            return redirect()->route('change-pwd')->withErrors('Неверный текущий пароль!');
        }
    }
}
