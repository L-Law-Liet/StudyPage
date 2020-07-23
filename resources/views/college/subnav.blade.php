<div class="container">
    <div class="college-view-nav">
        <a href="{{url('/list/'.$name)}}"><img class="mr-2" src="{{asset('img/arrow-left.svg')}}" alt=""><span>Вернуться к списку @if($name == 'univer') ВУЗов @else колледжей @endif /</span></a><span class="color-2D7ABF"> {{$university->name_ru}}</span>
    </div>
</div>
