@extends('adminlte::page')

@section('title', 'Добавить вопрос')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} вопрос</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/faq/add':"/admin/faq/add/$id";
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
                            <label class="col-md-3">Вопрос</label>
                            <div class="col-md-9">
                                <input name="question" type="text" class="form-control" <? if(is_object($faq)) { ?> value="<?=$faq->question?>" <? } ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Ответ</label>
                            <div class="col-md-9">
                                <textarea name="answer" class="form-control">@if(is_object($faq)) {{ $faq->answer }} @endif</textarea>
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