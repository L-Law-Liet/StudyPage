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
                        <td colspan="4" class="ent-td w-75 p-2" >{{$title}}</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
                    <tr hidden>
                        <td>“Равно” или “больше” проходного балла на грант</td>
                        <td>“Меньше с 1 по 5 баллов” чем проходной балл на грант (5)</td>
                        <td>“Меньше с 6 по 13 баллов” чем проходной балл на грант (10)</td>
                        <td class=" not-33">“Меньше с 14 баллов” чем проходной балл на грант, но не меньше проходного балла на платное</td>
                    </tr>
                    @for($i = 0; $i < ceil(count($array)/4); $i++)
                        <tr>
                            @php
                            $row = ($i+1)*4;
                            if ($row > ceil(count($array)))
                                $row = ceil(count($array));
                            @endphp
                            @for($j = $i*4; $j < $row; $j++)
                               @if($j%3 == 0)
                                    <td class=" not-33">
                                                <div class="justify-content-start d-flex">
                                                    <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> {{$array[$j]->relSubdirection->name_ru}}</b></div>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$array[$j]->getCost()->relUniversity->name_ru}}</p>
                                                </div>
                                                <b>Проходной балл: {{$array[$j]->getCost()->passing_score}}</b>
                                    </td>
                                   @else
                                    <td>
                                            <div class="justify-content-start d-flex">
                                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b>{{$array[$j]->relSubdirection->name_ru}}</b></div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <div class="mr-1"><i class="fas fa-building"></i></div><p>{{$array[$j]->getCost()->relUniversity->name_ru}}</p>
                                            </div>
                                            <b>Проходной балл: {{$array[$j]->getCost()->passing_score}}</b>
                                    </td>
                                   @endif
                                @endfor
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
