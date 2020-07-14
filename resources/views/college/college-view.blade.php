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
@section('subnav')
    <div class="container">
        <div class="college-view-nav">
            <a href="{{url()->previous()}}"><img class="mr-2" src="{{asset('img/arrow-left.svg')}}" alt=""><span>Вернуться к списку колледжей /</span></a><span class="color-2D7ABF"> Университет Нархоз</span>
        </div>
    </div>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h3 class="text-center">УНИВЕРСИТЕТ НАРХОЗ</h3>
                    <div>
                        <div class="d-flex justify-content-between">
                            <div class="w-37">
                                <div class="cv-img-div">
                                    <img src="{{asset('img/narxoz-img.svg')}}" alt="">
                                </div>
                                <div class="under-cv-img-div mb-2">
                                    <p class="m-1"><b>Общежитие: </b>Да</p>
                                    <p class="m-1"><b>Военная кафедра: </b>Нет</p>
                                    <p class="m-1"><b>Веб-сайт: </b><u>narxoz.kz</u></p>
                                </div>
                            </div>
                            <div class="w-63 ml-4 pr-0">
                                <p class="cv-text">
                                    Университет Нархоз был основан в 1963 году, в эпоху грандиозных планов,
                                    масштабных реформ и больших достижений. Следуя духу времени, прогресс университета
                                    был стремительным — от основания до всесоюзного признания прошло лишь несколько
                                    лет. В истории становления Нархоза прослеживается весь процесс зарождения и
                                    развития системы высшего экономического образования Казахстана. Университет стал
                                    alma mater для нескольких поколений успешных экономистов, финансистов, менеджеров
                                    и бизнесменов.
                                </p>
                            </div>
                        </div>
                        <div class="cv-text cv-content">
                            <p>
                                В новом тысячелетии у Нархоза началась новая жизнь В 2002 г. наш Университет прошел
                                через процедуру акционирования и одним из первых казахстанских вузов принял на
                                вооружение инструмент стратегического планирования. Новый подход к управлению
                                обусловлен необходимостью быстрой и гибкой адаптации к постоянно меняющимся
                                запросам рынка и оперативной реакции на вызовы окружающей среды.
                            </p>
                            <p>
                                Жизнь университета многогранна, разнообразна и интересна, и чтобы поддерживать
                                с вами связь, нам нужна эффективная форма коммуникации, которая поможет в вопросах
                                поступления, обучения, партнерства.
                            </p>
                            <p>
                                Блог ректора - это наиболее эффективная и оперативная форма
                                общения и именно здесь вы получите ответы на ваши вопросы.
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
