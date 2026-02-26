@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="admin">
            <section class="wrap-user-data-profile user-data">
                <div class="admin-title">
                    <div class="admin-title-page">
                        Создать цвет
                    </div>
                </div>

                <form class="js-response" data-form="js-create" method="POST" action="{{ route('api.v1.color.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-block form-block-alt">
                        <div class="input-wrap nameError">
                            <label class="input-label" for="name">Название цвета</label>
                            <input class="input" name="name" id="name" required type="text"/>
                        </div>

                        <div class="input-wrap articleError">
                            <label class="input-label" for="article">Артикул цвета</label>
                            <input class="input" name="article" id="article" required type="text"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото</label>
                            <input class="input" name="img" id="img" type="file" accept="image/png, image/jpeg" required/>
                        </div>
                    </div>

                    <div class="regular-button position-column-2-2">
                        <div class="button-box">
                            <a class="button-link red-color" href="{{route('admin.color.list')}}">
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
