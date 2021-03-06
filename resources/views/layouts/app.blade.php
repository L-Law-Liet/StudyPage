<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?

    setlocale(LC_MONETARY,"de_DE");
        $url = $_SERVER['REQUEST_URI'];
        if ($url != '/') {
            $url = preg_replace("/\&search.+/", "", $url);
            $url = preg_replace("/\&page.+/", "", $url);
        }
    ?>
    <? $meta = \App\Models\Meta::where('page', '=', $url)->orWhere('page', '=', $url.'&page=1')->first(); ?>
    <? if (!empty($meta) AND isset($meta)) { ?>
        <title><?=$meta->title?></title>
        <meta name="description" content="<?=$meta->description?>">
        <meta name="keywords" content="<?=$meta->keywords?>">
    <? } else { ?>
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
    <? } ?>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" ></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/slick.min.js') }}" ></script>
    <script src="{{ asset('js/main.js') }}" ></script>
    <script src="{{asset('js/chosen.jquery.min.js')}}"></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}
    @stack('pre-css')
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/chosen.min.css')}}" rel="stylesheet" type="text/css">
@stack('css')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
			(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
				m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

			ym(57544288, "init", {
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true
			});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/57544288" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</head>
<body>
<div id="app">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- На главной странице множество js не работают из-за отсутствия токена -->
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="logos pb-0">
                        <h1>
                            <a href="/">
                                <img src="/img/logo.png">
                            </a>
                            <span class="sr-only"></span>
                        </h1>
                        <span class="sr-only">.</span>
                        {{--<a href="/" class="extra-header-logo" title="Never stop learning">--}}
                            {{--<img src="/img/logo_infos_en.png" id="slogan"></a>--}}
                        <span class="sr-only">.</span>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="social-icons float-right">
                             <div class="d-flex justify-content-between">
                                 <? use App\Models\Social; $social = Social::where('active', 1)->pluck('link', 'name')->all(); ?>
                                 <? foreach ($social as $k => $soc) { ?>
                                 <? if ($k == 'Instagram' OR $k == 'YouTube' OR $k == 'Facebook') { ?>
                                 <?php
                                 if ($k == 'Instagram') {
                                     $class = 'hin';
                                     $n = 'instagram';
                                     $id = 'in';
                                 } else if ($k == 'YouTube') {
                                     $class = 'hyo';
                                     $n = '';
                                     $id = 'yu';
                                 } else if ($k == 'Facebook') {
                                     $class = 'hfb';
                                     $n = 'facebook';
                                     $id = 'fb';
                                 }
                                 ?>
                                 <li><a target="_blank" href="<?=$soc?>" style="border:none; background-size: 26px" id="<?=$id?>" class="<?=$class?>">
                                         @if($id == 'in')
                                             <i style="size: 2.56em" class="fab fa-instagram"></i>
                                             @endif
                                     </a></li>
                                 <? } ?>
                                 <? } ?>
                                 @if(Auth::check())
                                     <li class="log-cab ml-4 mt-1 d-inline-block">
                                                <div class="d-inline mr-3">
                                                    <u><a class="d-inline" id="logged" href="#">Пополнить счет</a></u><b id="balance">{{number_format(Auth::user()->bill, 0, "", " ")}} ед.</b>
                                                </div>

                                                <a id="cabinetDropdown" class="float-right nav-link p-0" href="#" aria-expanded="false"
                                                   role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    <img style="width: 30px; height: 18px" src="/img/login.svg">
                                                    Кабинет
                                                </a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                             @csrf
                                         </form>
                                                <div id="cab-dd-menu" class="dropdown-menu" aria-labelledby="cabinetDropdown">
                                                    <a class="dd-item" href="{{url('cabinet')}}">Личные данные</a>
                                                    <a class="dd-item" href="{{url('change-pwd')}}">Сменить пароль</a>
                                                    <a class="dd-item" href="{{route('logout')}}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выход</a>
                                                </div>
                                     </li>
                                 @else
                                         <li class="log-cab ml-4 mt-1 d-inline-block">
                                             <a id="register" class="float-right" href="#">
                                                 Регистрация
                                             </a>
                                             <span class="border-0 mr-2 float-right color-2D7ABF">/</span>
                                             <img style="width: 30px; height: 18px" src="{{asset('/img/login.svg')}}">
                                             <a id="login" class="float-right" href="#">
                                                 Вход
                                             </a>
                                         </li>
                                 @endif
                             </div>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="header2">
        <div class="header2">
            <div class="container header-container">
                <div><i class="fas fa-users icon-header soc-icon-clicked"></i></div>
                <div><a href="/"><img src="/img/logo.png" class="logo"></a></div>
                <div><i class="fas fa-bars icon-header icon-menu-clicked"></i></div>
            </div>
        </div>
        <div class="slideList slideList-soc-icon">
            <ul>
                <? foreach ($social as $k => $soc) { ?>
                <? if ($k == 'Instagram' OR $k == 'YouTube' OR $k == 'ВКонтакте' OR $k == 'Facebook' OR $k == 'Telegram') { ?>
                    <?php
                    if ($k == 'Instagram') {
                        $n = 'instagram';
                    } else if ($k == 'YouTube') {
                        $n = 'youtube';
                    } else if ($k == 'ВКонтакте') {
                        $n = 'vk';
                    } else if ($k == 'Facebook') {
                        $n = 'facebook-f';
                    } else if ($k == 'Telegram') {
                        $n = 'telegram';
                    }
                    ?>
                        <li><a target="_blank" href="<?=$soc?>"><span class="soc-cyrcle"><i class="fab fa-<?=$n?>"></i></span> <?=$k?></a></li>
                    <? } ?>
                <? } ?>
            </ul>
        </div>
        <div class="slideList slideList-menu">
            <ul>
                <li><a class="bK dC<? if (!empty($_GET['degree_id']) AND $_GET['degree_id'] == 'bakalavriat') { ?> active<? } ?>" href="/poisk?degree_id=bakalavriat&direction_id=any&subdirection_id=any&specialty_id=any&city_id=any&pr1=any&pr2=any&un_id=any&type_id=any&page=1">Бакалавриат</a></li>
                <li><a class="mG dC<? if (!empty($_GET['degree_id']) AND $_GET['degree_id'] == 'magistratura') { ?> active<? } ?>" href="/poisk?degree_id=magistratura&direction_id=any&subdirection_id=any&specialty_id=any&city_id=any&pr1=any&pr2=any&un_id=any&type_id=any&page=1">Магистратура</a></li>
                <li><a class="dK dC<? if (!empty($_GET['degree_id']) AND $_GET['degree_id'] == 'doktorantura') { ?> active<? } ?>" href="/poisk?degree_id=doktorantura&direction_id=any&subdirection_id=any&specialty_id=any&city_id=any&pr1=any&pr2=any&un_id=any&type_id=any&page=1">Докторантура</a></li>
                <li><a href="/list/">Список ВУЗов</a></li>
                <li><a href="/rating/">Рейтинг ВУЗов</a></li>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-unipage {{ isset($is_main) ? 'is_index' : '' }}">
        <div class="container {{ isset($is_main) ? 'is_index' : '' }}">
            <div class="collapse navbar-collapse {{ isset($is_main) ? 'is_index' : '' }}" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav {{ isset($is_main) ? 'is_index' : '' }}">
                    <li class="nav-item">
                        <a id="CollegeActive" class="nav-link dC bK @if(($active ?? '') == 'college')active @endif" href="{{route('doctor', [4, 0])}}">КОЛЛЕДЖИ</a>
                    </li>
                    <li class="nav-item">
                        <a id="UniActive" class="nav-link dC mG  @if(($active ?? '') == 'university')active @endif" href="{{route('doctor', [0, 0])}}">ВУЗЫ</a>
                    </li>
                    <li id="li-nav" class="{{ isset($is_main) ? 'is_index' : '' }} position-relative nav-item">
                    <a id="rating" class="z-index {{ isset($is_main) ? 'is_index' : '' }} nav-link dC dK @if(($active ?? '') == 'rating')active @endif">РЕЙТИНГ</a>
                        <div id="nav-content-rating" class="dropdown-menu {{ isset($is_main) ? 'is_index' : '' }} nav-content">
                            <div id="nav-inner-content-rating" class="m-2 {{ isset($is_main) ? 'is_index' : '' }} ml-4 mr-4 row p-1 nav-content">
                                <div class="col-md-6 p-0 nav-items">
                                    <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                    <a href="{{url('university/list/multiprofile', 2)}}">РЕЙТИНГ КОЛЛЕДЖЕЙ</a>
                                </div>
                                <div class="col-md-6 p-0 nav-items">
                                    <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                    <a href="{{url('university/list/multiprofile', 1)}}">РЕЙТИНГ ВУЗОВ</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link @if(Request::path() == 'calculator') active @endif" href="{{ route('calculator') }}">Калькулятор ЕНТ</a>--}}
                    {{--</li>--}}
                    <li id="li-nav" class="{{ isset($is_main) ? 'is_index' : '' }} position-relative nav-item">
                        <a id="navigator" href="#" class="nav-link {{ isset($is_main) ? 'is_index' : '' }} {{isset($navActive)?'active':''}} z-index">НАВИГАТОР</a>
                            <div id="nav-content" class="dropdown-menu {{ isset($is_main) ? 'is_index' : '' }} nav-content">
                                <div id="nav-inner-content" class="m-2 {{ isset($is_main) ? 'is_index' : '' }} ml-4 mr-4 row nav-content p-1">
                                    <div class="col-md-6 p-0">
                                        <div class="nav-items mb-3">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('list/college')}}">СПИСОК КОЛЛЕДЖЕЙ</a>
                                        </div>
                                        <div class="nav-items">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('list/univer')}}">СПИСОК ВУЗОВ</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">

                                        <div class="nav-items mb-3">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('list/partner')}}">ПАРТНЕРЫ</a>
                                        </div>
                                        <div class="nav-items">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('faq')}}">ВОПРОСЫ И ОТВЕТЫ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  @if(($active ?? '') == 'ent-calc')active @endif" href="{{url('calculator-ent')}}">КАЛЬКУЛЯТОР ЕНТ</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link @if(Request::path() == 'rating') active @endif" href="/rating/">{{ trans('general.rating_he') }}</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </nav>
    @include('map')
    @yield('subnav')
    <main class="mt-3">
        @yield('errors')
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div>
                    <span class="close">&times;</span>
                </div>
                <form action="{{route('payment')}}" method="post">
                    @csrf
                <p>Сумма пополнения</p>
                <div class="dialog-input-div border-bottom p-0 d-flex justify-content-between">
                    <input onkeypress='validate(event)' name="sum" oninput="minZero(event)" class="border-0 w-75" value="0" type="number" id="amountInput" title="Сумма пополнения"><div id="epayCurrency" class="w-25 dialog-valuta pt-2">&#8376;</div>
                </div>
                <div class="d-flex justify-content-between mt-2 mb-2 sums">
                    <div onclick="setCash(event)" id="300" class="w-25 btn btns m-1 text-center p-1">300</div>
                    <div onclick="setCash(event)" id="400" class="w-25 btn btns m-1 text-center p-1">400</div>
                    <div onclick="setCash(event)" id="500" class="w-25 btn btns m-1 text-center p-1">500</div>
                    <div onclick="setCash(event)" id="1000" class="w-25 btn btns m-1 text-center p-1">1000</div>
                </div>
                <div class="dialog-button-div mt-2 pt-1 mb-2">
                    <button class="border-0 p-2">Оплатить</button>
                </div>
                </form>
            </div>

        </div>
        <div id="myLoginModal" class="modal">

            <!-- Modal content -->
                <div class="login-content">
                    <div class="justify-content-center d-flex">
                        <div id="form" class="">
                            <div class="float-right">
                                <img class="loginClose clickable-el" src="{{asset('img/login_form_close.svg')}}" alt="">
                            </div>
                            <div id="login-header" class="text-center m-1">
                                <b>Вход</b>
                            </div>
                            <div class="login-content">
                                <div class="login-form">
                                    <form id="login-form" action="{{route('logging')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="login-form-div">
                                            <label>Электронная почта или телефон</label>
                                            <input required class="@if($errors->first('email') && session('login')) border-danger border @else login-form-input @endif p-1"
                                                   type="text" name="email" @if(session('login')) value="{{old('email')}}" @endif>
                                            <span class="text-danger"><small>@if(session('login')) {{ $errors->first('email')}} @endif</small></span>
                                        </div>
                                        <div class="login-form-div">
                                            <label>Пароль*</label>
                                            <input required class="@if($errors->first('password') && session('login')) border-danger border @else login-form-input @endif p-1" type="password" name="password">
                                            <span class="text-danger"><small>@if(session('login')) {{ $errors->first('password')}} @endif</small></span>
                                        </div>
                                        <div class="login-form-div">
                                            <input class="p-1 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Войти">
                                        </div>
                                    </form>
                                </div>
                                <div id="reg-href" class="text-center mt-1 mb-1">
                                    У Вас не имеется кабинет? <a style="color: #2D7ABF;"  onclick="redirectToReg()" href="#">Регистрация</a>
                                    <a href="#" style="color: #2D7ABF;" onclick="redirectToForgot()">Забыли пароль?</a>
                                </div>
                                <div class="login-form">
                                    <div class="login-form-div mt-2 mb-3 justify-content-between d-flex">
                                        <img src="{{asset('img/login_line.svg')}}" alt=""> Или
                                        <img src="{{asset('img/login_line.svg')}}" alt="">
                                    </div>
                                    <div class="login-form-div">
                                        <button onclick="window.location='{{url('/sign-in/facebook')}}'" id="fb_btn" class="p-1 text-white">
                                            <img class="mr-1 mb-1" src="{{asset('img/fb_logo.svg')}}" alt="">Продолжить с Facebook</button>
                                    </div>
                                    <div class="login-form-div">
                                        <button onclick="window.location='{{url('/sign-in/google')}}'" id="google-btn" class="p-1">
                                            <img class="mr-1" src="{{asset('img/google_logo.svg')}}" alt="">Продолжить с Google</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div id="myRegModal" class="modal">

            <!-- Modal content -->
            <div class="login-content">
                <div class="justify-content-center d-flex">
                    <div id="form" class="">
                        <div class="float-right">
                            <img class="regClose clickable-el" src="{{asset('img/login_form_close.svg')}}" alt="">
                        </div>
                        <div id="login-header" class="text-center m-1">
                            <b>Регистрация</b>
                        </div>
                        <div class="login-content">
                            <div class="login-form">
                                <form id="login-form" action="{{route('register')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="login-form-div">
                                        <label>Фамилия*</label>
                                        <input required class="@if($errors->first('surname') && session('register')) border-danger border @else login-form-input @endif p-1" type="text" name="surname" value="{{old('surname')}}">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('surname')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Имя*</label>
                                        <input required class="@if($errors->first('name') && session('register')) border-danger border @else login-form-input @endif p-1" type="text" name="name" value="{{old('name')}}">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('name')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Дата рождения*</label>
                                        <input required class="@if($errors->first('birthDate') && session('register')) border-danger border @else login-form-input @endif p-1" type="date" min="1920-01-01" max="2020-01-01" name="birthDate" value="{{old('birthDate')}}">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('birthDate')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Пол*</label>
                                        <select required class="@if($errors->first('gender') && session('register')) border-danger border @else login-form-input @endif chsn p-1 w-100" name="gender">
                                            <option @if(old('gender') == 'm') selected @endif value="m">Мужчина</option>
                                            <option @if(old('gender') == 'f') selected @endif value="f">Женщина</option>
                                        </select>
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('gender')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Регион*</label>
                                        <select required class="@if($errors->first('region') && session('register')) border-danger border @else login-form-input @endif chsn p-1 w-100" name="region" value="{{old('region')}}">
                                            @foreach(\App\Models\City::all() as $c)
                                                <option value="{{$c->id}}">{{$c->name_ru}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('region')}} @endif</small></span>
                                    </div>

                                    <div class="login-form-div">
                                        <label>Электронная почта*</label>
                                        <input required class="@if($errors->first('email') && session('register')) border-danger border @else login-form-input @endif p-1"
                                               type="text" name="email" @if(session('register')) value="{{old('email')}}" @endif>
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('email')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Контактный телефон*</label>
                                        <input required onkeypress='validate(event)' onclick="phone1(event)" oninput="phone1(event)" class="@if($errors->first('phone') && session('register')) border-danger border @else login-form-input @endif p-1" maxlength="12" value="+7{{substr(old('phone'), 2)}}" type="tel" name="phone">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('phone')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Пароль*</label>
                                        <input required class="@if($errors->first('password') && session('register')) border-danger border @else login-form-input @endif p-1" type="password" name="password">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('password')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <label>Повторите пароль*</label>
                                        <input required class="@if($errors->first('password_confirmation') && session('register')) border-danger border @else login-form-input @endif p-1" type="password" name="password_confirmation">
                                        <span class="text-danger"><small>@if(session('register')) {{ $errors->first('password_confirmation')}} @endif</small></span>
                                    </div>
                                    <div class="login-form-div">
                                        <input class="p-1 text-white" style="background: linear-gradient(180deg, #336490 0%, #124B7E 100%); border: 0;" type="submit" value="Зарегистрироваться">
                                    </div>
                                </form>
                            </div>
                            <div id="reg-href" class="text-center mt-1 mb-1 policy">
                                Регистрируясь, Вы подтверждаете свое согласие с
                                <a class="color-2D7ABF" href="/article/4"> Пользовательским соглашением</a>,
                                <a class="color-2D7ABF" href="/article/6"> Политикой конфиденциальностью</a>,
                                на обработку персональных данных и на использование файлов "cookie"
                            </div>
                            <div class="login-form">
                                <div id="reg-line" class="mt-2 mb-3 justify-content-start d-flex">
                                    <img src="{{asset('img/reg-line.svg')}}" alt="">
                                </div>
                                <div id="reg-href" class="text-center mt-1 mb-1">
                                    У Вас уже имеется кабинет?
                                    <a onclick="redirectToLogin()" class="color-2D7ABF" href="#">Войти</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myForgotModal" class="modal">

            <!-- Modal content -->
            <div class="login-content">
                <div class="justify-content-center d-flex">
                    <div id="form" class="">
                        <div class="float-right">
                            <img class="forgotClose clickable-el" src="{{asset('img/login_form_close.svg')}}" alt="">
                        </div>
                        <div id="login-header" class="text-center m-1">
                            <b>Восстановление пароля</b>
                        </div>
                        <div class="">
                            <div class="justify-content-center d-flex">
                                <div>
                                    <div class="m-3">
                                        <div class="forgot-passwd-subtitle">
                                            Введите электронную почту или телефон, указанный при регистрации. На указанную Вами
                                            электронную почту или телефон придет письмо со ссылкой для восстановления пароля.
                                        </div>
                                    </div>
                                    <form id="login-form" action="{{route('forgot-password')}}" method="post" class="p-2 m-1">
                                        @csrf
                                        <div class="login-form-div">
                                            <label>Электронная почта или телефон</label>
                                            <input required class="@if($errors->first('email') && session('forgot')) border-danger border @else login-form-input @endif p-1"
                                                   name="email" type="text" @if(session('forgot')) value="{{old('email')}}" @endif>
                                            <span class="text-danger"><small>@if(session('forgot')) @if(session()->get('errors')) @foreach($errors->all() as $e) {{$e}} @endforeach @endif @endif</small></span>
                                        </div>
                                        <div class="clearfix">
                                            <div class="form-group text-center m-1">
                                                <button type="submit" class="btn text-capitalize btn-primary-custom">
                                                    Отправить
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('error')
        @yield('content')
    </main>
    <div class="minimap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="sr-only">main navigation</h2>
                    <ul>
                        <li>
                            <span>Степень</span>
                            <ul>
                                <li class="">
                                    <a href="{{route('doctor', [4, 0])}}">Колледжи</a>
                                </li>
                                <li class="">
                                    <a href="{{route('doctor', [1, 0])}}">Бакалавриат</a>
                                </li>
                                <li>
                                    <a href="{{url('doctor', [2, 0])}}">Магистратура</a>
                                </li>
                                <li>
                                    <a href="{{url('doctor', [3, 0])}}">Докторантура</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Навигатор</span>
                            <ul>
                                <li>
                                    <a href="{{url('university/list/multiprofile', 2)}}">Рейтинг колледжей</a>
                                </li>
                                <li>
                                    <a href="{{url('university/list/multiprofile', 1)}}">Рейтинг ВУЗов</a>
                                </li>
                                <li>
                                    <a href="{{url('list/college')}}">Список колледжей</a>
                                </li>
                                <li>
                                    <a href="{{url('list/univer')}}">Список ВУЗов</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Соглашение</span>
                            <ul>
                                <li>
                                    <a href="/article/5">Колледжам/ВУЗам</a>
                                </li>
                                <li>
                                    <a href="/article/3">Рекламодателям</a>
                                </li>
                                <li>
                                    <a href="/article/4">Пользовательское соглашение</a>
                                </li>
                                <li>
                                    <a href="/article/6">Политика конфедициальности</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Контакты</span>
                            <ul>
                                <li>
                                    <a href="/article/2">О сайте</a>
                                </li>
                                <li>
                                    <a href="/article/1">Добавить колледж/ВУЗ</a>
                                </li>
                                <li>
                                    <a href="{{url('callback')}}">Обратная связь</a>
                                </li>
                                <li>
                                    <a href="{{url('/city/view')}}">ВУЗы в городах Казахстана</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <? $year = Social::findOrFail(7); ?>
            <p class="text-center m-t-35">&copy; StudyPage <?=$year->link?> | Все права защищены</p>
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript" >
                (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                ym(52723207, "init", {
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            </script>
            <noscript><div><img src="https://mc.yandex.ru/watch/52723207" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->

        </div>
    </div>
    <div class="container">
        <a href="#app" id="bottom" class="sprites page-top" title="Back to top" style="display: block;">
            <span class="sr-only">Back to top</span>
        </a>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("logged");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }



    function setCash(event) {
        document.getElementById('amountInput').value = event.target.id;
    }
    function minZero(event) {
        if(event.target.value[0] == 0){
            event.target.value = parseInt(event.target.value);
        }
        if(event.target.value < 0){
            event.target.value = 0;
        }
    }
</script>
<script>
    var loginModal = document.getElementById("myLoginModal");

    // Get the button that opens the modal
    var loginBtn = document.getElementById("login");

    // Get the <span> element that closes the modal
    var loginSpan = document.getElementsByClassName("loginClose")[0];

    // When the user clicks the button, open the modal
    loginBtn.onclick = function() {
        loginModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    loginSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        loginModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        }
    }
</script>
<script>
    var regModal = document.getElementById("myRegModal");

    // Get the button that opens the modal
    var regBtn = document.getElementById("register");

    // Get the <span> element that closes the modal
    var regSpan = document.getElementsByClassName("regClose")[0];

    // When the user clicks the button, open the modal
    regBtn.onclick = function() {
        regModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    regSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        regModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == regModal) {
            regModal.style.display = "none";
        }
    }
</script>
<script>
    var fModal = document.getElementById("myForgotModal");

    // Get the <span> element that closes the modal
    var fSpan = document.getElementsByClassName("forgotClose")[0];

    // When the user clicks on <span> (x), close the modal
    fSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        fModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == fModal) {
            fModal.style.display = "none";
        }
    }
</script>
<script>
    function phone1(event) {
        event.target.value = '+7'+event.target.value.substr(2).replace(/\D/g,'');
        console.log(event.target.value);
    }
</script>
<script !src="">
function redirectToLogin() {
    $('#myRegModal').hide();
    $('#Message').hide();
    $('#myLoginModal').show();
}
function redirectToReg() {
    $('#myLoginModal').hide();
    $('#myRegModal').show();
}
function redirectToForgot() {
    $('#myLoginModal').hide();
    $('#myForgotModal').show();
}
$('.chsn').chosen();
</script>
<script type="text/javascript">
    @if (session()->get('login') && count($errors)> 0)
    $('#myLoginModal').show();
    @php
        session()->forget('login');
    @endphp
    @elseif(session()->get('register') && count($errors)> 0)
    $('#myRegModal').show();
    @php
    session()->forget('register');
    @endphp
    @elseif(session()->get('forgot') && (count($errors)> 0 || session()->get('errors')))
    $('#myForgotModal').show();
    @php
        session()->forget('forgot');
    @endphp
    @endif
</script>
</body>
</html>
