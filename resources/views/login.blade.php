@extends('layouts.app')
@section('content')
    <div class="login-content">
        <div class="justify-content-center d-flex">
            <div id="form" class="">
                <div class="float-right">
                    <img id="login-form-close" src="img/login_form_close.svg" alt="">
                </div>
                <div id="login-header" class="text-center m-1">
                    Вход
                </div>
                <div class="login-content">
                    <div class="login-form">
                        <form id="login-form" action="">
                            <div class="login-form-div">
                                <label>Электронная почта или телефон*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <label>Пароль*</label>
                                <input class="login-form-input p-1" type="text">
                            </div>
                            <div class="login-form-div">
                                <input class="p-1 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Войти">
                            </div>
                        </form>
                    </div>
                    <div id="reg-href" class="text-center mt-1 mb-1">
                        У Вас не имеется личный кабинет? <a style="color: #2D7ABF;" href="{{url('/registration')}}">Регистрация</a>
                        <a style="color: #2D7ABF;" href="{{url('forgot-passwd')}}">Забыли пароль?</a>
                    </div>
                    <div class="login-form">
                        <div class="login-form-div mt-2 mb-3 justify-content-between d-flex">
                            <img src="img/login_line.svg" alt=""> Или
                            <img src="img/login_line.svg" alt="">
                        </div>
                        <div class="login-form-div">
                            <button id="fb_btn" class="p-1 text-white">
                                <img class="mr-1 mb-1" src="img/fb_logo.svg" alt="">Продолжить с Facebook</button>
                        </div>
                        <div class="login-form-div">
                            <button id="google-btn" class="p-1">
                                <img class="mr-1" src="img/google_logo.svg" alt="">Продолжить с Google</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
