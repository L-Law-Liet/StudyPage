@extends('adminlte::page')

@section('title', 'Редактировать рейтинг ВУЗов')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}  рейтинг ВУЗов</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/rating/add':"/admin/rating/add/$id";
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
                        {{--<div class="form-group row">--}}
                            {{--<label class="col-md-3">Направление</label>--}}
                            {{--<div class="col-md-9">--}}
                                {{--<select name="category_id" class="form-control">--}}
                                    {{--<option value=""></option>--}}
                                    {{--@foreach($categories as $k => $v)--}}
                                        {{--<option @if(is_object($rating) && $rating->category_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Университет</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control university_find" @if(is_object($rating)) value="<? if (!empty($rating->relUniversity->name_ru)) { ?>{{ $rating->relUniversity->name_ru }}<? } ?>" @endif>
                                <input type="hidden" name="university_id" id="university_id" @if(is_object($rating)) value="{{ $rating->university_id }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Город</label>
                            <div class="col-md-9">
                                <select name="city_id" class="form-control city" id="city_id">
                                    <option value=""></option>
                                    @foreach($cities as $k => $v)
                                        <option @if(is_object($rating) && $rating->city_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Итого (Балл)</label>
                            <div class="col-md-9">
                                <input type="text" name="overall_rating" class="form-control" @if(is_object($rating)) value="{{ $rating->overall_rating }}" @endif>
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
