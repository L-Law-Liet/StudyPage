@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование колледжей</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 1; $i < 8; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a class="college-list-a" href="{{url('college-view')}}">Казахский национальный университет имени аль-Фараби</a></td>
                            <td style="">Алматы</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
