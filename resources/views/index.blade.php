@extends('layouts.app')
@section('content')
    <div id="messagError" style="display: {{($message?? '')? 'block' : 'none'}}"
         class="alert alert-info text-center w-50 p-1 rounded-lg position-absolute">
        {{$message ?? ''}}
    </div>
    <div class="main">
        <div class="container">
            <form method="GET" action="/poisk">
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
                                <select id="st" name="degree_id" class="form-control degreec">

                                    <option value="0">Выберите</option>
                                    @foreach($degrees as $d)
                                        <option value="{{ $d->id }}">{{ $d->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group m-b-0">
                                <label class="col-form-label"><i class="fas fa-atlas"></i> Форма обучения</label>
                                <select id="dr" name="direction_id" class="form-control directionc">
                                    <option value="0">Выберите</option>
                                    @foreach($directions as $k => $v)
                                        <option data-url="{{ $v->url }}" value="{{ $v->id }}">{{ $v->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group oG">
                                <p class="m-t-18" style="text-align: right;">Доступно <span class="cc">{{ $cost_count }}</span> специальностей</p>
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
                                <button class="btn btn-primary-custom float-right goSearch">
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
            <p style="color: #2D7ABF;">ПЛАНИРУЕТЕ ПОСТУПИТЬ? СЕРВИСЫ “РЕЙТИНГ” И/ИЛИ “КАЛЬКУЛЯТОР ЕНТ” КАК РАЗ ДЛЯ ВАС!</p>
            <div>
                <div class="d-flex justify-content-between mb-4">
                    <div onclick="window.location='{{url('calculator-ent')}}'" class="clickable-el d-table" style="width: 552px;
                            height: 234px;
                            background: url({{asset('img/bgCalc.png')}}) no-repeat;">

                            <div class="align-middle d-table-cell text-center text-white text-in-table">КАЛЬКУЛЯТОР ЕНТ</div>
                    </div>
                    <div class="clickable-el d-table" style="width: 388px; height: 234px; background: #124B7E;">
                        <div onclick="window.location='{{url('/list/')}}'" class="align-middle d-table-cell text-center text-white text-in-table">РЕЙТИНГ</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <div class="clickable-el d-table three-tables">
                        <div onclick="window.location='{{url('list/college')}}'" class="align-middle d-table-cell text-center text-white">ИНФОРМАЦИЯ О ВСЕХ КОЛЛЕДЖАХ КАЗАХСТАНА</div>
                    </div>
                    <div onclick="window.location='{{url('list/univer')}}'" class="clickable-el d-table three-tables">
                        <div class="align-middle d-table-cell text-center text-white">ИНФОРМАЦИЯ О ВСЕХ ВУЗАХ КАЗАХСТАНА</div>
                    </div>
                    <div onclick="window.location='{{url('faq/select-profession')}}'" class="clickable-el d-table three-tables">
                        <div class="align-middle d-table-cell text-center text-white">ВОПРОСЫ И ОТВЕТЫ</div>
                    </div>
                </div>
            </div>
            <div id="city" class="cityPc carousel slide" data-ride="carousel">
                <h3>ВУЗы в городах Казахстана</h3>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="accordion">
                            <ul>
                                @foreach($cityslider as $k => $v)
                                    @if($k <> 0 && ($k%6) == 0)
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
                <a class="carousel-control-prev" href="#city" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#city" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
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
                        <div>
                            <a href="{{$v->link}}" target="_blank">
                                <img class="img-fluid" src="{{asset("/img/partners/$v->image")}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <link href="{{asset('css/chosen.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script>
        setTimeout(fade_out, 6000);
        function fade_out() {
            $("#messagError").fadeOut().empty();
        }
        $('.directionc').chosen();
        $('.cityc').chosen();
        $('.degreec').chosen();
    </script>
@endsection
