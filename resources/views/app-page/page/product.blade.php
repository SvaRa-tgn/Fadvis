@extends('/index')
@section('content')
    <div class="main-content for-product">
        <div class="page-title">
            {{$product->name}}
        </div>

        <section class="main-content-top product-padding position-column-4-2">
            <div class="wrap-product-img">
                <img class="item-img" src="{{asset($product->link)}}" alt="Fadvis">
                <div class="filter color-black for-category">
                    <div class="filter-box">
                        <article class="filter-article">
                            {{$product->name}}
                        </article>
                    </div>
                </div>
            </div>

            <div class="slogan-box category-flag">
                <div class="wrap-category-info">
                    <div class="order-title">
                        Описание:
                    </div>

                    <ul class="description-product-list">
                        @foreach($descriptions as $description)
                            <li class="description-product-item">
                                {{$description}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="product-info">
                <div class="wrap-product-info">
                    <div class="order-title">
                        Информация по товару:
                    </div>
                    <ul class="product-info-list">
                        @if (auth()->check())
                            <li class="price-box">
                                <div class="price">
                                    <article class="price-name">Цена:</article>
                                    <article class="price-value">{{$product->formatted_total}} <i class="fa fa-ruble"></i></article>
                                </div>
                            </li>
                        @endif
                        <li class="product-info-item">
                            <article class="description">Артикул:</article>
                            <article class="description">{{$product->article}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Размер:</article>
                            <article class="description">{{$product->size}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Сторона протезирования:</article>
                            <article class="description">{{$product->side->caption()}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Тип протезирования:</article>
                            <article class="description">{{$product->type->caption()}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Узел протезирования:</article>
                            <article class="description">{{$product->level->caption()}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Объем пястья, см:</article>
                            <article class="description">{{$product->volume_size !== null ? $product->volume_size : 'Индивидуальный подбор'}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Длина от запястья до конца среднего пальца, см:</article>
                            <article class="description">{{$product->length_size !== null ? $product->length_size : 'Индивидуальный подбор'}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Производство:</article>
                            <article class="description">{{$product->made->caption()}}</article>
                        </li>
                        <li class="product-info-item">
                            <article class="description">Производитель:</article>
                            <article class="description">{{$product->manufacturer}}</article>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="wrap-price-box">
                <div class="order-title">
                    Цвет:
                </div>
                <div class="wrap-color-box">
                    <div class="color-box">
                        <ul class="color-list">
                            <li class="color-item position-column-2">
                                <article class="article-product">
                                    Цвет пястья:
                                </article>
                                <article class="article-product">
                                    Черный
                                </article>
                            </li>
                            <li class="color-item">
                                <img class="item-img" src="{{asset($product->color->link)}}" alt="Fadvis">
                            </li>
                        </ul>
                        <ul class="color-list">
                            <li class="color-item position-column-2">
                                <article class="article-product">
                                    Цвет насадки:
                                </article>
                                <article class="article-product">
                                    Оранжевый
                                </article>
                            </li>
                            <li class="color-item">
                                <img class="item-img" src="{{asset($product->color->link)}}" alt="Fadvis">
                            </li>
                        </ul>
                    </div>
                    <ul class="slogan-product-list">
                        <li class="slogan-product-item">
                            <a class="info-link" href="{{route('show.prothesis.form')}}">
                                <article class="info-link-title">Запросить протез</article>
                            </a>
                        </li>
                        <li class="slogan-product-item">
                            <a class="info-link" href="{{route('show.price.form')}}">
                                <article class="info-link-title">Запросить прайс</article>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        @if(!$images->isEmpty())
            <section class="main-content-bottom">
                <div class="page-title gallery-title">
                    Галерея
                </div>
                <ul class="catalog-list position-column-3-product">
                    @foreach($images as $image)
                        <li class="gallery-img index-page">
                            <div class="wrap-catalog-item">
                                <img class="item-img" src="{{asset($image->link)}}" alt="Fadvis">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
@endsection
