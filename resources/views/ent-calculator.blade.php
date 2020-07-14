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

    <div class="container">
                <div id="college-view-right">
                    <div>
                        <h3 class="text-center">КАЛЬКУЛЯТОР ЕНТ: УЗНАЙТЕ КАКИЕ У ВАС ШАНСЫ ПОСТУПИТЬ</h3>
                        <p class="text-center ent-subtitle m-2">
                            Укажите предметы и баллы ЕНТ и узнайте на какие группы образовательных программ
                            ВУЗов Ваши шансы поступить выше. Если баллы каких-то предметов не известны,
                            попробуйте смоделировать их.
                        </p>
                    </div>
                    <form action="{{action('PagesController@entResult')}}" method="get">
                        <div class="row mt-5">
                            <div class="row col-6">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="form-control sgs-sort sortorder">
                                            <option selected="" disabled="" value="default">Выберите язык обучения</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control sgs-sort sortorder" name="sort">
                                            <option selected="" disabled="" value="default">1-й профильный предмет</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control sgs-sort sortorder" name="sort">
                                            <option selected="" disabled="" value="default">2-й профильный предмет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control sgs-sort" name="sort">
                                            <option selected="" disabled="" value="default">Балл</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control sgs-sort" name="sort">
                                            <option selected="" disabled="" value="default">Балл</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group d-flex justify-content-between">
                                    <label class="w-50">Математическая грамотность</label>
                                    <select class="form-control sgs-sort w-50" name="mat-g">
                                        <option selected="" disabled="" value="default">Балл</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label class="50">Грамотность чтения</label>
                                    <select class="form-control sgs-sort w-50" name="read-g">
                                        <option selected="" disabled="" value="default">Балл</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label class="w-50">История Казахстана</label>
                                    <select class="form-control sgs-sort w-50" name="h-kz">
                                        <option selected="" disabled="" value="default">Балл</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-5">
                            <button type="submit" class="know-chance p-3">Узнать шансы (50 ед.)</button>
                        </div>
                    </form>
                </div>
    </div>
@endsection
