@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('admin.category.list')}}">Назад</a>
                    <div class="title-box">
                        Создание категории
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.category.create') }}" enctype="multipart/form-data">
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

                        <div class="input-wrap description_indexError text-area-block">
                            <label class="input-label" for="description_index">Описание на главной</label>
                            <textarea class="input text-area" name="description_index" id="description_index" required></textarea>
                        </div>

                        <div class="input-wrap description_pageError text-area-block">
                            <label class="input-label" for="description_page">Описание на странице</label>
                            <textarea class="input text-area" name="description_page" id="description_page" required></textarea>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" required/>
                        </div>
                    </div>


                    <div class="button-box">
                        <a class="user-data-edit red-color password-switch " href="{{route('admin.category.list')}}">Назад</a>

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
