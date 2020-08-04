        <div class="col-md-4 left-block">
            <div class="form-group">
                <label>Степень обучения</label>
                <select id="degreeSelect" class="ajax-filter chsn form-control" name="degree">
                    @foreach(\App\Models\Degree::all() as $d)
                        <option @if($d->id == $degree) selected @endif value="{{$d->id}}">{{$d->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Область образования</label>
                <select id="oblSelect" class="ajax-filter chsn form-control" name="sphere">
                    <option @if($a->sphere) selected @endif value="">Выберите</option>
                    @foreach($dirs as $s)
                        <option @if($a->sphere == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
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
            <div id="income" class="form-group" @if($degree == 2 || $degree == 3) style="display: none" @endif>
                <label>Поступление в ВУЗ</label>
                <select id="incomeSelect" class="ajax-filter chsn form-control" name="when">
                    <option value="">Выберите</option>
                    <option @if($a->when == 'after9') selected @endif value="after9">После 9 класса</option>
                    <option @if($a->when == 'afterSchool') selected @endif value="afterSchool">После школы</option>
                </select>
            </div>
            <div id="1prof" class="form-group" @if($a->when != 'afterSchool') style="display: none" @endif>
                <label>1-й профильный предмет</label>
                <select id="1profSelect" class="ajax-filter chsn form-control" name="firstSubject">
                    <option value="">Выберите</option>
                    @foreach($subs as $s)
                        @if($a->secondSubject != $s->id)
                            <option @if($a->firstSubject == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div id="2prof" class="form-group" @if($a->when != 'afterSchool') style="display: none" @endif>
                <label>2-й профильный предмет</label>
                <select id="2profSelect" class="ajax-filter chsn form-control" name="secondSubject">
                    <option value="">Выберите</option>
                    @foreach($subs as $s)
                        @if($a->firstSubject != $s->id)
                            <option @if($a->secondSubject == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                        @endif
                    @endforeach
                </select>
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
                    <input name="startCost" class="ajax-filter form-control w-50 mr-2 p-2 " value="{{$a->startCost}}" type="number" placeholder="от">
                    <input name="endCost" class="ajax-filter form-control w-50 ml-3 p-2 " value="{{$a->endCost}}" type="number" placeholder="до">
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
                <label>ВУЗ</label>
                <select class="ajax-filter chsn form-control" name="univer">
                    <option value="">Выберите</option>
                    @foreach($us as $s)
                        <option @if($a->univer == $s->id) selected @endif value="{{$s->id}}">{{$s->name_ru}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Тип учебного заведения</label>
                <select class="ajax-filter chsn form-control" name="uniType">
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
                            <select class="ajax-filter chsn form-control Sgs-sort" id="sortorder" name="sort">
                                <option value="">Сортировка по</option>
                                <option @if($a->sort == 'popular') selected @endif value="name">Популярности</option>
                                <option @if($a->sort == 'asc') selected @endif value="city">Возрастанию цены</option>
                                <option @if($a->sort == 'desc') selected @endif value="cost">Убыванию цены</option>
                            </select>
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
                                            <td>Степень обучения</td>
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
                    @endif
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div class="pagination-block m-2 p-2">
                <div class="row m-1">
                    <div @if($page > 0) style="cursor:pointer;" class="ajax-filter"  @else disabled @endif name="prevPage" value="{{($page-1)}}" class="col-1 text-center"><img @if($page > 0) class="Img" @endif src="{{asset('img/pagination-left.svg')}}" alt=""></div>
                    <div class="col-10 text-center form-group position-relative">
                        <div id="select-div">
                            <select id="pagination-select" name="pagSelect" class="custom-control-inline border-0 m-0 ajax-filter" style="outline: 0">
                                @for($i = 0; $i < ceil(count($costs)/10); $i++)
                                    @if($i == $page)
                                        <option value="" hidden selected>{{(1+$page)}} из {{ceil(count($costs)/10)}}</option>
                                        <option value="" disabled>Страница {{$i+1}}</option>
                                    @else
                                        <option class="nPage" value="{{$i}}">Страница {{$i+1}}</option>
                                    @endif
                                @endfor
                            </select>
                            {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                        </div>
                    </div>
                    <div @if($page < ceil(count($costs)/10)-1) style="cursor:pointer;" class="ajax-filter" @else disabled @endif name="nextPage" value="{{($page+1)}}" class="col-1 text-center"><img @if($page < ceil(count($costs)/10)-1) class="Img" @endif src="{{asset('img/pagination-right.svg')}}" alt=""></div>
                </div>
            </div>
        </div>
