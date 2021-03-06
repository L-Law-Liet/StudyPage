@extends('layouts.app', ['is_main' => 1])
@section('js')
    <script src="{{asset('js/scripts-min-vendor.js')}}"></script>
    <script src="{{asset('js/scripts-min6b91.js?v2.72.0')}}"></script>
    @endsection
@push('pre-css')
    <link href="//db.onlinewebfonts.com/c/0265b98b68ecf1b3d801b5df4dc155e7?family=icomoon" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/chosen.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/css-min19d0.css?v2.72.2')}}" rel="stylesheet">
    <link href="{{asset('css/print.css')}}" rel="stylesheet" media="print">
@endpush
@section('content')
    <div id="messagError" style="display: {{($message?? '')? 'block' : 'none'}}"
         class="alert alert-info text-center w-50 p-1 rounded-lg position-absolute">
        {{$message ?? ''}}
    </div>
    <div class="main">
        <div class="container">
            <form id="stForm" method="GET" action="/poisk">
                @csrf
                <div class="row main-row">
                    <div class="row main-row-inner">
                        <div class="bg-opacity"></div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-12">

                            <h3 class="text-center font-weight-light m-t-10">Выберите свою специальность</h3>
                            <div class="form-group m-b-0">
                                <input id="si" type="text" name="search" class="form-control" placeholder="Поиск">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group m-b-0">
                                <label class="col-form-label"><i class="fas fa-graduation-cap"></i> Степень</label>
                                <select required="required" id="st" name="degree_id" class="form-control degreec">

                                    <option value="">Выберите</option>
                                    @foreach($degrees as $d)
                                        <option value="{{ $d->id }}">{{ $d->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button id="Zearch" type="submit" hidden></button>
                        <div class="col-4">
                            <div class="form-group m-b-0">
                                <label class="col-form-label"><i class="fas fa-atlas"></i> Форма обучения</label>
                                <select id="dr" name="direction_id" class="form-control directionc">
                                    <option value="0">Выберите</option>
                                    <option value="1">Очная (дневная)</option>
                                    <option value="2">Дистанционная</option>
                                    {{--                                    @foreach($directions as $k => $v)--}}
{{--                                        <option data-url="{{ $v->url }}" value="{{ $v->id }}">{{ $v->name_ru }}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="form-group oG">
                                <p class="m-t-18" style="text-align: right;">Доступно <span class="cc">{{ number_format($cost_count, 0, "", " ") }}</span> специальностей</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group nnA">
                                <label class="col-form-label"><i class="fas fa-globe-americas"></i> Город</label>
                                <select id="ct" name="city_id" class="form-control cityc">
                                    <option value="0">Выберите</option>
                                    @foreach($cities as $k => $v)
                                        <option data-url="{{ $v->url }}" value="{{ $v->id }}">{{ $v->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group oG">
                                <button id="searchButton" class="btn btn-primary-custom float-right goSearch">
                                    {{ trans('general.search') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-12 searchG">
                            <div class="form-group">
                                <label class="col-form-label" style="visibility: hidden;"><i class="fas fa-globe-americas"></i> -</label>
                                <button class="btn btn-primary-custom float-right goSearch">
                                    {{ trans('general.search') }}
                                </button>
                            </div>
                            <div class="form-group">
                                <p class="text-right m-t-18">Доступно <span class="cc">{{ $cost_count }}</span> специальностей</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <p style="color: #2D7ABF;">ПЛАНИРУЕТЕ ПОСТУПИТЬ? СЕРВИСЫ "РЕЙТИНГ", "НАВИГАТОР" И "КАЛЬКУЛЯТОР ЕНТ" КАК РАЗ ДЛЯ ВАС!</p>
            <div>
                <div class="d-flex justify-content-between mb-4">
                    <div onclick="window.location='{{url('calculator-ent')}}'" class="clickable-el d-table" style="width: 552px;
                            height: 234px;
                            background: url({{asset('img/bgCalc.png')}}) no-repeat;">

                            <div class="align-middle d-table-cell text-center text-white text-in-table">КАЛЬКУЛЯТОР ЕНТ</div>
                    </div>
                    <div class="d-table bg-plate" style="width: 388px; height: 234px; background: url('{{asset('img/bgCalc.png')}}') no-repeat;
                            background-size: cover">
                        <div onclick="window.location='{{url('/list/')}}'" class="align-middle justify-content-around text-white text-in-table pt-5">
                            <div class="d-flex flex-column justify-content-around pl-5">
                                <div class="text-start pl-4">РЕЙТИНГ</div>
                                <div class="text-start pl-4"><a class="text-decoration-none text-white fs-18px red-hover" href="{{url('university/list/multiprofile', 2)}}"><img src="{{asset('img/arrow-dots-white.svg')}}" alt="">Рейтинг колледжей</a></div>
                                <div class="text-start pl-4"><a class="text-decoration-none text-white fs-18px red-hover" href="{{url('university/list/multiprofile', 1)}}"><img src="{{asset('img/arrow-dots-white.svg')}}" alt="">Рейтинг ВУЗов</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="clickable-el d-table three-tables bg-plate">
                        <div onclick="window.location='{{url('list/college')}}'" class="align-middle d-table-cell text-center text-white">ИНФОРМАЦИЯ О ВСЕХ КОЛЛЕДЖАХ КАЗАХСТАНА</div>
                    </div>
                    <div onclick="window.location='{{url('list/univer')}}'" class="clickable-el d-table three-tables bg-plate">
                        <div class="align-middle d-table-cell text-center text-white">ИНФОРМАЦИЯ О ВСЕХ ВУЗАХ КАЗАХСТАНА</div>
                    </div>
                    <div onclick="window.location='{{url('faq')}}'" class="clickable-el d-table bg-plate three-tables">
                        <div class="align-middle d-table-cell text-center text-white">ВОПРОСЫ И ОТВЕТЫ</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="Ziti" class="city-teaser teaser teaser-rebrush teaser-with-headline" style="display: none;">
                        <div id="ZitiHeader" class="teaser-headline">
                            <h3 class="color-2D7ABF">ВУЗы в городах Казахстана</h3>
                        </div>
                        <div class="slide-teaser-slider-wrapper">
                            <ul class="row pl-0 m-0 list-unstyled">
                                @foreach($cityslider as $k => $v)
                                    <li class="col-md-6 col-lg-4 post-teaser">
                                        <div class="teaser-inner">
                                            <figure>
                                                <img height="470" width="470" data-lazy="/img/cities/{{$v->image}}">
                                            </figure>
                                            <div class="post-teaser-post-info">
                                                <div class="text">
                                                    <h3><a class="outline-0" href="/city/view/{{ $v->id }}">{{$v->name_ru}}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div id="city" class="cityPc carousel slide" data-ride="carousel">--}}
{{--                <h3>ВУЗы в городах Казахстана</h3>--}}
{{--                <div class="carousel-inner">--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <div class="accordion">--}}
{{--                            <ul>--}}
{{--                                @foreach($cityslider as $k => $v)--}}
{{--                                    @if($k <> 0 && ($k%5) == 0)--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <div class="accordion">--}}
{{--                            <ul>--}}
{{--                                    @endif--}}
{{--                                    <li class="bg-{{$k}}">--}}
{{--                                        <div>--}}
{{--                                            <a href="/city/view/{{ $v->id }}" class="sliderLink">--}}
{{--                                                <h2>{{ $v->name_ru }}</h2>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                <style>--}}
{{--                                    .bg-{{$k}} {--}}
{{--                                        background-image: url("/img/cities/{{$v->image}}");--}}
{{--                                    }--}}
{{--                                </style>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="carousel-control-prev" href="#city" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon"></span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#city" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon"></span>--}}
{{--                </a>--}}
{{--            </div>--}}
            <div id="city2" class="cityMob carousel slide" data-ride="carousel">
                <h3>ВУЗы в городах Казахстана</h3>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="accordion">
                            <ul>
                                @foreach($cityslider as $k => $v)
                                    @if($k <> 0 && ($k%3) == 0)
                            </ul>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="accordion">
                            <ul>
                                @endif
                                <li class="bg-{{$k}}">
                                    <div>
                                        <a href="/city/view/{{ $v->id }}" class="sliderLink">
                                            <h2>{{ $v->name_ru }}</h2>
                                        </a>
                                    </div>
                                </li>
                                <style>
                                    .bg-{{$k}} {
                                        background-image: url("/img/cities/{{$v->image}}");
                                    }
                                </style>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#city2" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#city2" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div class="row partners">
                <div class="col-12">
                    <h3>Партнеры</h3>
                </div>
                <div class="slick-slider">
                    @foreach($partners as $k => $v)
                        <div class="">
                            <a href="{{$v->link}}" target="_blank">
                                <img style="height: 120px" class="m-auto img-fluid" src="{{asset("/img/partners/$v->image")}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script !src="">
        $('.directionc').chosen();
        $('.cityc').chosen();
        $('.degreec').chosen();
    </script>
@endsection
