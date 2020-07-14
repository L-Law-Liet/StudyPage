@extends('adminlte::page')

@section('title', 'Список ВУЗов')

@section('content_header')
    <h1>Список ВУЗов</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/list/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">№</th>
                                <th>Название ВУЗа</th>
                                <th>Код</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($rating as $k => $v)
                            <tr>
                                <td>{{ $rating->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->code }}</td>
                                <td>
                                    <a href="/admin/list/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/list/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/list/delete/{{ $v->id }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection