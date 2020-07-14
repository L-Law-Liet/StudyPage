@extends('layouts.app')
@section('css')
    <style>
        body {
            font-family: Futura PT, sans-serif;
        }
        .py-4 {
            padding-top: 0 !important;
        }
    </style>
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 callback-content">
                <h3 class="text-center m-b-10 font-weight-bold callback-h3">ОБРАТНАЯ СВЯЗЬ</h3>
                <?
                    $a = \App\Models\Article::findOrFail(34);
                    echo '<div style="text-align:center;">'.$a->description.'</div>';
                ?>
                <form action={{ URL::action("IndexController@postCallback") }} method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label>Ваше имя*</label>
                            <input type="text" name="name" class="form-control p-2" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label>Контактный телефон*</label>
                            <input type="text" name="phone" class="form-control p-2" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label>Электронная почта*</label>
                            <input type="email" name="email" class="form-control p-2" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label>Электронная почта</label>
                            <input type="email" name="email" class="form-control p-2" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label>Сообщение*</label>
                            <textarea style="resize: none" rows="4" name="question" class="form-control p-2">{{ old('question') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <button class="btn btn-success float-right callback-btn">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
