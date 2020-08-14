@extends('adminlte::page')

@section('title', 'Пользователи')

@section('content_header')
    <h1>Пользователи</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="4%">#</th>
                            <th width="50%">ФИО</th>
                            <th width="12%" class="">Баланс</th>
                            <th width="12%" class="">Даты</th>
                            <th width="22%" colspan="2" class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $k => $v)
                            <tr>
                                <td>{{ $users->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->bill }}</td>
                                <td>{{ $v->birthDate }}</td>
                                <td>
                                    <a href="/admin/user/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/user/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="20%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $users->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
