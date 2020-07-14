@extends('adminlte::page')

@section('title', 'FAQs')

@section('content_header')
    <h1>FAQs</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/faq/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th>Дата создания</th>
                            <th>Вопрос</th>
                            <th>Ответ</th>
                            <th colspan="3" class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faq as $k => $v)
                            <tr>
                                <td>{{ $faq->firstItem()+$k }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d.m.Y') }}</td>
                                <td><?=$v->question?></td>
                                <td><?=$v->answer?></td>
                                <td>
                                    <a href="/admin/faq/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/faq/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/faq/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '3'>Количество {{ $count }}</td>
                                <td colspan = '4' class='text-center'>{{ $faq->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection