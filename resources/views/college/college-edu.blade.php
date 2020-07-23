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
@section('content')
    @include('college/subnav')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h3 class="text-center">ОБРАЗОВАТЕЛЬНЫЕ ПРОГРАММЫ</h3>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-view">
                                    <thead>
                                    <tr>
                                        <th>БАКАЛАВРИАТ</th>
                                        <th class="w-25"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($university->programs as $program)
                                        @if($program->degree->id == 1)
                                            <tr>
                                                <td>{{$program->name}}</td>
                                                <td class="tl"><b>{{($program->has)? '+' : '-'}}</b></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-view">
                                    <thead>
                                    <tr>
                                        <th>МАГИСТРАТУРА</th>
                                        <th class="w-25"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($university->programs as $program)
                                        @if($program->degree->id == 2)
                                            <tr>
                                                <td>{{$program->name}}</td>
                                                <td class="tl"><b>{{($program->has)? '+' : '-'}}</b></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-view">
                                    <thead>
                                    <tr>
                                        <th>ДОКТОРНАТУРА</th>
                                        <th class="w-25"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($university->programs as $program)
                                        @if($program->degree->id == 3)
                                            <tr>
                                                <td>{{$program->name}}</td>
                                                <td class="tl"><b>{{($program->has)? '+' : '-'}}</b></td>
                                            </tr>
                                        @endif
                                    @endforeach
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
