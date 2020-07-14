@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('subnav')
    <div class="container">
        <div class="college-view-nav">
            <a href="{{url()->previous()}}"><img class="mr-2" src="{{asset('img/arrow-left.svg')}}" alt=""><span>Вернуться к списку колледжей /</span></a><span class="color-2D7ABF"> Университет Нархоз</span>
        </div>
    </div>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h3 class="text-center">ГРАНТЫ / СКИДКИ</h3>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-view">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th class="">Группа образовательных программ</th>
                                        <th width="35%;">Кол-во выделенных грантов</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i < 8; $i++)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>Педагогика и психология</td>
                                            <td class="tl">{{110-$i*10}}</td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
