<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?
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
    @yield('js')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <noscript><div><img src="https://mc.yandex.ru/watch/57544288" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    @yield('css')
</head>
<body oncontextmenu="return false" oncopy="return false;" oncontextmenu="return false" onselectstart="return false;">
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
                                 <li><a target="_blank" href="<?=$soc?>" style="border:none; background-size: 14px" id="<?=$id?>" class="<?=$class?>"></a></li>
                                 <? } ?>
                                 <? } ?>
                                 @if(Auth::check())
                                     <li class="log-cab ml-4 d-inline-block">
                                                <div class="d-inline mr-4">
                                                    <u><a class="d-inline" id="logged" href="#">Пополнить счет</a></u><b id="balance">{{Auth::user()->bill}} ед.</b>
                                                </div>

                                                <a id="cabinetDropdown" class="float-right mt-0 nav-link p-0" href="#" aria-expanded="false"
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
                                         <li class="log-cab ml-4 d-inline-block">
                                             <a id="login" class="float-right mt-0" href="{{url('login')}}">
                                                 <img style="width: 30px; height: 18px" src="/img/login.svg">
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
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-unipage">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dC bK @if(($active ?? '') == 'college')active @endif" href="{{url('college')}}">КОЛЛЕДЖ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dC mG  @if(($active ?? '') == 'university')active @endif" href="{{url('university-school', 0)}}">ВУЗЫ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link dC dK @if(Request::path() == 'list') active @endif" href="/list/">РЕЙТИНГ</a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link @if(Request::path() == 'calculator') active @endif" href="{{ route('calculator') }}">Калькулятор ЕНТ</a>--}}
                    {{--</li>--}}
                    <li id="li-nav" class="nav-item">
                        <a id="navigator" href="#" class="nav-link z-index">НАВИГАТОР</a>
                            <div id="nav-content" class="dropdown-menu nav-content">
                                <div id="nav-inner-content" class="m-2 ml-4 mr-4 d-flex justify-content-between nav-content">
                                    <div class="d-inline-block nav-items">
                                        <img style="margin-bottom: 3px;" src="/img/arrow.svg" alt="->">
                                        <a href="{{url('list/college')}}">СПИСОК КОЛЛЕДЖЕЙ</a>
                                    </div>
                                    <div class="d-inline-block nav-items">
                                        <img style="margin-bottom: 3px;" src="/img/arrow.svg" alt="->">
                                        <a href="{{url('list/univer')}}">СПИСОК ВУЗОВ</a>
                                    </div>
                                    <div class="d-inline-block nav-items">
                                        <img style="margin-bottom: 3px;" src="/img/arrow.svg" alt="->">
                                        <a href="{{url('list/partner')}}">ПАРТНЕРЫ</a>
                                    </div>
                                    <div class="d-inline-block nav-items">
                                        <img style="margin-bottom: 3px;" src="/img/arrow.svg" alt="->">
                                        <a href="{{url('faq/select-profession')}}">ВОПРОСЫ И ОТВЕТЫ</a>
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
    <div id="map" class="container">
        <div class="subnav">
            @php
                $map = isset($map) ? $map : '';
                $map = preg_split("/[,]+/", $map);
                $k = array_search(' Список колледжей ', $map);
            if ($name ?? '' == 'univer' && $k){
                $map[$k] = ' Список ВУЗов ';
            }

                $lastMap = $map[count($map)-1];
                for ($i = 0; $i < count($map)-1; $i++){
                    echo $map[$i];
            @endphp
            <img src="{{asset('img/faq-arrow-right.svg')}}">
            @php
            }
            echo "<span class='subnav-last-child'>$lastMap</span>";
            @endphp
        </div>
    </div>
    @yield('subnav')
    <main class="py-4 mt-5">
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
                    <input name="sum" oninput="minZero(event)" class="border-0 w-75" value="0" type="number" id="amountInput" title="Сумма пополнения"><div class="w-25 dialog-valuta pt-2">&#8376;</div>
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
                                    <a href="{{url('college')}}">Колледж</a>
                                </li>
                                <li class="">
                                    <a href="{{url('university-college', 0)}}">Бакалавриат</a>
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
                                    <a href="{{url('list')}}">Рейтинг</a>
                                </li>
                                <li>
                                    <a href="{{url('list/college')}}">Список колледжей</a>
                                </li>
                                <li>
                                    <a href="{{url('list/univer')}}">Список ВУЗов</a>
                                </li>
                                <li>
                                    <a href="{{url('faq/select-profession')}}">Вопросы и ответы</a>
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
                                    <a href="/article/5">Пользовательское соглашение</a>
                                </li>
                                <li>
                                    <a href="/article/4">Политика конфедициальности</a>
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
                                    <a href="{{url('callback-view')}}">Обратная связь</a>
                                </li>
                                <li>
                                    <a href="{{url('/#city')}}">ВУЗы в городах Казахстана</a>
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
</body>
</html>
