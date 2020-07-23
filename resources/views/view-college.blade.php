@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="studiengangsuche sgs-detail" id="studiengangsuche">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="back-link">
                        <a href="{{url()->previous()}}"><span><img class="mr-2" src="{{asset('img/arrow-left.svg')}}" alt=""></span>Вернуться к результатам поиска</a>
                    </p>
                    <div class="sgs-adress-header">
                        <h2>
                            <div>
                               <span class="sgs-rod"> {{$s->name_ru}} </span>
                            </div>
                            <div>
                                <span class="sgs-rod"> {{$u->name_ru}} </span>
                                <span class="sgs-rod">• {{$u->relCity->name_ru}} </span>
                            </div>
                        </h2>
                    </div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a class="active" data-toggle="tab" href="#overview" role="tab" id="ui-tab-1" tabindex="0" aria-selected="true" aria-controls="overview">Обзор</a>
                        </li>
                        <li role="presentation" class=""><a data-toggle="tab" href="#doc" role="tab" id="ui-tab-2" tabindex="-1" aria-selected="false" aria-controls="doc">Документ</a>
                        </li>
                        <li role="presentation" class=""><a data-toggle="tab" href="#pageCollege" role="tab" id="ui-tab-3" tabindex="-1" aria-selected="false" aria-controls="pageCollege">Страница Колледжа</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade active in" role="tabpanel" tabindex="0" aria-hidden="false" aria-labelledby="ui-tab-1">
                            <h3>Язык обучения</h3>
                            <p> {{\App\Models\Language::where('id', \App\Models\CostEducation::where('specialty_id', $s->id)->where('university_id', $u->id)->first()->language_id)->first()->name_ru}} </p>
                            <h3>Срок обучения</h3>
                            <p> {{$s->education_time}} </p>
                            <h3>{{$f[0]}}</h3>
                            <p> {{$requirement->relDegree->name_ru}} </p>
                            <h3>Стоимость обучения</h3>
                            <p> {{\App\Models\CostEducation::where('specialty_id', $s->id)->where('university_id', $u->id)->first()->price}} тенге / год</p>
                            <h3>{{$f[1]}}</h3>
                            <p> {{$f[2]}} </p>
                            @if($f[3] ?? '')
                                <h3>{{$f[3]}}</h3>
                                <p> {{$f[4]}} </p>
                                @endif
                            <h3>Форма обучения</h3>
                            <p> {{$s->getCost()->education_form}} </p>
                        </div>
                        <div id="doc" class="tab-pane fade" role="tabpanel" tabindex="-1" aria-hidden="true" aria-labelledby="ui-tab-2">
                            @if(is_object($requirement)) {!! $requirement->content_ru !!} @endif
                        </div>
                        <div id="rating" class="tab-pane fade" role="tabpanel" tabindex="-1" aria-hidden="true" aria-labelledby="ui-tab-3">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="sgs-adress">
                        <h3>Контакты</h3>
                        <p><b> {{$u->name_ru}} </b></p>
                        <?=$u->subdivision?>
                        <p> {{$u->address_ru}} </p>
                        <p> {{$u->postcode}} {{$u->relCity->name_ru}} </p>
                        <p>Тел: {{$u->phone}} </p>
                        <p> {{$u->email}} </p>
                        <p> Сайт: {{ltrim($u->web_site, 'Website: ')}} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
