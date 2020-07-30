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
    @if(session('m'))

        <div id="Message" class="message">

            <!-- Modal content -->
            <div class="modal-content">
                <div>
                    <span class="close1">&times;</span>
                </div>
                <p class="text-center">{{session('m')}}</p>

                <div class="dialog-button-div mt-2 pt-1 mb-2">
                    <button id="logged1" class="border-0 p-2">Пополнить счет</button>
                </div>
            </div>

        </div>
        @elseif(session('m1'))
        <div id="Message" class="message">

            <!-- Modal content -->
            <div class="modal-content">
                <div>
                    <span class="close1">&times;</span>
                </div>
                <h5 class="text-center m-3">{{session('m1')}}</h5>

                <div class="dialog-button-div m-4">
                    <button onclick="redirectToLogin()" class="border-0 p-2">Войти</button>
                </div>
            </div>

        </div>

        @endif
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
                    <form action="{{action('PagesController@entResult')}}" method="post">
                        @csrf
                        <div class="row mt-5">
                            <div class="row col-6">
                                <div class="col-6">
                                    <label>Выберите язык обучения</label>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select required class="form-control chsn" name="lang">
                                            <option value="">Выберите</option>
                                            <option value="1">Казахский</option>
                                            <option value="2">Русский</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select required class="form-control sgs-sort sortorder chsn" name="1profSelect">
                                            <option value="">1-й профильный предмет</option>
                                            @foreach($ss as $s)
                                                <option value="{{$s->id}}">{{$s->name_ru}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="ent-calc-2prof" required class="form-control sgs-sort sortorder chsn" name="2profSelect">
                                            <option value="">2-й профильный предмет</option>
                                            @foreach($ss as $s)
                                                <option value="{{$s->id}}">{{$s->name_ru}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input onkeypress='validate(event)' required oninput="max40(event)" class="form-control sgs-sort" placeholder="Балл" type="number" max="40" min="0" name="1profPoint">
                                    </div>
                                    <div class="form-group">
                                        <input onkeypress='validate(event)' required oninput="max40(event)" class="form-control sgs-sort" placeholder="Балл" type="number" max="40" min="0" name="2profPoint">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group d-flex justify-content-between">
                                    <label class="w-50">Математическая грамотность</label>

                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="matGr" id="matGr">
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label class="50">Грамотность чтения</label>

                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="readGr">
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label class="w-50">История Казахстана</label>
                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="historyKZ">
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-5">
                            <input type="text" hidden name="access" value="1">
                            <button type="submit" class="know-chance p-3">Узнать шансы (50 ед.)</button>
                        </div>
                    </form>
                </div>
    </div>
    <script>

        function max20(event) {
            if(event.target.value > 20){
                event.target.value = 20;
            }
            if(event.target.value < 0){
                event.target.value = 0;
            }
        }
        function max40(event) {
            if(event.target.value > 40){
                event.target.value = 40;
            }
            if(event.target.value < 0){
                event.target.value = 0;
            }
        }
        // Get the modal
        var modal1 = document.getElementById("Message");

        // Get the <span> element that closes the modal
        var span1 = document.getElementsByClassName("close1")[0];

        // When the user clicks on <span> (x), close the modal
        span1.onclick = function() {
            modal1.style.display = "none";
        }
        $('#logged1').on('click', function () {
            modal1.style.display = "none";
            $('#logged').click();
        });

        setTimeout(fade_out, 3500);
        function fade_out() {
            $("#messagError").fadeOut().empty();
        }
    </script>
@endsection
