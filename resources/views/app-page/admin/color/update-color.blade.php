@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="admin">
            <section class="form-wrap">
                <div class="wrap-user-data-profile user-data">
                    <div class="admin-title">
                        <div class="admin-title-page">
                            Редактировать цвет
                        </div>
                    </div>

                    <form class="js-response" data-form="js-update" method="POST" action="{{ route('api.v1.color.update', $color->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-block form-block-alt">
                            <div class="input-wrap nameError">
                                <label class="input-label" for="name">Название цвета</label>
                                <input class="input" name="name" id="name" value="{{$color->name}}" required type="text"/>
                            </div>

                            <div class="input-wrap articleError">
                                <label class="input-label" for="article">Артикул цвета</label>
                                <input class="input" name="article" id="article" value="{{$color->article}}" required type="text"/>
                            </div>

                            <div class="input-wrap imgError">
                                <label class="input-label" for="img">Выберите фото</label>
                                <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" />
                            </div>

                            <ul class="admin-img-box-list">
                                <li class="admin-img-box-item">
                                    <img class="content-grid-img" src="{{asset($color->link)}}" alt="fadvis">
                                </li>
                            </ul>
                        </div>

                        <div class="regular-button position-column-2-2">
                            <div class="button-box">
                                <a class="button-link red-color" href="{{route('admin.color.list')}}">
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
                </div>
            </section>
        </div>
    </main>
@endsection
