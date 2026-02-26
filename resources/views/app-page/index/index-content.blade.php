@extends('/index')
@section('content')
    <section class="main-content">
        <section class="main-content-top">
            <div class="slider position-row-2">
                <ul class="slider-list">
                    <li class="slider-item slider-flick slider-opacity">
                        <div class="slider-content">
                            <img class="item-img" src="{{asset('img/slider/1.jpg')}}" alt="Fadvis">
                            <div class="filter color-black">
                                <div class="filter-box for-slider">
                                    <div class="wrap-filter-article">
                                        <article class="filter-article top-article">
                                            Функционально
                                        </article>
                                        <div class="bottom-article bottom-article">
                                            <article class="filter-article-content">
                                                Быстросъемное соединение позволяет сменить косметическую кисть на функциональные насадки за несколько секунд
                                            </article>
                                            <article class="filter-article-content">
                                                и наслаждаться плаванием, отжиманием, силовыми упражнениями со штангой и гантелями, ездой на велосипеде, творчеством и многим, многим другим
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="slider-item slider-flick">
                        <div class="slider-content">
                            <img class="item-img" src="{{asset('img/slider/2.jpg')}}" alt="Fadvis">
                            <div class="filter color-black">
                                <div class="filter-box for-slider position-top">
                                    <div class="wrap-filter-article">
                                        <div class="filter-article bottom-article">
                                            <article class="filter-article-content">
                                                Полуфабрикаты для изготовления протеза кисти при отсутствии одного или нескольких пальцев.
                                            </article>
                                            <article class="filter-article-content">
                                                Обеспечивают схват в трёхпальцевую щепоть.
                                            </article>
                                        </div>
                                        <article class="filter-article top-article">
                                            Индивидуально
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="slider-item slider-flick">
                        <div class="slider-content">
                            <img class="item-img" src="{{asset('img/slider/3.jpg')}}" alt="Fadvis">
                            <div class="filter color-black">
                                <div class="filter-box for-slider">
                                    <div class="wrap-filter-article">
                                        <article class="filter-article top-article">
                                            Надежно
                                        </article>
                                        <div class="filter-article bottom-article">
                                            <article class="filter-article-content">
                                                Если Вам необходимо что-то схватить, удержать, перенести, не используя здоровую руку
                                            </article>
                                            <article class="filter-article-content">
                                                Для этого достаточно заменить функциональную пассивную насадку на активную тяговую.
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="video-box">
                <div class="wrap-video-box">
                    <iframe class="video"
                            src="https://rutube.ru/play/embed/eebd1243c969e83ff3b627ca299136d6"
                            style="border: none;"
                            allow="clipboard-write; autoplay"
                            allowFullScreen
                    ></iframe>
                </div>
            </div>

            <div class="slogan-box">
                <ul class="slogan-list">
                    <li class="slogan-item">
                        <a class="info-link" href="{{route('show.prothesis.form')}}">
                            <article class="info-link-title">Запросить протез</article>
                            <article class="info-link-content">
                                Вам нужен протез, свяжитесь с нами.
                                Мы проконсультируем Вас, и поможем подобрать лучшие варианты.
                            </article>
                        </a>
                    </li>
                    <li class="slogan-item">
                        <a class="info-link" href="{{route('show.price.form')}}">
                            <article class="info-link-title">Запросить прайс</article>
                            <article class="info-link-content">
                                Вы протезист? Напишите нам.
                                Мы предоставим всю необходимую информацию и наши решения для успешной работы.
                            </article>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="slogan-box-bottom">
                <ul class="slogan-list">
                    <li class="slogan-item">
                        <ul class="slogan-content-list">
                            <li class="slogan-content-item">
                                Может ли косметическая кисть приносить пользу? Мы решили, что она обязана!
                            </li>
                            <li class="slogan-content-item">
                                Быстросъёмная - <span class="bold">для удобства надевания одежды</span>.
                            </li>
                            <li class="slogan-content-item">
                                Гибкое запястье, чтобы было нескучно и <span class="bold">стильно</span>, а вариант с магнитом, еще и
                                <span class="bold">функционально</span>.
                            </li>
                            <li class="slogan-content-item">
                                Индивидуальные цветовые схемы, чтобы - <span class="bold">на вкус и цвет сам себе товарищ</span>.
                            </li>
                            <li class="slogan-content-item">
                                <span class="bold">Кибер-дизайн</span> - для любителей новых знакомств и ощущений.
                            </li>
                        </ul>
                    </li>
                    <li class="slogan-item">
                        <ul class="slogan-content-list">
                            <li class="slogan-content-item">
                                Наибольшее удоство применения создают быстроразъемное запястье "на борту" протеза и адаптеры "на борту" каждой насадки.
                            </li>
                            <li class="slogan-content-item">
                                Мы предлагаем две серии запястьев и, соответственно, адаптеров: ЭКСЦ и АЛЬФА.
                            </li>
                            <li class="slogan-content-item">
                                <span class="bold">Уже есть своя любимая насадка?</span>
                            </li>
                            <li class="slogan-content-item">
                                У нас для неё есть адаптер под наше запястье.
                            </li>
                            <li class="slogan-content-item">
                                <span class="bold">Есть любимый удобный протез?</span>
                            </li>
                            <li class="slogan-content-item">
                                У нас есть адаптер под Ваш протез.
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>

        <section class="main-content-bottom">
            <ul class="catalog-list position-column-2">
                @foreach($catalogs as $catalog)
                    <li class="catalog-item index-page">
                        <a class="wrap-catalog-item" href="{{route('show.category', $catalog['slug'])}}">
                            <img class="item-img" src="{{asset($catalog['link'])}}" alt="Fadvis">
                            <div class="filter for-catalog">
                                <div class="filter-box">
                                    <article class="filter-article">
                                        {{$catalog['name']}}
                                    </article>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </section>
@endsection
