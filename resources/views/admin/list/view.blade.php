@extends('adminlte::page')

@section('title', 'Просмотр ВУЗа')

@section('content_header')
    <h1>Просмотр ВУЗа</h1>
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
                            <th>Название</th>
                            <td>{{ $rating->name }}</td>
                        </tr>
                        <tr>
                            <th>Код</th>
                            <td>{{ $rating->code }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
