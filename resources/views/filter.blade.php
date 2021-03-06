        <div class="col-md-4 left-block bold-label-div">
            <div class="form-group">
                <label>Степень обучения</label>
                <select id="degreeSelect" class="ajax-filter chsn form-control" name="degree">
                    <option value="">Выберите</option>
                    @foreach(\App\Models\Degree::all() as $d)
                        <option @if($d->id == $degree) selected @endif value="{{$d->id}}">{{$d->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" @if($degree == 4) style="display: none" @endif>
                <label>Область образования</label>
                <select id="oblSelect" class="ajax-filter chsn form-control" name="sphere">
                    <option @if($a->sphere) selected @endif value="">Выберите</option>
                    @foreach($dirs as $s)
                        <option @if($a->sphere == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" @if($degree != 4) style="display: none" @endif>
                <label>Образовательная программа</label>
                <select id="lpSelect" class="ajax-filter chsn form-control" name="learnProgram">
                    <option value="">Выберите</option>
                    @foreach($specs as $s)
                        <option @if($a->learnProgram == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div id="dir" class="form-group" @if(!$a->sphere) style="display: none" @endif>
                <label>Направление подготовки</label>
                <select id="dirSelect" class="ajax-filter chsn form-control" name="direction">
                    <option value="">Выберите</option>
                    @foreach($subDir as $d)
                        <option @if($a->direction == $d->id) selected @endif value="{{$d->id}}">{{$d->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div id="grup" class="form-group" @if(!$a->direction) style="display: none" @endif>
                <label>Группа образовательных программ</label>
                <select id="grupSelect" class="ajax-filter chsn form-control" name="programGroup">
                    <option value="">Выберите</option>
                    @foreach($specs as $s)
                        <option @if($a->programGroup == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div id="income" class="form-group @if($degree != 1 && $degree != 4) d-none @endif">
                <label>Поступление в @if($degree > 1) Колледж @else ВУЗ @endif</label>
                <select id="incomeSelect" class="ajax-filter chsn form-control" name="when">
                    <option value="">Выберите</option>
                    @if($degree == 1)
                        <option @if($a->when == 'afterCollege') selected @endif value="afterCollege">После колледжа</option>
                        <option @if($a->when == 'afterSchool') selected @endif value="afterSchool">После школы</option>
                        @elseif($degree == 4)
                        <option @if($a->when == 'after9') selected @endif value="after9">После 9 класса</option>
                        <option @if($a->when == 'after11') selected @endif value="after11">После 11 класса</option>
                        @endif
                </select>
            </div>
            <div class="@if($degree == 1 && $a->when) @else d-none @endif">
                <div id="1prof" class="form-group">
                    <label>1-@if($a->when == 'afterSchool')й профильный предмет @elseя проф. дисциплина @endif</label>
                    <select id="1profSelect" class="ajax-filter chsn form-control" name="firstSubject">
                        <option value="">Выберите</option>
                        @foreach($subs as $s)
                            @if($a->secondSubject != $s->id)
                                <option @if($a->firstSubject == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div id="2prof" class="form-group">
                    <label>2-@if($a->when == 'afterSchool')й профильный предмет @elseя проф. дисциплина @endif</label>
                    <select id="2profSelect" class="ajax-filter chsn form-control" name="secondSubject">
                        <option value="">Выберите</option>
                        @foreach($subs as $s)
                            @if($a->firstSubject != $s->id)
                                <option @if($a->secondSubject == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="sfera" class="form-group" @if($degree != 2 && $degree != 3) style="display: none" @endif>
                <label>Сфера направления</label>
                <select id="sferaSelect" class="ajax-filter chsn form-control" name="sphereDirect">
                    <option value="">Выберите</option>
                    @foreach($sp as $s)
                        <option @if($a->sphereDirect == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Стоимость обучения</label>
                <div class="d-flex justify-content-between">
                    <input onkeypress='validate(event)' name="startCost" class="ajax-filter form-control w-50 mr-2 p-2 " value="{{$a->startCost}}" type="number" placeholder="от">
                    <input onkeypress='validate(event)' name="endCost" class="ajax-filter form-control w-50 ml-3 p-2 " value="{{$a->endCost}}" type="number" placeholder="до">
                </div>
            </div>
            <div id="forma" class="form-group">
                <label>Форма обучения</label>
                <select id="formaSelect" class="ajax-filter chsn form-control" name="studyForm">
                    <option value="">Выберите</option>
                    <option @if($studyForm == 1) selected @endif value="1">Очная(дневная)</option>
                    <option @if($studyForm == 2) selected @endif value="2">Дистанционная</option>
                </select>
            </div>
            <div class="form-group">
                <label>Регион</label>
                <select class="ajax-filter chsn form-control" name="region">
                    <option value="">Выберите</option>
                    @foreach($cs as $c)
                        <option @if($city_id == $c->id) selected @endif value="{{$c->id}}">{{$c->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>@if($degree == 4) Колледж @else ВУЗ @endif</label>
                <select class="ajax-filter chsn form-control" name="univer">
                    <option value="">Выберите</option>
                    @foreach($us as $s)
                        <option @if($a->univer == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group @if($degree == 4) d-none @endif">
                <label>Тип учебного заведения</label>
                <select id="uniTypeSelect" class="ajax-filter chsn form-control" name="uniType">
                    <option value="">Выберите</option>
                    @foreach($ts as $s)
                        <option @if($a->uniType == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8 right-block result">
            <div class="sgs-list-header clearfix">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <p class="pull-left">Результат: найдено специальностей <span class="count">{{number_format(count($costs), 0, "", " ")}}</span></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3">
                        <div class="form-group m-b-0">
                            <div class="where-select-sort">
                                <select class="ajax-filter chsn form-control Sgs-sort" id="sortorder" name="sort">
                                    <option hidden="hidden" value="">Сортировка по</option>
                                    <option @if($a->sort == 'popular') selected @endif value="popular">Популярности</option>
                                    <option @if($a->sort == 'asc') selected @endif value="asc">Возрастанию цены</option>
                                    <option @if($a->sort == 'desc') selected @endif value="desc">Убыванию цены</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if(count($costs)>0)
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
                                            <td>@if($degree == 4) Квалификация @else Степень обучения @endif</td>
                                            <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relDegree->name_ru}}</td>
                                        </tr>
                                        <tr>
                                            <td>Стоимость обучения</td>
                                            <td>{{($costs[$i]->price)?number_format($costs[$i]->price, 0, "", " "):'0'}} тг. / год</td>
                                        </tr>
                                        @if($costs[$i]->relSpecialty->degree_id == 2 || $costs[$i]->relSpecialty->degree_id == 3)
                                            <tr>
                                                <td>Сфера направления</td>
                                                <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relSphere->name_ru}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>Поступление в @if($degree == 4)Колледж @elseВУЗ @endif</td>
                                                <td>{{$costs[$i]->income}}</td>
                                            </tr>
                                      @if($costs[$i]->relSpecialty->degree_id == 1)
                                          <tr>
                                              <td>@if($costs[$i]->income == 'После школы') Профильный предмет @elseif($costs[$i]->income == 'После колледжа') Проф. дисциплины @endif</td>
                                              <td>{{\App\Models\Specialty::find($costs[$i]->specialty_id)->relSubject->name_ru}}</td>
                                          </tr>
                                          @endif
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
                    @endif
            </div>
        </div>
        <div class="col-md-4"></div>
        @if(count($costs) > 0)

            <div class="col-md-8 right-block">
                <div class="pagination-block m-2 p-2">
                    <div class="row m-1">
                        <button @if($page > 0) style="cursor:pointer;"  @else disabled @endif name="pageBtn" id="prevPage" value="{{($page-1)}}" class="col-1 d-flex @if($page>0) ajax-filter @endif text-center"><img @if($page > 0) class="Img" @endif src="{{asset('img/pagination-left.svg')}}" alt=""></button>
                        <div class="col-10 text-center form-group position-relative">
                            <div id="select-div">
                                <select id="pagination-select" name="pagSelect" class="custom-control-inline border-0 m-0 ajax-filter" style="outline: 0">
                                    @for($i = 0; $i < ceil(count($costs)/10); $i++)
                                        @if($i == $page)
                                            <option value="" hidden selected>{{(1+$page)}} из {{ceil(count($costs)/10)}}</option>
                                            <option class="font-weight-bold" value="" disabled>Страница {{$i+1}}</option>
                                        @else
                                            <option class="nPage" value="{{$i}}">Страница {{$i+1}}</option>
                                        @endif
                                    @endfor
                                </select>
                                {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                            </div>
                        </div>
                        <button @if($page < ceil(count($costs)/10)-1) style="cursor:pointer;" @else disabled @endif name="pageBtn" id="nextPage" value="{{($page+1)}}" class="col-1 text-center d-flex @if($page < ceil(count($costs)/10)-1) ajax-filter @endif"><img @if($page < ceil(count($costs)/10)-1) class="Img" @endif src="{{asset('img/pagination-right.svg')}}" alt=""></button>
                    </div>
                </div>
            </div>
            @endif
        <script !src="">
            $('.chsn').chosen();
            $(document).ready(function() {
                $('.pagination-block button').mouseover(function () {
                    if(this.id == 'nextPage'){
                        $('img', this).attr('src', "{{asset('img/pagination-right-red.svg')}}");
                    }
                    else {
                        $('img', this).attr('src', "{{asset('img/pagination-left-red.svg')}}");
                    }
                });
                $('.pagination-block button').mouseout(function () {
                    if(this.id == 'nextPage'){
                        $('img', this).attr('src', "{{asset('img/pagination-right.svg')}}");
                    }
                    else {
                        $('img', this).attr('src', "{{asset('img/pagination-left.svg')}}");
                    }
                });

            });
        </script>
