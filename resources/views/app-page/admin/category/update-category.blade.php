@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="admin">
            <section class="form-wrap">
                <div class="wrap-user-data-profile user-data">
                    <div class="admin-title">
                        <div class="admin-title-page">
                            Редактировать категории
                        </div>
                    </div>

                    <form class="js-response" data-form="js-update" method="POST" action="{{ route('api.v1.category.update', $category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-block form-block-alt">
                            <div class="input-wrap nameError">
                                <label class="input-label" for="name">Название категории</label>
                                <input class="input" name="name" id="name" value="{{$category->name}}" required type="text"/>
                            </div>

                            <div class="input-wrap second_nameError">
                                <label class="input-label" for="second_name">Название категории на странице</label>
                                <input class="input" name="second_name" id="second_name" value="{{$category->second_name}}" required type="text"/>
                            </div>

                            <div class="input-wrap description_pageError text-area-block">
                                <label class="input-label" for="description">Описание категории</label>
                                <textarea class="input text-area" name="description" id="description" >{{$category->description}}</textarea>
                            </div>

                            <div class="input-wrap imgError">
                                <label class="input-label" for="img">Выберите фото</label>
                                <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg"/>
                            </div>

                            <ul class="admin-img-box-list">
                                <li class="alt-img-box-item">
                                    <img class="item-img" src="{{asset($category->link)}}" alt="fadvis">
                                </li>
                            </ul>
                        </div>


                        <div class="regular-button position-column-2-2">
                            <div class="button-box">
                                <a class="button-link red-color" href="{{route('admin.category.list')}}">
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
