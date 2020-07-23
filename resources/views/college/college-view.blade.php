@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')
    @include('college/subnav')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h3 class="text-center">{{$university->name_ru}}</h3>
                    <div>
                        <div class="d-flex justify-content-between">
                            <div class="w-37">
                                <div class="cv-img-div">
                                    <img src="{{asset('img/narxoz-img.svg')}}" alt="">
                                </div>
                                <div class="under-cv-img-div mb-2">
                                    <p class="m-1"><b>Общежитие: </b>Да</p>
                                    <p class="m-1"><b>Военная кафедра: </b>Нет</p>
                                    <p class="m-1"><b>Веб-сайт: </b><u>{{ltrim($university->web_site, 'Website:')}}</u></p>
                                </div>
                            </div>
                            <div class="w-63 ml-4 pr-0">
                                <p class="cv-text">
                                    {{$university->short_description}}
                                </p>
                            </div>
                        </div>
                        <div class="cv-text cv-content">
                            <p>
                             {{$university->description}}
                            </p>
                        </div>
                        <div class="cv-media cv-content p-3">
                            ВИДЕО
                            <div class="d-flex justify-content-between position-relative">
                                <div class="position-absolute ml-2"
                                style="top: 33%;">
                                    <img src="{{asset('img/media-arrow-left.svg')}}" alt="">
                                </div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="position-absolute mr-2"
                                     style="top: 33%; right: 0%">
                                    <img src="{{asset('img/media-arrow-right.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="cv-media cv-content p-3">
                            ГАЛЕРЕЯ
                            <div class="d-flex justify-content-between position-relative">
                                <div class="position-absolute ml-2"
                                     style="top: 33%;">
                                    <img src="{{asset('img/media-arrow-left.svg')}}" alt="">
                                </div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="media-div"></div>
                                <div class="position-absolute mr-2"
                                     style="top: 33%; right: 0%">
                                    <img src="{{asset('img/media-arrow-right.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
