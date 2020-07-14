@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование ВУЗа</th>
                        <th width="20%;">Город</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 1; $i < 8; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Казахский национальный университет имени аль-Фараби</td>
                            <td style="">Алматы</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="3"><b>Источник:</b> Независимое агентство аккредитации и рейтинга (НААР-2019)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <ul class="multi-profile-list">
                    <li><a href="#">Рейтинг ВУЗов - 2019</a></li>
                    <li><a href="#">Многопрофильный</a></li>
                    <li><a href="#">Педагогический</a></li>
                    <li><a href="#">Технический</a></li>
                    <li><a href="#">Гуманитарно - экономический</a></li>
                    <li><a href="#">Медицинский</a></li>
                    <li><a href="#">Искусство</a></li>
                    <li><a href="#">Рейтинг колледжей - 2019</a></li>
                    <li><a href="#">Многопрофильный</a></li>
                    <li><a href="#">Педагогический</a></li>
                    <li><a href="#">Технический</a></li>
                    <li><a href="#">Гуманитарно - экономический</a></li>
                    <li><a href="#">Аграрно - технический</a></li>
                    <li><a href="#">Медицинский</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
