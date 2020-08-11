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
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center m-b-10 font-weight-bold">ОБРАТНАЯ СВЯЗЬ</h3>
                <div style="text-align:center;"><p>Администрация сайта прочтет сообщение и постарается ответить на него в кратчайшие сроки. ВНИМАНИЕ! Studypage.net&nbsp;вправе не отвечать, если: содержание сообщения нарушает законодательство; содержание сообщения противоречит основам морали и нравственности, несет оскорбительный характер; содержание сообщения не относится к деятельности Studypage.net; анонимное обращение.</p></div>
                <form action="{{route('callbackPost')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-md-3">Ваше имя*</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 pr-1">Контактный телефон*</label>
                        <div class="col-md-9">
                            <input type="text" name="phone" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Электронная почта*</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Сообщение*</label>
                        <div class="col-md-9">
                            <textarea rows="4" style="resize: none" name="question" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group">
                            <button class="btn col-4 text-capitalize btn-primary-custom float-right">
                                Отправить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
