@extends('adminlte::page')

@section('title', 'Города')

@section('content_header')
    <h1>Города</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/cityslider/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th>Наименование</th>
                                <th>Анонс</th>
                                <th>Изображение</th>
                                <th width="5%" colspan="3" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cityslider as $k => $v)
                            <tr @if($v->active == 0) class="bg-danger" @endif>
                                <td>{{ $cityslider->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td id="description">{!! mb_substr($v->announce, 0, 200, 'UTF-8') !!}</td>
                                <td><img src="/img/cities/{{ $v->image }}" alt="{{ $v->name_ru }}" width="100px"></td>
                                <td>
                                    <a href="/admin/cityslider/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/cityslider/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                {{--<td>
                                    <a href="/admin/cityslider/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan = '2'>Количество {{ $count }}</td>
                            <td colspan = '4' class='text-center'>{{ $cityslider->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection