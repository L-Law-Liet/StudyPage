@extends('adminlte::page')

@section('title', 'Области образования')

@section('content_header')
    <h1>Области образования</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/direction/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Дата создания</th>
                                <th>Область образования</th>
                                {{--<td>Название на казахском</td>--}}
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($directions as $k => $v)
                            <tr>
                                <td>{{ $directions->firstItem()+$k }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d.m.Y') }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>
                                    <a href="/admin/direction/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/direction/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/direction/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Количество {{ $count }}</td>
                                <td colspan = '2' class='text-center'>{{ $directions->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection