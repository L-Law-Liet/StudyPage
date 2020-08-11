@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('error'))
            <div class="container">
                <div class="alert alert-danger">
                    <h4>{{ trans('general.error') }}</h4>
                    <p> {!! Session::get('error') !!} </p>
                </div>
            </div>
        @endif

        @if (is_object($errors) && $errors->any())
            <div class="container">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet">
                <div>
                    <h3 class="text-center">Личные данные</h3>
                </div>
                <form action="{{action('UserController@edit')}}" method="post" class="">
                    @csrf
                    <div class="d-flex justify-content-between bold-label-div">
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Фамилия</label>
                                </div>
                                <input name="surname" class="login-form-input p-1 w-90" type="text" value="{{Auth::user()->surname}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Дата рождения</label>
                                </div>
                                <input name="birthDate" class="login-form-input p-1 w-90" type="date" max="2020-01-01" min="1920-01-01" value="{{Auth::user()->birthDate}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Регион</label>
                                </div>
                                <select class="login-form-input p-1 w-90" name="city">
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
                                <input onkeypress='validate(event)' name="phone" oninput="phone1(event)" maxlength="12" class="login-form-input p-1 w-90" type="tel" value="+7{{substr(Auth::user()->phone, 2)}}">
                            </div>
                        </div>
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Имя</label>
                                </div>
                                <input name="name" class="login-form-input p-1 w-90" type="text" value="{{Auth::user()->name}}">
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Пол</label>
                                </div>
                                <select class="login-form-input p-1 w-90" name="gender">
                                    <option @if(Auth::user()->gender == 'm') selected @endif value="m">Мужчина</option>
                                    <option @if(Auth::user()->gender == 'fm') selected @endif value="fm">Женщина</option>
                                </select>
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Электронная почта</label>
                                </div>
                                <input name="email" class="login-form-input p-1 w-90" type="email" value="{{Auth::user()->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group text-center">
                            <button type="submit" class="btn col-4 text-capitalize btn-primary-custom">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function phone1(event) {
            event.target.value = '+7'+event.target.value.substr(2);
        }
    </script>
    @endsection
