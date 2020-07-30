@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="tl">Наименование ВУЗа</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($universities as $university)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a class="college-list-a {{isset($passiveLink)?'passive-list-a':''}}" href="{{url('college/view', [$university->id, 'univer'])}}">{{$university->name_ru}}</a></td>
                            <td style="">{{str_pad($university->city_id, 3, '0', STR_PAD_LEFT)}}</td>
                        </tr>
                        @php $i++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
