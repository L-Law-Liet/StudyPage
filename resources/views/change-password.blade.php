@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet ch-pwd">
                <div>
                    <h3 class="text-center">Сменить пароль</h3>
                </div>
                <form action="{{action('UserController@resetPassword')}}" method="post" class="">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="m-2 w-50">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Текущий пароль</label>
                                </div>
                                <input name="passwd" class="login-form-input p-2 w-100" type="password">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Новый пароль</label>
                                </div>
                                <input name="newPassword" class="login-form-input p-2 w-100" type="password">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Повторите пароль</label>
                                </div>
                                <input name="newPassword_confirmation" class="login-form-input p-2 w-100" type="password">
                            </div>
                            <div class="w-100 cabinet-label-input m-2 mt-4">
                                <input class="p-2 w-100 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Сохранить">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
