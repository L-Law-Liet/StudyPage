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
                        <td>“Меньше с 14 баллов” чем проходной балл на грант, но не меньше проходного балла на платное</td>
                    </tr>
                    @php
                        $pageSize = $page*5+5;
                        if ($pageSize >  count($array)/4)
                            $pageSize = count($array)/4;
                    @endphp
                    @for($i = $page*5; $i < $pageSize; $i++)
                        <tr>
                            @php
                            $row = ($i+1)*4;
                            if ($row > ceil(count($array)))
                                $row = ceil(count($array));
                            @endphp
                            @for($j = $i*4; $j < $row; $j++)
                                    <td>
                                        <div class="justify-content-start d-flex">
                                            <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                            <b>
                                                <a class="ent-href" href="{{url('/college/view', [$array[$j]->id, 'uid', $array[$j]->getCost()->university_id])}}">{{$array[$j]->relSubdirection->name_ru}}</a>
                                            </b>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="w-8"><i class="fas fa-building"></i></div>
                                            <p class="mb-0">
                                                <a class="ent-href" href="{{url('/college/view', [$array[$j]->getCost()->university_id, 'univer'])}}">{{$array[$j]->getCost()->relUniversity->name_ru}}</a>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="w-8"></div>
                                            <div><b>Проходной балл: {{$array[$j]->getCost()->passing_score}}</b></div>
                                        </div>
                                    </td>
                                @endfor
                        </tr>
                        @endfor
                    </tbody>
                </table>

                <div class="pagination-block m-2 p-2">
                    <div class="row m-1">
                        <div @if($page > 0) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), encrypt($profs1), encrypt($profs2), ($page-1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img @if($page > 0) class="Img" @endif src="{{asset('img/pagination-left.svg')}}" alt=""></div>
                        <div class="col-10 text-center form-group position-relative">
                            <div id="select-div">
                                <select id="pagination-select" class="custom-control-inline border-0 m-0 ml-5" style="outline: 0" onchange="javascript:location.href = this.value;">
                                    @for($i = 0; $i < ceil(count($array)/20); $i++)
                                        @if($i == $page)
                                            <option value="" hidden selected>{{(1+$page)}} из {{ceil(count($array)/20)}}</option>
                                            <option value="" disabled>Страница {{$i+1}}</option>
                                        @else
                                            <option class="nPage" value="{{route('result-ent2', [$type, encrypt($score), encrypt($profs1), encrypt($profs2), $i])}}">Страница {{$i+1}}</option>
                                        @endif
                                    @endfor
                                </select>
                                {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                            </div>
                        </div>
                        <div @if($page < ceil(count($array)/20)-1) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), encrypt($profs1), encrypt($profs2), ($page+1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img @if($page < ceil(count($array)/20)-1) class="Img" @endif src="{{asset('img/pagination-right.svg')}}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.ent-href').mouseover(function () {
                console.log($(this).parent().parent().parent());
                $(this).parent().parent().parent().find('.ent-href').css({
                    "color": "#c11800",
                });
            });
            $('.ent-href').mouseout(function () {
                $(this).parent().parent().parent().find('.ent-href').css({
                    "color": "black",
                });
            });
        });
        jQuery(function () {
            jQuery("#pagination-select").change(function () {
                location.href = jQuery(this).val();
            });
        })
    </script>
@endsection
