@extends('adminlte::page')

@section('title', 'ВУЗы')

@section('content_header')
    <h1>ВУЗы</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/university/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Дата создания</th>
                                <th>Название ВУЗа</th>
                                <th>Город</th>
                                <th>Адрес</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($universities as $k => $v)
                            <tr>
                                <td>{{ $universities->firstItem()+$k }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d.m.Y') }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>@if(!empty($v->city_id)){{ \App\Models\City::find($v->city_id)->name_ru }}@endif</td>
                                <td>{{ $v->address_ru }}</td>
                                <td>{{ $v->phone }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->web_site }}</td>
                                <td>
                                    <a href="/admin/university/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/university/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/university/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '4'>Количество {{ $count }}</td>
                                <td colspan = '5' class='text-center'>{{ $universities->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection