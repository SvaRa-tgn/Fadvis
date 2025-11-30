@extends('/index')
@section('content')
    <div class="main-content">
        <div class="catalog-title size-title">
            {{$data['category']->name}}
        </div>
        <section class="wrap-category">
            <div class="wrap-category-title">
                {{$data['category']->second_name}}
            </div>
            <div class="category-info">
                <ul class="category-info-list">
                    @foreach($data['descriptions'] as $description)
                        <li class="category-info-item">
                            {{$description}}
                        </li>
                    @endforeach

                </ul>

                <section class="category-block">
                    <ul class="main-slider-list category-slider-list">
                        @foreach($data['sliders'] as $slider)
                            <li class="main-slider-item slider-flick slider-opacity">
                                <img class="slider-main-item-img" src="{{asset($slider)}}" alt="fadvis">
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="catalog-title">
                Виды протезов:
            </div>

            <ul class="category-list position-1">
                @foreach($data['products'] as $product)
                    <li class="category-item">
                        <a class="category-link" href="{{route('show.product', $product->id)}}">
                            <article class="category-img">
                                <img class="content-img-back" src="{{$product->link}}" alt="fadvis">
                            </article>

                            <ul class="category-desc-list">
                                <li class="category-desc-item title-desc size-desc">
                                    {{$product->name}}
                                </li>
                                <li class="category-desc-item position-3">
                                    <div class="wrap-description">
                                        <span class="color-desc">Артикул:</span> {{$product->article}}
                                    </div>

                                    <div class="wrap-description">
                                        <span class="color-desc">Размер:</span> {{$product->getSize()->value}}
                                    </div>

                                    <div class="wrap-description">
                                        <span class="color-desc">Сторона протезирования:</span> {{$product->getSide()->captionSide()}}
                                    </div>
                                </li>
                                <li class="category-desc-item size-desc">
                                    <div class="wrap-description">
                                        <span class="color-desc">Объем пястья, см:</span>
                                        {{$product->volume_size === null ? 'Индивидуальный подбор' : $product->volume_size}}

                                    </div>
                                </li>
                                <li class="category-desc-item size-desc">
                                    <div class="wrap-description">
                                        <span class="color-desc">Длина от запястья до конца среднего пальца, см:</span>
                                        {{$product->length_size === null ? 'Индивидуальный подбор' : $product->length_size}}
                                    </div>
                                </li>
                                <li class="category-desc-item">
                                    <div class="wrap-description">
                                        <span class="color-desc">Стандартный цвет:</span> {{$product->color->name}}
                                    </div>

                                    <div class="wrap-description">
                                        <span class="color-desc">Выбор цвета:</span>
                                        {{$product->is_select_color === true ? 'Да' : 'Нет'}}
                                    </div>
                                </li>
                                <li class="category-desc-item">
                                    <div class="wrap-description">
                                        <span class="color-desc">Производство:</span> {{$product->getMade()->caption()}}
                                    </div>

                                    <div class="wrap-description">
                                        <span class="color-desc">Производитель:</span> {{$product->manufacturer}}
                                    </div>
                                </li>
                            </ul>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
