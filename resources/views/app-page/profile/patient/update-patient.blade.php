@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('profile.patient.list', $user->id)}}">Назад</a>
                    <div class="title-box">
                        Редактирование пациента
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.patient.update', [$user->id, $patient->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">Фамилия</label>
                            <input class="input" name="surname" id="surname" value="{{$patient->surname}}" type="text"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">Имя</label>
                            <input class="input" name="name" id="name" value="{{$patient->name}}" type="text"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">Отчество</label>
                            <input class="input" name="patronymic" id="patronymic" value="{{$patient->patronymic}}" type="text"/>
                        </div>

                        <div class="input-wrap emailError" data-notification="Вывод ошибки">
                            <label class="input-label" for="email">Email</label>
                            <input class="input" name="email" id="email" value="{{$patient->email}}" type="email"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">Телефон</label>
                            <input class="input" name="phone" id="phone" value="{{$patient->phone}}" type="tel"/>
                        </div>
                    </div>

                    <div class="button-box">
                        <a class="user-data-edit red-color password-switch " href="{{route('profile.patient.list', $user->id)}}">Назад</a>

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
                    @foreach($patient->images as $image)
                        <li class="alt-img-box-item">
                            <img class="content-grid-img update-img" src="{{asset($image->link)}}" alt="fadvis">

                            <form class="js-response" data-add="add" method="POST" action="{{ route('api.v1.image.patient.update', [$user->id, $patient->id, $image->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="input-wrap imageError">
                                    <label class="input-label-img">
                                        <span>Изменить фото</span>
                                        <input class="input" name="image_patient" type="file" accept="image/png, image/jpeg"/>
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
                </ul>
            </section>
        </div>
    </main>
@endsection
