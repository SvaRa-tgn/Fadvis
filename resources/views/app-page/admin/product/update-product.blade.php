@extends('page.admin-page')
@section('admin-content')
<main class="main">
    <div class="main-content">
        <section class="form-wrap">
            <div class="form-title-box">
                <form class="js-response" method="POST" action="{{ route('api.v1.product.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @if($product->getStatus() === \App\Enum\Status::ACTIVE)
                        <input class="input" name="status" type="text" value="{{\App\Enum\Status::DEACTIVATE->value}}" hidden/>
                        <div class="wrap-button js-button ">
                            <button class="user-data-edit red-color">Заблокировать</button>
                        </div>
                    @else
                        <input class="input" name="status" type="text" value="{{\App\Enum\Status::ACTIVE->value}}" hidden/>
                        <div class="wrap-button js-button ">
                            <button class="user-data-edit green-color">Разблокировать</button>
                        </div>
                    @endif

                    <div class="wrap-update-button js-preloader hide">
                        <div class="wrap-spin ">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <article>Обработка</article>
                    </div>
                </form>
                <div class="title-box">
                    Редактирование - {{$product->name}}
                </div>
            </div>
            <form class="form-admin js-response" method="POST" action="{{ route('api.v1.product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-block form-block-alt">
                    <div class="input-wrap nameError" data-notification="Вывод ошибки">
                        <label class="input-label" for="name">Название товара</label>
                        <input class="input" name="name" id="name" type="text" placeholder="{{$product->name}}"/>
                    </div>

                    <div class="input-wrap articleError" data-notification="Вывод ошибки">
                        <label class="input-label" for="article">Артикул</label>
                        <input class="input" name="article" id="article" placeholder="{{$product->name}}" type="text"/>
                    </div>

                    <div class="input-wrap descriptionError text-area-block">
                        <label class="input-label" for="description">Описание товара</label>
                        <textarea class="input text-area" name="description" id="description">{{$product->description}}
                        </textarea>
                    </div>

                    <div class="input-wrap category_idError">
                        <label class="input-label" for="category_id">Категория</label>
                        <select class="input" name="category_id" id="category_id">
                            <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                            @foreach($categories as $category)
                                @if($product->category->id !== $category->id)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <ul class="admin-img-box-list">
                        <li class="admin-img-box-item">
                            <img class="content-grid-img" src="{{asset($product->link)}}" alt="fadvis">
                        </li>
                    </ul>

                    <div class="input-wrap imgError">
                        <label class="input-label" for="img">Изменить фото</label>
                        <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg"/>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap sideError">
                        <label class="input-label" for="side">Сторона протезирования</label>
                        <select class="input" name="side" id="side">
                            <option value="{{$product->getSide()->value}}">{{$product->getSide()->caption()}}</option>
                            @foreach($sides as $side)
                                @if($product->getSide()->value !== $side->value)
                                    <option value="{{$side->value}}">{{$side->caption()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap typeError">
                        <label class="input-label" for="type">Тип протезирования</label>
                        <select class="input" name="type" id="type">
                            <option value="{{$product->getType()->value}}">{{$product->getType()->caption()}}</option>
                            @foreach($types as $type)
                                @if($product->getType()->value !== $type->value)
                                    <option value="{{$type->value}}">{{$type->caption()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @if($product->getType()->value === 'prothesis_hand')
                        <div class="input-wrap hand levelError">
                            <label class="input-label" for="level">*Узел протеза</label>
                            <select class="input" name="level" id="level">
                                <option value="{{$product->getLevel()->value}}">{{$product->getLevel()->caption()}}</option>
                                @foreach($hand_levels as $level)
                                    @if ($product->getLevel()->value !== $level->value)
                                        <option value="{{$level->value}}">{{$level->caption()}}</option>
                                    @endif
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
                    @else
                        <div class="input-wrap wrist levelError">
                            <label class="input-label" for="level">*Узел протеза</label>
                            <select class="input" name="level" id="level">
                                <option value="{{$product->getLevel()->value}}">{{$product->getLevel()->caption()}}</option>
                                @foreach($wrist_levels as $level)
                                    @if ($product->getLevel()->value !== $level->value)
                                        <option value="{{$level->value}}">{{$level->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap hand hide non-actual levelError">
                            <label class="input-label" for="level2">*Узел протеза</label>
                            <select class="input" name="level" id="level2">
                                @foreach($hand_levels as $hand_level)
                                    <option value="{{$hand_level->value}}">{{$hand_level->caption()}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="input-wrap sizeError">
                        <label class="input-label" for="size">Размер</label>
                        <select class="input" name="size" id="size">
                            <option value="{{$product->getSize()->value}}">{{$product->getSize()->value}}</option>
                            @foreach($sizes as $size)
                                @if($product->getSize()->value !== $size->value)
                                    <option value="{{$size->value}}">{{$size->value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap volume_sizeError" data-notification="Вывод ошибки">
                        <label class="input-label" for="volume_size">Объем пястья</label>
                        <input class="input" name="volume_size" id="volume_size" type="number" value="{{$product->volume_size}}"/>
                    </div>

                    <div class="input-wrap length_sizeError" data-notification="Вывод ошибки">
                        <label class="input-label" for="length_size">Длина от запястья до конца среднего пальца</label>
                        <input class="input" name="length_size" id="length_size" type="number" value="{{$product->length_size}}"/>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap color_idError">
                        <label class="input-label" for="color_id">Базовый цвет</label>
                        <select class="input" name="color_id" id="color_id">
                            <option value="{{$product->color->id}}">{{$product->color->name}}</option>
                            @foreach($colors as $color)
                                @if($product->color->id !== $color->id)
                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap is_select_colorError">
                        <label class="input-label" for="is_select_color">Выбор цвета</label>
                        <select class="input" name="is_select_color" id="is_select_color">
                            @if($product->is_select_color === true)
                                <option value="true">Да</option>
                                <option value="false">Нет</option>
                            @else
                                <option value="false">Нет</option>
                                <option value="true">Да</option>
                            @endif
                        </select>
                    </div>

                    <div class="input-wrap priceError" data-notification="Вывод ошибки">
                        <label class="input-label" for="price">Цена</label>
                        <input class="input" name="price" id="price" type="text" value="{{$product->price}}"/>
                    </div>

                    <div class="input-wrap madeError">
                        <label class="input-label" for="made">Производство</label>
                        <select class="input" name="made" id="made">
                            <option value="{{$product->getMade()->value}}">{{$product->getMade()->caption()}}</option>
                            @foreach($countries as $country)
                                @if($product->getMade()->value !== $country->value)
                                    <option value="{{$country->value}}">{{$country->caption()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap manufacturerError">
                        <label class="input-label" for="manufacturer">Производитель</label>
                        <select class="input" name="manufacturer" id="manufacturer">
                            <option value="{{$product->getManufacturer()->value}}">{{$product->getManufacturer()->value}}</option>
                            @foreach($manufacturers as $manufacturer)
                                @if($product->getManufacturer()->value !== $manufacturer->value)
                                    <option value="{{$manufacturer->value}}">{{$manufacturer->value}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="button-box">
                    <a class="user-data-edit red-color password-switch " href="{{route('admin.product.list')}}">Назад</a>

                    <div class="wrap-button js-button ">
                        <button class="user-data-edit green-color">Сохранить</button>
                    </div>

                    <div class="wrap-update-button js-preloader hide">
                        <div class="wrap-spin ">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <article>Обработка</article>
                    </div>
                </div>
            </form>

            <ul class="alt-img-box-list js-reload-block">
                <li class="alt-img-box-item add-img-box">
                   <form class="js-response" method="POST" data-add="add" action="{{ route('api.v1.image.add', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-wrap imagesError">
                            <label class="input-label-img">
                                <span>Добавить фотографии</span>
                                <input class="input" name="images[]" type="file" accept="image/png, image/jpeg" multiple/>
                            </label>

                        </div>
                        <div class="wrap-button js-button ">
                            <button class="user-data-edit green-color">Добавить</button>
                        </div>

                        <div class="wrap-update-button js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </form>
                </li>
                @if ($product->images !== null)
                    @foreach($product->images as $image)

                        <li class="alt-img-box-item">
                            <form class="js-response" method="POST" data-delete="delete" action="{{ route('api.v1.image.delete', $image->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <div class="wrap-button js-button ">
                                    <button class="user-data-edit red-color">удалить</button>
                                </div>

                                <div class="wrap-update-button js-preloader hide">
                                    <div class="wrap-spin ">
                                        <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                    </div>
                                    <article>Обработка</article>
                                </div>
                            </form>

                            <img class="content-grid-img update-img" src="{{asset($image->link)}}" alt="fadvis">

                            <form class="js-response" data-add="add" method="POST" action="{{ route('api.v1.image.update', [$product->id, $image->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="input-wrap imageError">
                                    <label class="input-label-img">
                                        <span>Изменить фото</span>
                                        <input class="input" name="image_product" type="file" accept="image/png, image/jpeg"/>
                                    </label>

                                </div>
                                <div class="wrap-button js-button ">
                                    <button class="user-data-edit green-color">Обновить</button>
                                </div>

                                <div class="wrap-update-button js-preloader hide">
                                    <div class="wrap-spin ">
                                        <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                    </div>
                                    <article>Обработка</article>
                                </div>
                            </form>
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>
    </div>
</main>
@endsection
