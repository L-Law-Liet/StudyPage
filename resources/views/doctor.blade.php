@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="Resp" class="row">

            <div class="col-md-4 left-block">
                <div class="form-group">
                    <label>Степень обучения</label>
                    <select onchange="dopFilter(event)" id="degreeSelect" class="ajax-filter form-control" name="degree">
                        <option value="">Выберите</option>
                        @foreach(\App\Models\Degree::all() as $d)
                            <option @if($d->id == $degree) selected @endif value="{{$d->id}}">{{$d->name_ru}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Область образования</label>
                    <select onchange="dopFilter(event)" id="oblSelect" class="ajax-filter form-control" name="sphere">
                        <option value="">Выберите</option>
                        @foreach($dirs as $s)
                            <option @if($dir_id == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="dir" class="form-group" style="display: none">
                    <label>Направление подготовки</label>
                    <select onchange="dopFilter(event)" id="dirSelect" class="ajax-filter form-control" name="direction">
                        <option value="">Выберите</option>
                        @foreach($subDir as $d)
                            <option value="{{$d->id}}">{{$d->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="grup" class="form-group" style="display: none">
                    <label>Группа образовательных программ</label>
                    <select id="grupSelect" class="ajax-filter form-control" name="programGroup">
                        <option value="">Выберите</option>
                        @foreach($specs as $s)
                            <option value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="income" class="form-group" style="display: none">
                    <label>Поступление в ВУЗ</label>
                    <select onchange="dopFilter(event)" id="incomeSelect" class="ajax-filter form-control" name="when">
                        <option value="">Выберите</option>
                        <option value="after9">После 9 класса</option>
                        <option value="afterSchool">После школы</option>
                    </select>
                </div>
                <div id="1prof" class="form-group" style="display: none">
                    <label>1-й профильный предмет</label>
                    <select id="1profSelect" class="ajax-filter form-control" name="firstSubject">
                        <option value="">Выберите</option>
                        @foreach($sub as $s)
                            <option value="{{$s->id}}">{{$s->name_ru}}</option>
                            @endforeach
                    </select>
                </div>
                <div id="2prof" class="form-group" style="display: none">
                    <label>2-й профильный предмет</label>
                    <select id="2profSelect" class="ajax-filter form-control" name="secondSubject">
                        <option value="">Выберите</option>
                        @foreach($sub as $s)
                            <option value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="sfera" class="form-group" style="display: none">
                    <label>Сфера направления</label>
                    <select id="sferaSelect" class="ajax-filter form-control" name="sphereDirect">
                        <option value="">Выберите</option>
                        @foreach($sp as $s)
                            <option value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Стоимость обучения</label>
                    <div class="d-flex justify-content-between">
                        <input name="startCost" class="ajax-filter form-control w-50 mr-2 p-2 " value="" type="number" placeholder="от">
                        <input name="endCost" class="ajax-filter form-control w-50 ml-3 p-2 " value="" type="number" placeholder="до">
                    </div>
                </div>
                <div id="forma" class="form-group" style="display: none">
                    <label>Форма обучения</label>
                    <select id="formaSelect" class="ajax-filter form-control" name="studyForm">
                        <option value="">Выберите</option>
                        <option value="ochnaya">Очная(дневная)</option>
                        <option value="dist">Дистанционная</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Регион</label>
                    <select class="ajax-filter form-control" name="region">
                        <option @if(!$city_id) selected @endif value="">Выберите</option>
                        @foreach($cs as $c)
                            <option @if($city_id == $c->id) selected @endif value="{{$c->id}}">{{$c->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>ВУЗ</label>
                    <select class="ajax-filter form-control" name="univer">
                        <option @if($university_id?? '') @else selected @endif value="">Выберите</option>
                        @foreach($us as $s)
                            <option @if($university_id?? '' == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Тип учебного заведения</label>
                    <select class="ajax-filter form-control" name="uniType">
                        <option @if($university_id?? '') @else selected @endif value="">Выберите</option>
                        @foreach($ts as $s)
                            <option @if($type_id?? '' == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8 right-block result">
                <div class="sgs-list-header clearfix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <p class="pull-left">Результат: найдено специальностей <span class="count">{{count($costs)}}</span></p>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3">
                                <div class="form-group m-b-0">
                                    <select class="ajax-filter form-control Sgs-sort" id="sortorder" name="sort">
                                        <option @if($sortSelect??'') @else selected @endif value="">Сортировка по</option>
                                        <option @if($sortSelect??'' == 'name') selected @endif value="name">Наименование</option>
                                        <option @if($sortSelect??'' == 'city') selected @endif value="city">Город</option>
                                        <option @if($sortSelect??'' == 'cost') selected @endif value="cost">Стоимость</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="sgs-list-ul">
                        @php
                            $pageSize = 10+$page*10;
                            if ($pageSize > count($costs))
                                $pageSize = count($costs);
                        @endphp
                        @for($i = $page*10; $i < $pageSize; $i++)
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="{{url('/college/view', [$costs[$i]->specialty_id, 'uid', $costs[$i]->university_id])}}">
                                        <strong>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->name_ru}}</strong>
                                        <span>{{\App\Models\University::find($costs[$i]->university_id)->name_ru}}</span> • {{\App\Models\University::find($costs[$i]->university_id)->relCity->name_ru}}
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relDegree->name_ru}}</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>{{($costs[$i]->price)?$costs[$i]->price:'0'}} тг. / год</td>
                                    </tr>
                                    @if($costs[$i]->relSpecialty->degree_id == 2 || $costs[$i]->relSpecialty->degree_id == 3)
                                        <tr>
                                            <td>Сфера направления</td>
                                            <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relSphere->name_ru}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>Поступление в ВУЗ</td>
                                            <td>{{$costs[$i]->income}}</td>
                                        </tr>
                                        <tr>
                                            <td>Профильный предмет</td>
                                            <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relSubject->name_ru}}</td>
                                        </tr>
                                        @endif
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->education_time}}</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>{{$costs[$i]->education_form}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                            @endfor
                    </ul>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="pagination-block m-2 p-2">
                    <div class="row m-1">
                        <div @if($page > 0) onclick="window.location='{{action('PagesController@showDoctor', ['degree' => $degree??'any', 'pages' => ($page-1), 'direction_id' => $dir_id, 'city_id' => $city_id, 'search' => $query])}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img src="{{asset('img/pagination-left.svg')}}" alt=""></div>
                        <div class="col-10 text-center form-group position-relative">
                            <div id="select-div">
                                <select id="pagination-select" class="custom-control-inline border-0 m-0" style="outline: 0" onchange="javascript:location.href = this.value;">
                                    @for($i = 0; $i < ceil(count($costs)/10); $i++)
                                        @if($i == $page)
                                            <option value="{{$i+1}}" selected>{{(1+$page)}} из {{ceil(count($costs)/10)}}</option>
                                        @else
                                            <option class="nPage" value="{{action('PagesController@showDoctor', ['degree' => $degree??'any', 'pages' => $i, 'direction_id' => $dir_id, 'city_id' => $city_id, 'search' => $query])}}">Страница {{$i+1}}</option>
                                        @endif
                                    @endfor
                                </select>
                                {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                            </div>
                        </div>
                        <div @if($page < ceil(count($costs)/10)-1) onclick="window.location='{{action('PagesController@showDoctor', ['degree' =>  $degree??'any', 'pages' => ($page+1), 'direction_id' => $dir_id, 'city_id' => $city_id, 'search' => $query])}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img src="{{asset('img/pagination-right.svg')}}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('body').on('change', '.ajax-filter', function () {
            let arr = [];
            var all = $(".ajax-filter").map(function() {
                arr[$(this).attr('name')] = $(this).val();
            });
            console.log('--------', arr);
            $.ajax({
                type : 'get',
                url : '{{url('/ajax-filter', [$page, $query])}}',
                data : {'a' : JSON.stringify(Object.assign ( {}, arr ))},
                success:function (data) {
                    // console.log('success!--',data);
                    $('#Resp').html(data);
                }
            });
        })
    </script>
@endsection
