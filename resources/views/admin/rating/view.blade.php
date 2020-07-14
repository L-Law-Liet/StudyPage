@extends('adminlte::page')

@section('title', 'Просмотр рейтинга ВУЗов')

@section('content_header')
    <h1>Просмотр рейтинга ВУЗов</h1>
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
                            <th>Название ВУЗа</th>
                            <td>{{ $rating->relUniversity->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Город</th>
                            <td>{{ $rating->relCity->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Итого</th>
                            <td>{{ $rating->overall_rating }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
