@extends('adminlte::page')

@section('title', 'ВУЗы')

@section('content_header')
    <h1>Страницы @if(!str_contains(url()->current(), 'college'))ВУЗОВ @elseКолледжей @endif</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/list/{{!str_contains(url()->current(), 'college')?'university':'college'}}/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th width="80%">Название @if(!str_contains(url()->current(), 'college'))ВУЗа @elseколледжа @endif</th>

                            <th width="18%" colspan="3" class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($universities as $k => $v)
                            <tr>
                                <td>{{ $universities->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>
                                    <a href="/admin/list/{{!str_contains(url()->current(), 'college')?'university':'college'}}/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/list/{{!str_contains(url()->current(), 'college')?'university':'college'}}/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/list/{{!str_contains(url()->current(), 'college')?'university':'college'}}/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="20%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $universities->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
