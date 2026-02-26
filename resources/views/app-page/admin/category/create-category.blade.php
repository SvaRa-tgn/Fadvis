@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="admin">
            <section class="wrap-user-data-profile user-data">
                <div class="admin-title">
                    <div class="admin-title-page">
                        Создать категорию
                    </div>
                </div>

                <form class="js-response" data-form="js-create" method="POST" action="{{ route('api.v1.category.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-block form-block-alt">
                        <div class="input-wrap nameError">
                            <label class="input-label" for="name">Название категории</label>
                            <input class="input" name="name" id="name" required type="text"/>
                        </div>

                        <div class="input-wrap second_nameError">
                            <label class="input-label" for="second_name">Название категории на странице</label>
                            <input class="input" name="second_name" id="second_name" required type="text"/>
                        </div>

                        <div class="input-wrap descriptionError text-area-block">
                            <label class="input-label" for="description">Описание категории</label>
                            <textarea class="input text-area" name="description" id="description" required></textarea>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" required/>
                        </div>
                    </div>

                    <div class="regular-button position-column-2-2">
                        <div class="button-box">
                            <a class="button-link red-color" href="{{route('admin.category.list')}}">
                                Отменить
                            </a>
                        </div>

                        <div class="button-box">
                            <button class="button-link js-button green-color">
                                Создать
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
            </section>
        </div>
    </main>
@endsection
