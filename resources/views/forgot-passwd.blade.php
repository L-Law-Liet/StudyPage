@extends('layouts.app')
@section('content')
    <div class="min-heigh-310px">
        <div class="login-content">
            <div class="justify-content-center d-flex">
                <div id="form" class="forgot-passwd-form p-3">
                    <div class="float-right">
                        <img id="login-form-close" src="img/login_form_close.svg" alt="">
                    </div>
                    <div class="m-3">
                        <div id="login-header">
                            Восстановление пароля
                        </div>
                        <div class="forgot-passwd-subtitle pr-5">
                            Введите электронную почту или телефон, указанный при регистрации. На указанную Вами
                            электронную почту или телефон придет письмо со ссылкой для восстановления пароля.
                        </div>
                    </div>
                    <form id="login-form" action="" class="p-2 m-1">
                        <div class="login-form-div">
                            <label>Электронная почта или телефон*</label>
                            <input class="login-form-input p-1" type="text">
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="login-form-div col-4 pr-0">
                                <input class="p-1 text-white bg-C4C4C4" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Отменить">
                            </div>
                            <div class="login-form-div col-4 pr-0">
                                <input class="p-1 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Отправить">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
