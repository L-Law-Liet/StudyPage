@extends('adminlte::page')

@section('title', 'Редактировать Страницу ВУЗов')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} {{!str_contains(url()->current(), 'college')?'ВУЗ':'Колледж'}}</h1>
@stop

@section('content')
    @php
        $which = !str_contains(url()->current(), 'college')?'university':'college';
        if (!str_contains(url()->current(), 'college')){
            $hasVal = 0;
        }
        else{
            $hasVal = 1;
        }
        $action = is_null($id)?'/admin/list/'.$which.'/add':"/admin/list/".$which."/add/$id";
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
                            <label class="col-md-3">Наименование {{!str_contains(url()->current(), 'college')?'ВУЗа':'Колледжа'}} {{--на русском--}}</label>
                            <div class="col-md-9">
                                <select name="id" @if(is_object($university)) disabled @endif class="form-control">
                                    <option value=""></option>
                                    @if(is_object($university))
                                        @foreach(\App\Models\University::where('description', '<>', null)->where('hasCollege', $hasVal)->get() as $u)
                                            <option @if($u->id == $university->id) selected @endif value="{{$u->id}}">{{$u->name_ru}}</option>
                                        @endforeach
                                        @else
                                    @foreach(\App\Models\University::where('description', null)->where('hasCollege', $hasVal)->get() as $u)
                                    <option value="{{$u->id}}">{{$u->name_ru}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">О {{!str_contains(url()->current(), 'college')?'ВУЗе':'колледже'}}</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control">@if(is_object($university)) {{ $university->description }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Достижения</label>
                            <div class="col-md-9">
                                <textarea name="achievements" class="form-control">@if(is_object($university)) {{ $university->achievements }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Сотрудничество</label>
                            <div class="col-md-9">
                                <textarea name="coop" class="form-control">@if(is_object($university)) {{ $university->coop }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Рейтинг</label>
                            <div class="col-md-9">
                                <textarea name="rating" class="form-control">@if(is_object($university)) {{ $university->rating }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Гранты/Скидки</label>
                            <div class="col-md-9">
                                <textarea name="grants" class="form-control">@if(is_object($university)) {{ $university->grants }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Образовательные программы</label>
                            <div class="col-md-9">
                                <textarea name="learn_program" class="form-control">@if(is_object($university)) {{ $university->learn_program }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Документы для поступления</label>
                            <div class="col-md-9">
                                <textarea name="docs_income" class="form-control">@if(is_object($university)) {{ $university->docs_income }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Контакты</label>
                            <div class="col-md-9">
                                <textarea name="short_description" class="form-control">@if(is_object($university)) {{ $university->short_description }} @endif</textarea>
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
