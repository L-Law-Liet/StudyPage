@extends('layouts.app')
@section('css')
    <style>
        body {
            font-family: Futura PT, sans-serif;
        }
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div id="college-view-right">
            <div>
                <h3 class="text-center">По результатам теста Ваш балл составляет: <b>95</b></h3>
            </div>
            <div>
                <table id="ent-table">
                    <thead>
                    <tr>
                        <td colspan="3" class="ent-td w-75 p-2" >Шансы поступить на грант</td>
                        <td class="ent-td w-25 not-33" rowspan="2">Шансы поступить на платное (100)</td>
                    </tr>
                    <tr>
                        <td class="ent-td">Высокий (5)</td>
                        <td class="ent-td">Средний (10)</td>
                        <td class="ent-td">Низкий (50)</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
                    <tr>
                        <td>“Равно” или “больше” проходного балла на грант</td>
                        <td>“Меньше с 1 по 5 баллов” чем проходной балл на грант (5)</td>
                        <td>“Меньше с 6 по 13 баллов” чем проходной балл на грант (10)</td>
                        <td class=" not-33">“Меньше с 14 баллов” чем проходной балл на грант, но не меньше проходного балла на платное</td>
                    </tr>
                    <tr>
                        <td>
                             <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Алматинский технологический университет</p>
                            </div>

                            <b>Проходной балл: 100</b>
                        </td>
                        <td>
                             <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Евразийский национальный университет имени Л. Н. Гумилева</p>
                            </div>
                            <b>Проходной балл: 100</b>
                        </td>
                        <td>
                            <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Евразийский национальный университет имени Л. Н. Гумилева</p>
                            </div>
                            <b>Проходной балл: 100</b>
                        </td>
                        <td class=" not-33">
                             <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Евразийский национальный университет имени Л. Н. Гумилева</p>
                            </div>
                            <b>Проходной балл: 75</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" not-33">
                             <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Евразийский национальный университет имени Л. Н. Гумилева</p>
                            </div>
                            <b>Проходной балл: 75</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" not-33">
                             <div class="justify-content-between d-flex">
                                <div class="mr-1"><i class="fas fa-graduation-cap"></i></div><div><b> Подготовка учителей иностранного языка</b></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mr-1"><i class="fas fa-building"></i></div><p>Евразийский национальный университет имени Л. Н. Гумилева</p>
                            </div>
                            <b>Проходной балл: 75</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" not-33"></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
