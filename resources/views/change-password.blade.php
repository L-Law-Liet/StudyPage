@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet ch-pwd">
                <div>
                    <h3 class="text-center">
                        <strong>Сменить пароль</strong>
                    </h3>
                </div>
                <form action="{{action('UserController@resetPassword')}}" method="post" class="">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="m-2 w-50">
                            <div class="bold-label-div mb-4">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Текущий пароль</label>
                                    </div>
                                    <input name="passwd" class="login-form-input p-1 w-90" type="password">
                                </div>
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Новый пароль</label>
                                    </div>
                                    <input name="newPassword" class="login-form-input p-1 w-90" type="password">
                                </div>
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Повторите пароль</label>
                                    </div>
                                    <input name="newPassword_confirmation" class="login-form-input p-1 w-90" type="password">
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn col-8 text-capitalize btn-primary-custom">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
