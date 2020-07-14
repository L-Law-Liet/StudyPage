@extends('adminlte::page')

@section('title', 'Рейтинг ВУЗов')

@section('content_header')
    <h1>Рейтинг ВУЗов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/rating/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">№</th>
                                <th>Университет</th>
                                {{--<th>Направление</th>--}}
                                <th>Город</th>
                                <th>Итого (Балл)</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($rating as $k => $v)
                            <tr>
                                <td>{{ $rating->firstItem()+$k }}</td>
                                <td><? if (!empty($v->relUniversity->name_ru)) { ?>{{ $v->relUniversity->name_ru }}<? } ?></td>
                                {{--<td>@if(is_object($v->relCategory)){{ $v->relCategory->name }}@endif</td>--}}
                                <td><? if (!empty($v->relCity->name_ru)) { ?>{{ $v->relCity->name_ru }}<? } ?></td>
                                <td>{{ $v->overall_rating }}</td>
                                <td>
                                    <a href="/admin/rating/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/rating/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/rating/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '4'>Количество {{ $count }}</td>
                                <td colspan = '4' class='text-center'>{{ $rating->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    @php
                        $action = (!is_object($ranking) && empty($ranking->source))?'/admin/rating/source':"/admin/rating/source/$ranking->id";
                    @endphp
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Источник</label>
                            <div class="col-md-9">
                                <input type="text" name="source" class="form-control" @if(is_object($ranking)) value="{{ $ranking->source }}" @endif>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">@if(is_object($ranking) && !empty($ranking->source)) Изменить @else Сохранить @endif</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection