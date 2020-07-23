@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование организации</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($partners as $partner)
                        <tr>
                            <td>{{ $partner->id }}</td>
                            <td> {{ $partner->name }}</td>
                            <td style="">{{ $partner->region }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
