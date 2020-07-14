@extends('adminlte::page')

@section('title', 'Редактировать')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/social/add':"/admin/social/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Параметр{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input readonly type="text" name="name" class="form-control" @if(is_object($direction)) value="{{ $direction->name }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Значение{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input type="text" name="link" class="form-control" @if(is_object($direction)) value="{{ $direction->link }}" @endif >
                            </div>
                        </div>
                        @if(is_object($direction) && $direction->id != 7 && $direction->id != 8)
                            <div class="form-group row">
                                <label class="col-md-3">Включить</label>
                                <div class="col-md-9">
                                    <select name="active" class="form-control">
                                        <option @if(is_object($direction) && $direction->active == 1) selected @endif value="{{ 1 }}">Да</option>
                                        <option @if(is_object($direction) && $direction->active == 0) selected @endif value="{{ 0 }}">Нет</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection