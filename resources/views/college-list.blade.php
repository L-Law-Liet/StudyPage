@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="tl">Наименование колледжей</th>
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
                            <td><a class="college-list-a {{isset($passiveLink)?'passive-list-a':''}}" href="{{url('college/view', [$university->id, 'college'])}}">{{$university->name_ru}}</a></td>
                            <td style=""><a class="college-list-a {{isset($passiveLink)?'passive-list-a':''}}" href="{{url('/city/view', $university->city_id)}}">{{$university->relCity->name_ru}}</a></td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
