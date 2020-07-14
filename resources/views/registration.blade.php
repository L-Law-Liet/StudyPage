@extends('layouts.app')
@section('content')
    <div class="login-content">
        <div class="justify-content-center d-flex">
            <div id="form" class="">
                <div class="float-right">
                    <img id="login-form-close" src="img/login_form_close.svg" alt="">
                </div>
                <div id="login-header" class="text-center m-1">
                    Регистрация
                </div>
                <div class="login-content">
                    <div class="login-form">
                        <form id="login-form" action="">
                            <div class="login-form-div">
                                <label>Фамилия*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Имя*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Дата рождения*</label>
                                <input class="login-form-input p-1 date-unstyle" type="date">
                            </div>
                            <div class="login-form-div">
                                <label>Пол*</label>
                                <select class="login-form-input p-1 w-100" name="gender" id="">
                                </select>
                            </div>
                            <div class="login-form-div">
                                <label>Регион*</label>
                                <select class="login-form-input p-1 w-100" name="gender" id="">
                                </select>
                            </div>

                            <div class="login-form-div">
                                <label>Электронная почта*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Контактный телефон*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Пароль*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Повторите пароль*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <input class="p-1 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Войти">
                            </div>
                        </form>
                    </div>
                    <div id="reg-href" class="text-center mt-1 mb-1 policy">
                        Регистрируясь, Вы подтверждаете свое согласие
                        <a class="color-2D7ABF" href="#">с Политическим соглашением. Полной</a>
                        конфедициальностью на обработку персональных
                        данных и на использование файлов “cookie”.
                    </div>
                    <div class="login-form">
                        <div id="reg-line" class="mt-2 mb-3 justify-content-start d-flex">
                            <img src="img/reg-line.svg" alt="">
                        </div>
                        <div id="reg-href" class="text-center mt-1 mb-1">
                            У Вас уже имеется личный кабинет?
                            <a class="color-2D7ABF" href="{{url('login')}}">Войти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
