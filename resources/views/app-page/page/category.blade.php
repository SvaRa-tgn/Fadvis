@extends('/index')
@section('content')
    <div class="main-content for-phone">
        <div class="page-title">
            {{$category->name}}
        </div>

        <section class="main-content-top position-column-4-2">
            <div class="wrap-box ">
                <div class="category-info">
                    <div class="wrap-category-info">
                        <div class="category-info-title">
                            {{$category->second_name}}
                        </div>
                        <ul class="category-info-list">
                            @foreach($descriptions as $description)
                                <li class="category-info-item">
                                    {{$description}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="slogan-box category-flag">
                <ul class="slogan-list position-row-2fr">
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
        </section>

        <section class="main-content-bottom">
            <div class="page-title">
                Виды протезов:
            </div>
            <ul class="catalog-list position-column-3">
                @foreach($products as $product)
                    <li class="catalog-item index-page">
                        <a class="wrap-catalog-item" href="{{route('show.product', $product['slug'])}}">
                            <img class="item-img" src="{{asset($product['link'])}}" alt="Fadvis">
                            <div class="filter for-catalog">
                                <div class="filter-box">
                                    <article class="filter-article">
                                        {{$product['name']}}
                                    </article>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
