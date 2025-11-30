@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <form class="js-response" method="POST" action="{{ route('api.v1.color.update', $color->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @if($color->getStatus() === \App\Enum\Status::ACTIVE)
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
                        Редактирование Цвета
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.color.update', $color->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap nameError">
                            <label class="input-label" for="name">Название цвета</label>
                            <input class="input" name="name" id="name" placeholder="{{$color->name}}" type="text"/>
                        </div>

                        <div class="input-wrap articleError">
                            <label class="input-label" for="article">Артикул цвета</label>
                            <input class="input" name="article" id="article" value="{{$color->article}}" type="text"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" required/>
                        </div>

                        <ul class="admin-img-box-list">
                            <li class="admin-img-box-item">
                                <img class="content-grid-img" src="{{asset($color->link)}}" alt="fadvis">
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
