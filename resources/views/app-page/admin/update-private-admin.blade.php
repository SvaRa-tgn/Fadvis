@extends('page.admin-page')
@section('admin-content')
    <section class="admin">
        <form class="wrap-user-data-profile user-data two-column js-response" method="POST" action="{{route('api.v1.admin.update', $user->id)}}">

            <div class="admin-title admin-title-page">
                Редактирование личных данных администратора
            </div>

            <div class="user-data-profile">
                @csrf
                @method('PUT')
                <article class="title-data-profile">ФИО</article>
                <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                    <label class="input-label" for="surname">Фамилия</label>
                    <input class="input" name="surname" id="surname" placeholder="{{$user->surname}}" type="text"/>
                </div>

                <div class="input-wrap nameError">
                    <label class="input-label" for="name">Имя</label>
                    <input class="input" name="name" id="name" placeholder="{{$user->name}}" type="text"/>
                </div>

                <div class="input-wrap patronymicError">
                    <label class="input-label" for="patronymic">Отчество</label>
                    <input class="input" name="patronymic" id="patronymic" placeholder="{{$user->patronymic}}" type="text"/>
                </div>
            </div>

            <div class="user-data-profile">
                <article class="title-data-profile">Контакты</article>
                <div class="input-wrap emailError">
                    <label class="input-label" for="email">Email</label>
                    <input class="input" name="email" id="email" placeholder="{{$user->email}}" type="email"/>
                </div>

                <div class="input-wrap phoneError">
                    <label class="input-label" for="phone">Телефон</label>
                    <input class="input" name="phone" id="phone" placeholder="{{$user->phone}}" type="tel"/>
                </div>

                <div class="input-wrap siteError">
                    <label class="input-label" for="site">Сайт</label>
                    <input class="input" name="site" id="site" placeholder="{{$user->site}}" type="tel"/>
                </div>

                <div class="input-wrap">
                    <label class="input-label" for="messenger">Мессенджер</label>
                    <select class="input" name="messenger" id="messenger">
                        <option value="{{$user->messenger}}">{{$user->messenger}}</option>
                        @foreach($messengers as $messenger)
                            @if ($messenger !== $user->messenger)
                            <option value="{{$messenger}}">{{$messenger}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="user-data-profile">
                <article class="title-data-profile">Реквизиты</article>
                <div class="input-wrap organizationError">
                    <label class="input-label" for="organization">Компания</label>
                    <input class="input" name="organization" id="organization" placeholder="{{$user->organization}}" type="text"/>
                </div>

                <div class="input-wrap addressError">
                    <label class="input-label" for="address">Адрес</label>
                    <input class="input" name="address" id="address" placeholder="{{$user->address}}" type="text"/>
                </div>

                <div class="input-wrap innError">
                    <label class="input-label" for="inn">ИНН</label>
                    <input class="input" name="inn" id="inn" type="text" placeholder="{{$user->inn}}"/>
                </div>

                <div class="input-wrap ogrnError">
                    <label class="input-label" for="ogrn">ОГРН/ОГРНИП</label>
                    <input class="input" name="ogrn" id="ogrn" type="text" placeholder="{{$user->ogrn}}"/>
                </div>
            </div>

            <div class="button-box">
                <a class="user-data-edit red-color password-switch " href="{{route('admin.user.show', [Auth::user()->role, Auth::user()->slug])}}">Назад</a>

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
@endsection
