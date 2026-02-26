@extends('page.admin-page')
@section('admin-content')
<main class="main">
    <div class="admin">
        <section class="form-wrap">
            <div class="wrap-user-data-profile user-data">
                <div class="admin-title">
                    <div class="title-box">
                        Редактирование {{$product->name}}
                    </div>
                </div>

                <form class="form-admin js-response" data-form="js-update" method="POST" action="{{ route('api.v1.product.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">Название товара</label>
                            <input class="input" name="name" id="name" type="text" value="{{$product->name}}" required/>
                        </div>

                        <div class="input-wrap articleError" data-notification="Вывод ошибки">
                            <label class="input-label" for="article">Артикул</label>
                            <input class="input" name="article" id="article" value="{{$product->article}}" required type="text"/>
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
                            <li class="alt-img-box-item">
                                <img class="item-img" src="{{asset($product->link)}}" alt="fadvis">
                            </li>
                        </ul>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Изменить фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap systemError">
                            <label class="input-label" for="system">Система протеза</label>
                            <select class="input" name="system" id="system">
                                <option value="{{$product->system->value}}">{{$product->system->caption()}}</option>
                                @foreach($systems as $system)
                                    @if($product->system->value !== $system->value)
                                        <option value="{{$system->value}}">{{$system->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap gripError">
                            <label class="input-label" for="grip">Коллекция</label>
                            <select class="input" name="grip" id="grip">
                                @isset($product->grip)
                                <option value="{{$product->grip->value}}">{{$product->grip->caption()}}</option>
                                @else
                                    <option value="">Нет коллекции</option>
                                @endif
                                @isset($product->grip)
                                    @foreach($grip as $item)
                                        @if ($product->grip->value !== $item->value)
                                            <option value="{{$item->value}}">{{$item->caption()}}</option>
                                        @else
                                            <option value="">Нет коллекции</option>
                                        @endif
                                    @endforeach
                                    @else
                                        @foreach($grip as $item)
                                            <option value="{{$item->value}}">{{$item->caption()}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>

                        <div class="input-wrap sideError">
                            <label class="input-label" for="side">Сторона протезирования</label>
                            <select class="input" name="side" id="side">
                                <option value="{{$product->side->value}}">{{$product->side->caption()}}</option>
                                @foreach($sides as $side)
                                    @if($product->side->value !== $side->value)
                                        <option value="{{$side->value}}">{{$side->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap typeError">
                            <label class="input-label" for="type">Тип протезирования</label>
                            <select class="input" name="type" id="type">
                                <option value="{{$product->type->value}}">{{$product->type->caption()}}</option>
                                @foreach($types as $type)
                                    @if($product->type->value !== $type->value)
                                        <option value="{{$type->value}}">{{$type->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        @if($product->type->value === 'prothesis_hand')
                            <div class="input-wrap hand levelError">
                                <label class="input-label" for="level">*Узел протеза</label>
                                <select class="input" name="level" id="level">
                                    <option value="{{$product->level->value}}">{{$product->level->caption()}}</option>
                                    @foreach($hand_levels as $level)
                                        @if ($product->level->value !== $level->value)
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
                                    <option value="{{$product->level->value}}">{{$product->level->caption()}}</option>
                                    @foreach($wrist_levels as $level)
                                        @if ($product->level->value !== $level->value)
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
                                <option value="{{$product->size->value}}">{{$product->size}}</option>
                                @foreach($sizes as $size)
                                    @if($product->size->value !== $size->value)
                                        <option value="{{$size->value}}">{{$size}}</option>
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
                            <input class="input" name="price" id="price" type="text" required value="{{$product->price}}"/>
                        </div>

                        <div class="input-wrap madeError">
                            <label class="input-label" for="made">Производство</label>
                            <select class="input" name="made" id="made">
                                <option value="{{$product->made->value}}">{{$product->made->caption()}}</option>
                                @foreach($countries as $country)
                                    @if($product->made->value !== $country->value)
                                        <option value="{{$country->value}}">{{$country->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap manufacturerError">
                            <label class="input-label" for="manufacturer">Производитель</label>
                            <select class="input" name="manufacturer" id="manufacturer">
                                <option value="{{$product->manufacturer->value}}">{{$product->manufacturer->value}}</option>
                                @foreach($manufacturers as $manufacturer)
                                    @if($product->manufacturer->value !== $manufacturer->value)
                                        <option value="{{$manufacturer->value}}">{{$manufacturer->value}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="regular-button position-column-2-2">
                        <div class="button-box">
                            <a class="button-link red-color" href="{{route('admin.product.list')}}">
                                Отменить
                            </a>
                        </div>

                        <div class="button-box">
                            <button class="button-link js-button green-color">
                                Сохранить
                            </button>

                            <div class="await-response js-preloader hide">
                                <div class="wrap-spin ">
                                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                </div>
                                <article>Обработка</article>
                            </div>
                        </div>
                    </div>
                </form>

                <ul class="alt-img-box-list">
                    <li class="alt-img-box-item add-img-box">
                        <form class="js-response" data-form="js-update" method="POST" action="{{ route('api.v1.image.add', $product->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="input-wrap imageError">
                                <label class="input-label-img">
                                    <span>Добавить фото</span>
                                    <input class="input" name="images[]" type="file" accept="image/png, image/jpeg" multiple/>
                                </label>
                            </div>

                            <div class="button-box">
                                <button class="button-link js-button green-color">
                                    Добавить фото
                                </button>

                                <div class="await-response js-preloader hide">
                                    <div class="wrap-spin ">
                                        <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                    </div>
                                    <article>Обработка</article>
                                </div>
                            </div>
                        </form>
                    </li>
                    @if ($product->images !== null)
                        @foreach($product->images as $image)
                            <li class="alt-img-box-item">
                                <form class="js-response" method="POST" data-form="js-update" action="{{ route('api.v1.image.delete', $image->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input class="input" name="status" type="text" value="{{\App\Enum\Status::DEACTIVATE->value}}"
                                           hidden/>
                                    <div class="button-box">
                                        <button class="button-link js-button red-color">
                                            Удалить
                                        </button>

                                        <div class="await-response js-preloader hide">
                                            <div class="wrap-spin ">
                                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                            </div>
                                            <article>Обработка</article>
                                        </div>
                                    </div>
                                </form>

                                <img class="content-grid-img-e update-img" src="{{asset($image->link)}}" alt="fadvis">

                                <form class="js-response" data-form="js-update" method="POST" action="{{ route('api.v1.image.update', [$product->id, $image->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-wrap imageError">
                                        <label class="input-label-img">
                                            <span>Изменить фото</span>
                                            <input class="input" name="image_product" type="file" accept="image/png, image/jpeg"/>
                                        </label>
                                    </div>

                                    <div class="button-box">
                                        <button class="button-link js-button green-color">
                                            Обновить
                                        </button>

                                        <div class="await-response js-preloader hide">
                                            <div class="wrap-spin ">
                                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                            </div>
                                            <article>Обработка</article>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </section>
    </div>
</main>
@endsection
