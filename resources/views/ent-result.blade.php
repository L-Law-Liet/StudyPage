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
                        <td onclick="window.location='{{route('result-ent2', [4, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td red-hover w-25 not-33 align-middle clickable-el" rowspan="2">Шансы поступить на платное ({{count($sRes[3])}})</td>
                    </tr>
                    <tr>
                        <td onclick="window.location='{{route('result-ent2', [1, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td red-hover clickable-el">Высокий ({{count($sRes[0])}})</td>
                        <td onclick="window.location='{{route('result-ent2', [2, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td red-hover clickable-el">Средний ({{count($sRes[1])}})</td>
                        <td onclick="window.location='{{route('result-ent2', [3, encrypt($score), encrypt($profs[0]), encrypt($profs[1])])}}'" class="ent-td red-hover clickable-el">Низкий ({{count($sRes[2])}})</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
{{--                    <tr>--}}
{{--                        <td>“Равно” или “больше” проходного балла на грант</td>--}}
{{--                        <td>“Меньше с 1 по 5 баллов” чем Проходной балл ЕНТ на грант (5)</td>--}}
{{--                        <td>“Меньше с 6 по 13 баллов” чем Проходной балл ЕНТ на грант (10)</td>--}}
{{--                        <td class=" not-33">“Меньше с 14 баллов” чем Проходной балл ЕНТ на грант, но не меньше проходного балла на платное</td>--}}
{{--                    </tr>--}}
@for($i = 0; $i < 5; $i++)
                    <tr>
                        <td>
                            @if(count($sRes[0]) > $i)
                                @if($sRes[0][$i]->getCost())
                             <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                 <div>
                                     <b>
                                         <a class="ent-href" href="{{url('/college/view', [$sRes[0][$i]->id, 'uid', $sRes[0][$i]->getCost()->university_id])}}">{{$sRes[0][$i]->relSubdirection->name_ru}}</a>
                                     </b>
                                 </div>
                            </div>
                                <div class="d-flex justify-content-start">
                                    <div class="w-8"><i class="fas fa-building"></i></div>
                                    <p class="mb-0">
                                        <span>
                                        <a class="ent-href" href="{{url('/college/view', [$sRes[0][$i]->getCost()->university_id, 'univer'])}}">{{$sRes[0][$i]->getCost()->relUniversity->name_ru}}</a>
                                        </span>
                                    </p>
                                </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл ЕНТ: {{$sRes[0][$i]->getCost()->passing_score}}</b></div>
                                    </div>
                                    @endif
                                @endif
                        </td>
                        <td>
                            @if(count($sRes[1]) > $i)
                                @if($sRes[1][$i]->getCost())
                              <div class="justify-content-start d-flex">
                                  <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                  <div>
                                      <b>
                                          <a class="ent-href" href="{{url('/college/view', [$sRes[1][$i]->id, 'uid', $sRes[1][$i]->getCost()->university_id])}}">{{$sRes[1][$i]->relSubdirection->name_ru}}</a>
                                      </b>
                                  </div>
                              </div>
                              <div class="d-flex justify-content-start">
                                  <div class="w-8"><i class="fas fa-building"></i></div>
                                  <p class="mb-0">
                                      <span>
                                        <a class="ent-href" href="{{url('/college/view', [$sRes[1][$i]->getCost()->university_id, 'univer'])}}">{{$sRes[1][$i]->getCost()->relUniversity->name_ru}}</a>
                                      </span>
                                  </p>
                              </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл ЕНТ: {{$sRes[1][$i]->getCost()->passing_score}}</b></div>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(count($sRes[2]) > $i)
                                @if($sRes[2][$i]->getCost())
                            <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                <div>
                                    <b><a class="ent-href" href="{{url('/college/view', [$sRes[2][$i]->id, 'uid', $sRes[2][$i]->getCost()->university_id])}}">{{$sRes[2][$i]->relSubdirection->name_ru}}</a></b>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="w-8"><i class="fas fa-building"></i></div>
                                <p class="mb-0">
                                    <span>
                                        <a class="ent-href" href="{{url('/college/view', [$sRes[2][$i]->getCost()->university_id, 'univer'])}}">{{$sRes[2][$i]->getCost()->relUniversity->name_ru}}</a>
                                    </span>
                                </p>
                            </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div>
                                            <b>Проходной балл ЕНТ: {{$sRes[2][$i]->getCost()->passing_score}}</b>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td class=" not-33">
                            @if(count($sRes[3]) > $i)
                                @if($sRes[3][$i]->getCost())
                             <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                 <div>
                                     <b><a class="ent-href" href="{{url('/college/view', [$sRes[3][$i]->id, 'uid', $sRes[3][$i]->getCost()->university_id])}}">{{$sRes[3][$i]->relSubdirection->name_ru}}</a></b>
                                 </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="w-8"><i class="fas fa-building"></i></div>
                                <p class="mb-0">
                                    <span><a class="ent-href" href="{{url('/college/view', [$sRes[3][$i]->getCost()->university_id, 'univer'])}}">{{$sRes[3][$i]->getCost()->relUniversity->name_ru}}</a></span>
                                </p>
                            </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл на платное: {{$sRes[3][$i]->getCost()->passing_score}}</b></div>
                                    </div>
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
    <script>
        $(document).ready(function() {
            $('.ent-href').mouseover(function () {
                console.log($(this).parent().parent().parent());
                $(this).parent().parent().parent().parent().find('.ent-href').css({
                    "color": "#c11800",
                });
            });
            $('.ent-href').mouseout(function () {
                $(this).parent().parent().parent().parent().find('.ent-href').css({
                    "color": "black",
                });
            });
        });
    </script>
@endsection
