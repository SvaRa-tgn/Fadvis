@extends('page.admin-page')
@section('admin-content')
<main class="main">
    <div class="main-content">
        <section class="form-wrap">
            <div class="form-title-box">
                <a class="link-title" href="{{route('admin.product.list')}}">Назад</a>
                <div class="title-box">
                    Создание товара
                </div>
            </div>
            <form class="form-admin js-response" method="POST" action="{{ route('api.v1.product.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-block form-block-alt">
                    <div class="input-wrap nameError" data-notification="Вывод ошибки">
                        <label class="input-label" for="name">*Название товара</label>
                        <input class="input" name="name" id="name" required type="text"/>
                    </div>

                    <div class="input-wrap articleError" data-notification="Вывод ошибки">
                        <label class="input-label" for="article">*Артикул</label>
                        <input class="input" name="article" id="article" required type="text"/>
                    </div>

                    <div class="input-wrap descriptionError text-area-block">
                        <label class="input-label" for="description">*Описание товара</label>
                        <textarea class="input text-area" name="description" id="description" required></textarea>
                    </div>

                    <div class="input-wrap category_idError">
                        <label class="input-label" for="category_id">*Категория</label>
                        <select class="input" name="category_id" id="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap imgError">
                        <label class="input-label" for="img">*Выберите фото для товара</label>
                        <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" required/>
                    </div>

                    <div class="input-wrap imgError">
                        <label class="input-label" for="imgs">Выберите фото для галереи</label>
                        <input class="input" name="imgs[]" id="imgs" type="file" accept="image/png, image/jpeg" multiple/>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap sideError">
                        <label class="input-label" for="side">*Сторона протезирования</label>
                        <select class="input" name="side" id="side">
                            @foreach($sides as $side)
                                <option value="{{$side->value}}">{{$side->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap typeError">
                        <label class="input-label" for="type">*Тип протеза</label>
                        <select class="input" name="type" id="type">
                            @foreach($types as $type)
                                <option value="{{$type->value}}">{{$type->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap hand levelError">
                        <label class="input-label" for="level">*Узел протеза</label>
                        <select class="input" name="level" id="level">
                            @foreach($hand_levels as $hand_level)
                                <option value="{{$hand_level->value}}">{{$hand_level->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap wrist hide non-actual levelError">
                        <label class="input-label" for="level2">*Узел протеза</label>
                        <select class="input" name="level" id="level2">
                            @foreach($wrist_levels as $wrist_level)
                                <option value="{{$wrist_level->value}}">{{$wrist_level->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap sizeError">
                        <label class="input-label" for="size">*Размер</label>
                        <select class="input" name="size" id="size">
                            @foreach($sizes as $size)
                                <option value="{{$size->value}}">{{$size->value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap volume_sizeError" data-notification="Вывод ошибки">
                        <label class="input-label" for="volume_size">Объем пястья</label>
                        <input class="input" name="volume_size" id="volume_size" type="number"/>
                    </div>

                    <div class="input-wrap length_sizeError" data-notification="Вывод ошибки">
                        <label class="input-label" for="length_size">Длина от запястья до конца среднего пальца</label>
                        <input class="input" name="length_size" id="length_size" type="number"/>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap color_idError">
                        <label class="input-label" for="color_id">*Базовый цвет</label>
                        <select class="input" name="color_id" id="color_id">
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap is_select_colorError">
                        <label class="input-label" for="is_select_color">*Выбор цвета</label>
                        <select class="input" name="is_select_color" id="is_select_color">
                            <option value="true">Да</option>
                            <option value="false">Нет</option>
                        </select>
                    </div>

                    <div class="input-wrap priceError" data-notification="Вывод ошибки">
                        <label class="input-label" for="price">*Цена</label>
                        <input class="input" name="price" id="price" required type="text"/>
                    </div>

                    <div class="input-wrap madeError">
                        <label class="input-label" for="made">*Производство</label>
                        <select class="input" name="made" id="made">
                            @foreach($countries as $country)
                                <option value="{{$country->value}}">{{$country->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap manufacturerError">
                        <label class="input-label" for="manufacturer">*Производитель</label>
                        <select class="input" name="manufacturer" id="manufacturer">
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{$manufacturer->value}}">{{$manufacturer->value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="button-box">
                    <a class="user-data-edit red-color password-switch " href="{{route('admin.product.list')}}">Назад</a>

                    <div class="wrap-button js-button ">
                        <button class="user-data-edit green-color">Создать</button>
                    </div>

                    <div class="wrap-update-button js-preloader hide">
                        <div class="wrap-spin ">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <article>Обработка</article>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>
@endsection
