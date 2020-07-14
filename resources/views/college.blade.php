@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4 left-block">
                <div class="form-group">
                    <label>Образовательная программа</label>
                    <select class="form-control" name="program">
                        <option value="matem">Математика</option>
                        <option value="cs">Информатика</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Поступление в колледж</label>
                    <select class="form-control" name="when">
                        <option value="after9">После 9 класса</option>
                        <option value="afterSchool">После школы</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Форма обучения</label>
                    <select class="form-control" name="studyForm">
                        <option value="ochnaya">Очная(дневная)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Стоимость обучения</label>
                    <div class="d-flex justify-content-between">
                        <input class="form-control w-50 mr-2 p-2 " type="text" placeholder="от">
                        <input class="form-control w-50 ml-3 p-2 " type="text" placeholder="до">
                    </div>
                </div>

                <div class="form-group">
                    <label>Регион</label>
                    <select class="form-control" name="region">
                        <option value="almaty">Алматы</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Колледж</label>
                    <select class="form-control" name="college">
                        <option value="narhoz">Университет Нархоз</option>
                    </select>
                </div>
            </div>

            <div class="col-md-8 right-block result">
                <div class="sgs-list-header clearfix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <p class="pull-left">Результат: найдено специальностей <span class="count">10</span></p>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3">
                            <form class="form-horizontal sgs-list-sort" role="form">
                                <div class="form-group m-b-0">
                                    <select class="form-control sgs-sort" id="sortorder" name="sort">
                                        <option selected disabled value="default">Сортировка по</option>
                                        <option value="name">Наименование</option>
                                        <option value="town">Город</option>
                                        <option value="cost">Стоимость</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="sgs-list-ul">

                        <li>
                                <div style="margin-bottom: 30px;">
                                    <h3>
                                        <a href="{{url('/college/view/1')}}">
                                            <strong>Информатика</strong>
                                            <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                        </a>
                                    </h3>
                                    <table>
                                        <tbody class="main-table">
                                        <tr>
                                            <td>Квалификация</td>
                                            <td>Бакалавриат</td>
                                        </tr>
                                        <tr>
                                            <td>Стоимость обучения</td>
                                            <td>700 000 тг. / год</td>
                                        </tr>

                                        <tr>
                                            <td>Поступление в колледж</td>
                                            <td>После 9 класса</td>
                                        </tr>
                                        <tr>
                                            <td>Срок обучения</td>
                                            <td>3 года / 6 семестров</td>
                                        </tr>
                                        <tr>
                                            <td>Форма обучения</td>
                                            <td>Очная (дневная)</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="{{url('/college/view/1')}}">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="{{url('/college/view/1')}}">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="{{url('/college/view/1')}}">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="{{url('/college/view/1')}}">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="/poisk/view/">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="/poisk/view/">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="/poisk/view/">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="/poisk/view/">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <div style="margin-bottom: 30px;">
                                <h3>
                                    <a href="/poisk/view/">
                                        <strong>Информатика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Квалификация</td>
                                        <td>Магистратура</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>550 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в колледж</td>
                                        <td>После 11 класса</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>1 год / 2 семестра</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Дистанционная</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="pagination-block m-2 p-2">
                    <div class="row m-1">
                        <div class="col-1 text-center"><img src="img/pagination-left.svg" alt=""></div>
                        <div class="col-10 text-center">1 из 150 <img class="ml-1" src="img/pagination-down.svg" alt=""></div>
                        <div class="col-1 text-center"><img src="img/pagination-right.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
