@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('profile.patient.list', $user->id)}}">Назад</a>
                    <div class="title-box">
                        Создание пациента
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.patient.create', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">*Фамилия</label>
                            <input class="input" name="surname" id="surname" required type="text"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">*Имя</label>
                            <input class="input" name="name" id="name" required type="text"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">*Отчество</label>
                            <input class="input" name="patronymic" id="patronymic" required type="text"/>
                        </div>

                        <div class="input-wrap emailError" data-notification="Вывод ошибки">
                            <label class="input-label" for="email">*Email</label>
                            <input class="input" name="email" id="email" required type="email"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">*Телефон</label>
                            <input class="input" name="phone" id="phone" required type="tel"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото (Необязательно)</label>
                            <input class="input" name="first_img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото (Необязательно)</label>
                            <input class="input" name="second_img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>
                    </div>

                    <div class="button-box">
                        <a class="user-data-edit red-color password-switch " href="{{route('profile.patient.list', $user->id)}}">Назад</a>

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
