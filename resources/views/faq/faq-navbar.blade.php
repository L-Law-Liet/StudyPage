<div class="w-37">
    <ul class="faq-list">
        <li><a @if($active == 'select-prof') class="color-C11800" @endif href="{{url('faq/select-profession')}}"> <img @if($active == 'select-prof') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Выбор профессии</a></li>
        <li><a @if($active == 'good') class="color-C11800" @endif href="{{url('faq/good')}}"> <img @if($active == 'good') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Признаки хорошего ВУЗа</a></li>
        <li><a @if($active == 'future') class="color-C11800" @endif href="{{url('faq/future')}}"> <img @if($active == 'future') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Предметы определяющие будущую профессию</a></li>
        <li><a @if($active == 'open-door') class="color-C11800" @endif href="{{url('faq/open-door')}}"> <img @if($active == 'open-door') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Вещи, которые нужно знать перед днем открытых дверей</a></li>
        <li><a @if($active == 'college') class="color-C11800" @endif href="{{url('faq/college')}}"> <img @if($active == 'college') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Поступление в колледж</a></li>
        <li><a @if($active == 'univer') class="color-C11800" @endif href="{{url('faq/univer')}}"> <img @if($active == 'univer') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Поступление в ВУЗ</a></li>
        <li><a @if($active == 'calc') class="color-C11800" @endif href="{{url('faq/calc')}}"> <img @if($active == 'calc') src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >Калькулятор ЕНТ и можно ли ему верить при поступлении</a></li>
    </ul>
</div>
