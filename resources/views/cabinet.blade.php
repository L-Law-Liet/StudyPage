@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet">
                <div>
                    <h3 class="text-center">Личный кабинет</h3>
                </div>
                <form action="" class="">
                    <div class="d-flex justify-content-between">
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Фамилия</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="Койшыбайулы">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Дата рождения</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="19.10.1988">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Регион</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="Алматы">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Контактный телефон</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="87770565527">
                            </div>
                        </div>
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Имя</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="Ерлан">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Пол</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" placeholder="Мужской">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Электронная почта</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="email" placeholder="k.ykaen@gmail.com">
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-3">
                            <input class="p-2 w-50 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
