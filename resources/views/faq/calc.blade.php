@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
    </style>
    @endsection
@section('content')

    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="w-63">
                <div id="faq">
                    <h3 class="text-center">Калькулятор ЕНТ и можно ли ему верить при поступлении</h3>
                    <p class="faq-text">
                        Каждому молодому человеку приходится сталкиваться с проблемой выбора будущей профессии,
                        выбора жизненного пути. Зачастую мы выбираем этот путь необдуманно, делаем случайный выбор,
                        и затем превращаемся в рабов своей профессии, рутинно выполняя свои обязанности, не испытывая
                        радости от своего труда. Вот такую проблему, проблему выбора профессии, ставит в своём тексте
                        известный драматург и писатель Е. Гришковец.
                    </p>
                    <p class="faq-text">
                        Его герой идёт на день открытых дверей в университет, не имея никакой чёткой позиции:
                        «Мне хотелось быть студентом. Хотелось весёлой интересной жизни, хотелось,
                        чтобы учиться было не скучно». Наверное, с таким желанием надо было бы поступать в какое-то
                        другое учебное заведение, а не в университет. Но герой идёт на биофак, надеясь, что он встретит
                        людей, похожих на Паганеля, учёного из романов Жюля Верна, что ему предложат в будущем экспедиции,
                        научные эксперименты, и его любовь к биологии вспыхнет с новой силой, и это будет его жизненный
                        выбор. К сожалению, всё оказалось совсем не так. Никто не развлекал, не завлекал. Неприветливая
                        дама в белом халате провела абитуриентов по лабораториям, в которых работали студенты, дала
                        программы для поступающих, предложила самостоятельно посетить зоологический музей. Молодой герой
                        Гришковца был озадачен, ведь он не нашёл никого, похожего на Паганеля: «всё было нормально, тихо и
                        деловито». И юноша приходит к решению не поступать на биофак. Автор, описывая душевное состояние
                        своего героя, уделяет внимание тому, как не понравилось юноше отношение преподавателя к абитуриентам,
                        что встреча была холодной, что не было той романтики, на которую настроил себя молодой человек.

                    </p>
                </div>
            </div>
            @include('faq/faq-navbar')
        </div>
    </div>
@endsection
