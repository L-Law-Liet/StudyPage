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
    <div class="container pt-2">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h4 class="text-center mb-4">{{$university->name_ru}}</h4>
                    <div class="text-justify">
                        <div class="d-flex justify-content-between">
                            <div class="w-37">
                                <div class="cv-img-div">
                                    <img src="{{asset('img/'.$university->image)}}" alt="">
                                </div>
                                <div class="under-cv-img-div mb-2">
                                    <p class="m-1"><b>Общежитие: </b>{{($university->dormitory)?'Да':'Нет'}}</p>
                                    <p class="m-1"><b>Военная кафедра: </b>{{($university->military_dep)?'Да':'Нет'}}</p>
                                    <p class="m-1"><b>Веб-сайт: </b><u>{{ltrim($university->web_site, 'Website:')}}</u></p>
                                </div>
                            </div>
                            @php
                            $description = explode(' ', $university->description);
                            $short = [];
                            $line = 60;
                            for ($i = 0; $i < $line; $i++) {
                                $short[] = $description[$i];
                            }
                            $long = [];
                            for ($i = $line; $i < sizeof($description); $i++) {
                                $long[] = $description[$i];
                            }
                            $long = implode(' ', $long);
                            $short = implode(' ', $short);
                            @endphp
                            <div class="w-63 ml-4 pr-0">
                                <p class="cv-text">
                                    {{$short}}
                                </p>
                            </div>
                        </div>
                        <div class="cv-text cv-content">
                            <p>
                             {{$long}}
                            </p>
                        </div>
                        <div class="cv-media media-resources cv-content">
                            ВИДЕО
                            <div class="d-flex justify-content-between position-relative">

                                <div class="slick-slider Autoplay w-100">
                                    @foreach($partners as $k => $v)
                                        <div class="">
                                            <a href="{{$v->link}}" target="_blank">
                                                <img style="width: 120px; height: 120px" class="m-auto img-fluid" src="{{asset("/img/partners/$v->image")}}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="cv-media media-resources cv-content">
                            ГАЛЕРЕЯ
                            <div class="d-flex justify-content-between position-relative">

                                <div class="slick-slider Autoplay w-100">
                                    @foreach($partners as $k => $v)
                                        <div class="">
                                            <a href="{{$v->link}}" target="_blank">
                                                <img style="width: 120px; height: 120px" class="m-auto img-fluid" src="{{asset("/img/partners/$v->image")}}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
    <script !src="">
        $('.Autoplay').slick({
            autoplay: false,
            slidesToShow: 4,
        });
    </script>
@endsection
