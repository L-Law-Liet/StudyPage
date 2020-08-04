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

    <div class="container pt-2">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h4 class="text-center mb-4">КОНТАКТЫ</h4>
                    <div>
                        <div class="cv-text font-weight-bold text-center mt-3">
                                <p>Адресс: {{$university->address_ru}}</p>
                                <p>{{$university->email}}</p>
                                <p>Телефон: {{$university->phone}}</p>
                                <p>{{$university->web_site}}</p>
                                <p>Почтовый код: {{$university->postcode}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
