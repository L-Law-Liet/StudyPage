@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4 left-block">
                <div class="form-group">
                    <label>Степень обучения</label>
                    <select class="form-control" name="degree">
                        <option value="default">Выберите</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Область образовани</label>
                    <select class="form-control" name="sphere">
                        <option value="default">Выберите</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Направление подготовки</label>
                    <select class="form-control" name="direction">
                        <option value="default">Выберите</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Группа образовательных программ</label>
                    <select class="form-control" name="programGroup">
                        <option value="default">Выберите</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Поступление в ВУЗ</label>
                    <select class="form-control" name="when">
                        <option value="after9">После 9 класса</option>
                        <option value="afterSchool">После колледжа</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>1-й профильный предмет</label>
                    <select class="form-control" name="firstSubject">
                        <option value="default">Выберите</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>2-й профильный предмет</label>
                    <select class="form-control" name="secondSubject">
                        <option value="default">Выберите</option>
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
                    <label>Форма обучения</label>
                    <select class="form-control" name="studyForm">
                        <option value="ochnaya">Очная(дневная)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Регион</label>
                    <select class="form-control" name="region">
                        <option value="almaty">Алматы</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ВУЗ</label>
                    <select class="form-control" name="univer">
                        <option value="default">Выберите</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Тип учебного заведения</label>
                    <select class="form-control" name="uniType">
                        <option value="default">Выберите</option>
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
                                    <a href="/poisk/view/">
                                        <strong>Математика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>Бакалавриат</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>700 000 тг. / год</td>
                                    </tr>
                                    <tr>
                                        <td>Поступление в ВУЗ</td>
                                        <td>После колледжа</td>
                                    </tr>
                                    <tr>
                                        <td>Профильный предмет</td>
                                        <td>Математика, Физика</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>4 года / 8 семестров</td>
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
                                    <a href="/poisk/view/">
                                        <strong>Математика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>Бакалавриат</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>700 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в ВУЗ</td>
                                        <td>После колледжа</td>
                                    </tr>
                                    <tr>
                                        <td>Профильный предмет</td>
                                        <td>Математика, Физика</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>4 года / 8 семестров</td>
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
                                    <a href="/poisk/view/">
                                        <strong>Математика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>Бакалавриат</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>700 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в ВУЗ</td>
                                        <td>После колледжа</td>
                                    </tr>
                                    <tr>
                                        <td>Профильный предмет</td>
                                        <td>Математика, Физика</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>4 года / 8 семестров</td>
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
                                    <a href="/poisk/view/">
                                        <strong>Математика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>Бакалавриат</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>700 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в ВУЗ</td>
                                        <td>После колледжа</td>
                                    </tr>
                                    <tr>
                                        <td>Профильный предмет</td>
                                        <td>Математика, Физика</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>4 года / 8 семестров</td>
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
                                    <a href="/poisk/view/">
                                        <strong>Математика</strong>
                                        <span>Казахский национальный университет имени Аль-Фараби</span> • Алматы
                                    </a>
                                </h3>
                                <table>
                                    <tbody class="main-table">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>Бакалавриат</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>700 000 тг. / год</td>
                                    </tr>

                                    <tr>
                                        <td>Поступление в ВУЗ</td>
                                        <td>После колледжа</td>
                                    </tr>
                                    <tr>
                                        <td>Профильный предмет</td>
                                        <td>Математика, Физика</td>
                                    </tr>
                                    <tr>
                                        <td>Срок обучения</td>
                                        <td>4 года / 8 семестров</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>Очная (дневная)</td>
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
