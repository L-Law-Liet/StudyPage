@extends('adminlte::page')

@section('title', 'Добавить список ВУЗов')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}  список ВУЗов</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/list/add':"/admin/list/add/$id";
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
                            <label class="col-md-3">Название ВУЗа</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" @if(is_object($rating)) value="{{ $rating->name }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Код ВУЗа</label>
                            <div class="col-md-9">
                                <input type="text" name="code" class="form-control" @if(is_object($rating)) value="{{ $rating->code }}" @endif>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
