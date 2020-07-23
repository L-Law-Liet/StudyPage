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

    @include('college/subnav')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h3 class="text-center">ДОСТИЖЕНИЯ</h3>
                    <div>
                        <div class="cv-text">
                            <p>
                               {{$university->achievements}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
