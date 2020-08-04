@extends('layouts.app')
@section('content')

    <div class="container pt-2">
        <div class="d-flex justify-content-between">
            <div class="w-63">
                <div id="faq">
                    <h3 class="text-center">{{$faq->question}}</h3>
                    <p class="faq-text">
                        {{$faq->answer}}
                    </p>
                </div>
            </div>
            <div class="w-37">
                <ul class="faq-list">
                    @foreach(\App\Models\Faq::all() as $f)
                    <li><a @if($faq->id == $f->id) class="color-C11800" @endif href="{{url('faq', $f->id)}}"> <img @if($faq->id == $f->id) src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >{{$f->question}}</a></li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
