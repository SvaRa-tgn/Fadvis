@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <form class="js-response" method="POST" action="{{ route('api.v1.category.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if($category->getStatus() === \App\Enum\Status::ACTIVE)
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
                        Создание товара
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap nameError">
                            <label class="input-label" for="name">Название категории</label>
                            <input class="input" name="name" id="name" placeholder="{{$category->name}}" type="text"/>
                        </div>

                        <div class="input-wrap second_nameError">
                            <label class="input-label" for="second_name">Название категории на странице</label>
                            <input class="input" name="second_name" id="second_name" placeholder="{{$category->second_name}}" type="text"/>
                        </div>

                        <div class="input-wrap description_indexError text-area-block">
                            <label class="input-label" for="description_index">Описание на главной</label>
                            <textarea class="input text-area" name="description_index" id="description_index">{{$category->description_index}}</textarea>
                        </div>

                        <div class="input-wrap description_pageError text-area-block">
                            <label class="input-label" for="description_page">Описание на странице</label>
                            <textarea class="input text-area" name="description_page" id="description_page" >{{$category->description_page}}</textarea>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>

                        <ul class="admin-img-box-list">
                            <li class="admin-img-box-item">
                                <img class="content-grid-img" src="{{asset($category->link)}}" alt="fadvis">
                            </li>
                        </ul>
                    </div>


                    <div class="button-box">
                        <a class="user-data-edit red-color password-switch " href="{{route('admin.category.list')}}">Назад</a>

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
            </section>
        </div>
    </main>
@endsection
