@extends('layouts.app')
@section('content')

    <div class="container pt-2">
        <div class="row">
            <div class="col-8">
                <div id="faq">
                    <h3 class="text-center">{{$faq->question}}</h3>
                    <p class="faq-text text-justify">
                        {{$faq->answer}}
                    </p>
                </div>
            </div>
            <div class="col-md-4 pl-0">
                <ul class="faq-list">
                    @foreach(\App\Models\Faq::all() as $f)
                    <li><a @if($faq->id == $f->id) class="color-C11800" @endif href="{{url('faq', $f->id)}}"> <img @if($faq->id == $f->id) src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >{{$f->question}}</a></li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
