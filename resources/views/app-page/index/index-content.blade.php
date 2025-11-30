@extends('/index')
@section('content')
<div class="main-content">
    <section class="main-content-block left">
        <div class="main-content-wrap">
            <div class="content-nav-list-wrap">
                <ul class="content-nav-list">
                    <li class="content-nav-item">
                        <a href="html/hand.html" class="content-nav-link">Кисти косметические</a>
                    </li>
                    <li class="content-nav-item">
                        <a href="html/nozzles.html" class="content-nav-link">Насадки</a>
                    </li>
                    <li class="content-nav-item">
                        <a href="html/attachments.html" class="content-nav-link">Тягловые насадки</a>
                    </li>
                    <li class="content-nav-item">
                        <a href="html/fingers.html" class="content-nav-link">Протезы пальцев</a>
                    </li>
                    <li class="content-nav-item">
                        <a href="html/wrists.html" class="content-nav-link">Запястья</a>
                    </li>
                </ul>
            </div>

            <div class="content-video">
                <div class="video-wrap">
                    <iframe width="100%" height="100%" src="{{asset('https://www.youtube.com/embed/c5ZSfPP34_s?si=DxWYfcwiTEDOPv-G"
                            title="YouTube video player')}}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;
                            picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="main-slider">
        <ul class="main-slider-list">
            <li class="main-slider-item slider-flick slider-opacity">
                <div class="wrap-slider-content">
                    <div class="main-slider-img">
                        <img class="slider-grid-img" src="{{asset('/img/temp/2.jpg')}}" alt="fadvis">
                    </div>

                    <div class="main-slider-content">
                        <div class="wrap-main-slider-content">
                            <article class="content-article-h2">
                                Красиво
                            </article>
                            <article class="content-article">
                                lorem ipsum dolor sit ametlorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                            </article>
                        </div>
                    </div>
                </div>
            </li>

            <li class="main-slider-item slider-flick">
                <div class="wrap-slider-content">
                    <div class="main-slider-img">
                        <img class="slider-grid-img" src="{{asset('/img/temp/4.jpg')}}" alt="fadvis">
                    </div>

                    <div class="main-slider-content">
                        <div class="wrap-main-slider-content">
                            <article class="content-article-h2">
                                Красиво
                            </article>
                            <article class="content-article">
                                lorem ipsum dolor sit ametlorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                            </article>
                        </div>
                    </div>
                </div>
            </li>

            <li class="main-slider-item slider-flick">
                <div class="wrap-slider-content">
                    <div class="main-slider-img">
                        <img class="slider-grid-img" src="{{asset('/img/temp/5.jpg')}}" alt="fadvis">
                    </div>

                    <div class="main-slider-content">
                        <div class="wrap-main-slider-content">
                            <article class="content-article-h2">
                                Красиво
                            </article>
                            <article class="content-article">
                                lorem ipsum dolor sit ametlorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                            </article>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <section class="wrap-content-block" id="catalog">
        <ul class="main-catalog-list">
            @if (!empty($catalogs))
                @foreach($catalogs as $catalog)
                    <li class="main-catalog-item left">
                        <a href="{{route('show.category', $catalog['id'])}}" class="main-catalog-link">
                            <div class="content-info-wrap catalog-link">
                                <div class="content-slider">
                                    <div class="content-slider-wrap">
                                        <div class="content-slider-item">
                                            <div class="content-img-back-wrap">
                                                <img class="content-img-back" src="{{asset($catalog['link'])}}" alt="fadvis">
                                            </div>
                                            <div class="filter-catalog left-content">
                                                <div class="filter-item-catalog">
                                                    <article class="catalog-link">{{$catalog['name']}}</article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-info">
                                    <div class="content-position">
                                        <ul class="content-info-list">
                                            @foreach($catalog['descriptions'] as $description)
                                                <li class="content-info-item">
                                                    {{$description}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </section>
</div>
@endsection
