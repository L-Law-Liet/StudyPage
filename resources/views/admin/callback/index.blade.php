@extends('adminlte::page')

@section('title', 'Обратная связь')

@section('content_header')
    <h1>Обратная связь</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/callback/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th>Дата</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Телефон</th>
                                <th>Вопрос</th>
                                <th width="5%" colspan="3" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($callback as $k => $v)
                            <tr>
                                <td>{{ $callback->firstItem()+$k }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->phone }}</td>
                                <td style="max-width:300px; overflow: hidden;">{!! $v->question !!}</td>
                                <td>
                                    <a href="/admin/callback/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/callback/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/callback/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan = '2'>Количество {{ $count }}</td>
                            <td colspan = '3' class='text-center'>{{ $callback->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection