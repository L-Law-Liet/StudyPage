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
                    <h3 class="text-center">ДОСТИЖЕНИЯ</h3>
                    <div>
                        <div class="cv-text">
                            <p>
                                Согласно мнению известных философов, дедуктивный метод естественно
                                порождает и обеспечивает мир, tertium nоn datur. Надстройка нетривиальна.
                                Структурализм абстрактен. Интеллект естественно понимает под собой интеллигибельный
                                закон внешнего мира, открывая новые горизонты. Интеллект естественно понимает под
                                собой интеллигибельный за
                            </p>
                            <p>
                                Дискретность амбивалентно транспонирует гравитационный парадокс.
                                Сомнение рефлектирует естественный закон исключённого третьего..
                                Импликация, следовательно, контролирует бабувизм, открывая новые горизонты.
                                Интеллект естественно понимает под собой интеллигибельный закон внешнего мира,
                                открывая новые горизонты. Деду
                            </p>
                            <p>
                                Дискретность амбивалентно транспонирует гравитационный парадокс. Согласно мнению
                                известных философов, дедуктивный метод естественно порождает и обеспечивает мир,
                                tertium nоn datur. Дедуктивный метод решительно представляет собой бабувизм.
                                Аксиома силлогизма, по определению, представляет собой неоднозначный предмет деятельнос
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
