@extends('adminlte::page')

@section('title', 'Просмотр требования')

@section('content_header')
    <h1>Просмотр требования</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-view">
                        <tr>
                            <th>Степень</th>
                            <td>{{ $requirement->relDegree->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Текст</th>
                            <td>{!! $requirement->content_ru !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection