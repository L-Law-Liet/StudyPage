@extends('layouts.app')
@section('css')
    <style>
        body {
            font-family: Futura PT, sans-serif;
        }
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div id="college-view-right">
            <div>
                <h3 class="text-center">По результатам теста Ваш балл составляет: <b>{{$score}}</b></h3>
            </div>
            <div>
                <table id="ent-table">
                    <thead>
                    <tr>
                        <td colspan="3" class="ent-td w-75 p-2" >Шансы поступить на грант</td>
                        <td onclick="window.location='{{route('result-ent2', [4, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td w-25 not-33 clickable-el" rowspan="2">Шансы поступить на платное ({{count($sRes[3])}})</td>
                    </tr>
                    <tr>
                        <td onclick="window.location='{{route('result-ent2', [1, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td clickable-el">Высокий ({{count($sRes[0])}})</td>
                        <td onclick="window.location='{{route('result-ent2', [2, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td clickable-el">Средний ({{count($sRes[1])}})</td>
                        <td onclick="window.location='{{route('result-ent2', [3, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td clickable-el">Низкий ({{count($sRes[2])}})</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
{{--                    <tr>--}}
{{--                        <td>“Равно” или “больше” проходного балла на грант</td>--}}
{{--                        <td>“Меньше с 1 по 5 баллов” чем проходной балл на грант (5)</td>--}}
{{--                        <td>“Меньше с 6 по 13 баллов” чем проходной балл на грант (10)</td>--}}
{{--                        <td class=" not-33">“Меньше с 14 баллов” чем проходной балл на грант, но не меньше проходного балла на платное</td>--}}
{{--                    </tr>--}}
@for($i = 0; $i < 5; $i++)
                    <tr>
                        <td>
                            @if(count($sRes[0]) > $i)
                                @if($sRes[0][$i]->getCost())
                             <div class="justify-content-start d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b>{{$sRes[0][$i]->relSubdirection->name_ru}}</b></div>
                            </div>
                                <div class="d-flex justify-content-start">
                                    <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$sRes[0][$i]->getCost()->relUniversity->name_ru}}</p>
                                </div>

                                <b>Проходной балл: {{$sRes[0][$i]->getCost()->passing_score}}</b>
                                    @endif
                                @endif
                        </td>
                        <td>
                            @if(count($sRes[1]) > $i)
                                @if($sRes[1][$i]->getCost())
                             <div class="justify-content-start d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> {{$sRes[1][$i]->relSubdirection->name_ru}}</b></div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$sRes[1][$i]->getCost()->relUniversity->name_ru}}</p>
                            </div>
                            <b>Проходной балл: {{$sRes[1][$i]->getCost()->passing_score}}</b>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(count($sRes[2]) > $i)
                                @if($sRes[2][$i]->getCost())
                            <div class="justify-content-start d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> {{$sRes[2][$i]->relSubdirection->name_ru}}</b></div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$sRes[2][$i]->getCost()->relUniversity->name_ru}}</p>
                            </div>
                            <b>Проходной балл: {{$sRes[2][$i]->getCost()->passing_score}}</b>
                                @endif
                            @endif
                        </td>
                        <td class=" not-33">
                            @if(count($sRes[3]) > $i)
                                @if($sRes[3][$i]->getCost())
                             <div class="justify-content-start d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> {{$sRes[3][$i]->relSubdirection->name_ru}}</b></div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$sRes[3][$i]->getCost()->relUniversity->name_ru}}</p>
                            </div>
                            <b>Проходной балл: {{$sRes[3][$i]->getCost()->passing_score}}</b>
                                @endif
                            @endif
                        </td>
                    </tr>
@endfor

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
