@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="studiengangsuche sgs-detail" id="studiengangsuche">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="back-link">
                        <a href=" url()->previous() "><span class="sprites back"></span>Вернуться к результатам поиска</a>
                    </p>
                    <div class="sgs-adress-header">
                        <h2>
                            <div>
                               <span class="sgs-rod"> ИНФОРМАТИКА </span>
                            </div>
                            <div>
                                <span class="sgs-rod"> Казахский национальный университет имени Аль-Фараби </span>
                                <span class="sgs-rod">• АЛМАТЫ </span>
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
                            <p> Казахский / Русский </p>
                            <h3>Срок обучения</h3>
                            <p> 3 года / 6 семестров </p>
                            <h3>Квалификация</h3>
                            <p> Бакалавриат </p>
                            <h3>Стоимость обучения</h3>
                            <p> 350 000 тенге / год</p>
                            <h3>Поступление в колледж</h3>
                            <p> После 9 класса </p>
                            <h3>Форма обучения</h3>
                            <p> Очная (дневная) </p>
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
                        <p><b> Казахский национальный университет имени Аль - Фараби </b></p>
                        <p> Приемная комиссия </p>
                        <p> проспект Аль-Фараби 71 </p>
                        <p> 050040 Алматы </p>
                        <p>Тел: 8(727) 377-33-30, 8(727) 377-33-30 </p>
                        <p> E-mail: info@kaznu.kz </p>
                        <p> Сайт: kaznu.kz </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
