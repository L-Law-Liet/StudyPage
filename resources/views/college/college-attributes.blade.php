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
                    <h4 class="text-center mb-4">{{$header}}</h4>
                    <div class="text-justify">
                        <div class="cv-text">
                            <p>
                               {{$data}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
