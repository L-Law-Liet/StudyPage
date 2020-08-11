@extends('layouts.app')

@section('content')
    <div class="container pt-2">
        <div class="row">
            <div class="col-md-8">
                <h5>{{$ratingName}}</h5>
                @if(substr($class, 1))
                <h4>{{mb_strtoupper(App\Profile::find(substr($class, 1))->name)??''}}</h4>
                @endif
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="text-center">Наименования {{($class[0] == 1)?'ВУЗов':'колледжей'}}</th>
                        <th width="20%;">Город</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($us as $u)

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$u->name_ru}}</td>
                            <td style="">{{$u->relCity->name_ru??''}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><b>Источник:</b> Независимое агентство аккредитации и рейтинга (НААР-2019)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 pl-0">
                <ul class="multi-profile-list">
                @foreach(\App\Profile::all() as $p)
                        <li><a href="{{url('university/list/multiprofile', [$type, $p->id])}}" @if(($class ?? '') == $type.$p->id) class="color-C11800" @endif > @if(($class ?? '') == $type.$p->id) <img src="{{asset('img/arrow-dots-red.svg')}}" alt=""> @else <img src="{{asset('img/arrow-dots-black.svg')}}" alt=""> @endif {{$p->name}} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
