@extends('/index')
@section('content')
    <div class="main-content">
        <section class="form-wrap">
            <div class="catalog-title">
                {{$product->name}}
            </div>

            <section class="wrap-product">
                <div class="product-img-box">
                    <div class="product-img">
                        <img class="content-img-back" src="{{asset($product->link)}}" alt="fadvis">
                    </div>

                    <div class="color-and-button">
                        <div class="color-box">
                            <ul class="product-description-list">
                                @foreach($descriptions as $description)
                                    <li class="product-description-item">
                                        {{$description}}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="color-select">
                                Доступные цвета:
                            </div>
                            <ul class="color-select-list">
                                <li class="color-select-item">
                                    <img src="{{asset($product->color->link)}}" alt="fadvis"/>
                                </li>
                                @if($product->is_select_color === true)
                                    @foreach($colors as $color)
                                        <li class="color-select-item">
                                            <img src="{{asset($color->link)}}" alt="fadvis"/>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="button-box">
                            <div class="attention-box">
                                *Перед заказом необходима обязательная консультация
                            </div>

                            <div class="attention-button">
                                <a href="{{route('show.prothesis.form')}}">Запросить консультацию</a>
                            </div>
                        </div>
                    </div>

                    <ul class="product-char-list">
                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Артикул:</span> {{$product->article}}
                            </div>
                        </li>

                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Размер:</span> {{$product->getSize()->value}}
                            </div>
                        </li>

                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Сторона протезирования:</span> {{$product->getSide()->captionSide()}}
                            </div>
                        </li>

                        <li class="category-desc-item size-desc padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Объем пястья, см:</span>
                                {{$product->volume_size === null ? 'Индивидуальный подбор' : $product->volume_size}}
                            </div>
                        </li>
                        <li class="category-desc-item size-desc padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Длина от запястья до конца среднего пальца, см:</span>
                                {{$product->length_size === null ? 'Индивидуальный подбор' : $product->length_size}}
                            </div>
                        </li>
                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Стандартный цвет:</span> {{$product->color->name}}
                            </div>
                        </li>
                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Производство:</span> {{$product->getMade()->caption()}}
                            </div>
                        </li>
                        <li class="category-desc-item padding-char">
                            <div class="wrap-description">
                                <span class="color-desc">Производитель:</span> {{$product->manufacturer}}
                            </div>
                        </li>
                    </ul>
                </div>

                <ul class="product-img-list">
                    @foreach($images as $image)
                        <li class="product-img-item">
                            <img class="content-img-back" src="{{asset($image->link)}}" alt="fadvis">
                        </li>
                    @endforeach
                </ul>
            </section>
        </section>
    </div>
@endsection
