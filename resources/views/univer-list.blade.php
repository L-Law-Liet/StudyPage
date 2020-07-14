@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование ВУЗа</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 1; $i < 8; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a class="college-list-a" href="#">Медицинский университет Астана</a></td>
                            <td style="">00{{$i}}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
