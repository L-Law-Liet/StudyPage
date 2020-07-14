@extends('adminlte::page')

@section('title', 'Заявки')

@section('content_header')
    <h1>Заявки</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th>Дата</th>
                            <th>Email</th>
                            <th>Контактный телефон</th>
                            <th>Название учебного заведения</th>
                            <th>Имя контактного лица</th>
                            <th width="5%" colspan="3" class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($proposal as $k => $v)
                            <tr>
                                <td>{{ $proposal->firstItem()+$k }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->contact_phone }}</td>
                                <td>{{ $v->university_name }}</td>
                                <td>{{ $v->contact_name }}</td>
                                <td>
                                    <a href="/admin/proposal/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td></td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/proposal/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan = '3'>Количество {{ $count }}</td>
                            <td colspan = '4' class='text-center'>{{ $proposal->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection