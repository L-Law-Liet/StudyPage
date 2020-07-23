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
                                <input class="login-form-input p-2 w-100" type="text" value="{{Auth::user()->surname}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Дата рождения</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="date" max="2020-01-01" min="1920-01-01" value="{{Auth::user()->birthDate}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Регион</label>
                                </div>
                                <select class="login-form-input p-2 w-100" name="city">
                                    @foreach($cities as $city)
                                    <option @if(Auth::user()->region == $city->id) selected @endif value="{{$city->id}}">{{$city->name_ru}}</option>
                                    @endforeach
{{--                               <input class="login-form-input" type="text" value="{{Auth::user()->region}}">--}}
                                </select>
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Контактный телефон</label>
                                </div>
                                <input oninput="phone(event)" maxlength="10" class="login-form-input p-2 w-100" type="text" value="+7{{substr(Auth::user()->phone, 2)}}">
                            </div>
                        </div>
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Имя</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="text" value="{{Auth::user()->name}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Пол</label>
                                </div>
                                <select class="login-form-input p-2 w-100" name="city">
                                    <option @if(Auth::user()->gender == 'm') selected @endif value="m">Мужчина</option>
                                    <option @if(Auth::user()->gender == 'fm') selected @endif value="fm">Женщина</option>
                                </select>
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Электронная почта</label>
                                </div>
                                <input class="login-form-input p-2 w-100" type="email" value="{{Auth::user()->email}}">
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
    <script>
        function phone(event) {
            event.target.value[0] = '+';
            event.target.value[1] = '7';
        }
    </script>
    @endsection
