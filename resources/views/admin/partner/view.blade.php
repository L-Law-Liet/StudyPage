@extends('adminlte::page')

@section('title', 'Просмотр партнера')

@section('content_header')
    <h1>Просмотр партнера</h1>
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
                            <th>Ссылка</th>
                            <td>{{ $partner->link }}</td>
                        </tr>
                        <tr>
                            <th>Ответ</th>
                            <td><img src="/img/partners/{{ $partner->image }}" alt="{{ $partner->image }}" width="150px"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
