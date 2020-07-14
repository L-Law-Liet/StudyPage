@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование ВУЗа</th>
                        <th width="20%;">Регион</th>
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
        </div>
    </div>
@endsection
