@extends('page.admin-page')
@section('admin-content')
<main class="main">
    <div class="main-content">
        <section class="form-wrap">
            <div class="form-title-box">
                <a class="link-title" href="{{route('admin.user.list')}}">Назад</a>
                <div class="title-box">
                    Создание контрагента
                </div>
            </div>
            <form class="form-admin js-response" method="POST" action="{{ route('api.v1.user.create') }}" enctype="multipart/form-data">
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
                    <div class="input-wrap roleError">
                        <label class="input-label" for="role">*Роль пользователя</label>
                        <select class="input" name="role" id="role">
                            @foreach($roles as $role)
                                @if ($role === \App\Enum\UserRoles::USER)
                                <option value="{{$role->value}}">{{$role->caption()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap emailError" data-notification="Вывод ошибки">
                        <label class="input-label" for="email">*Email</label>
                        <input class="input" name="email" id="email" required type="email"/>
                    </div>

                    <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                        <label class="input-label" for="phone">*Телефон</label>
                        <input class="input" name="phone" id="phone" required type="tel"/>
                    </div>

                    <div class="input-wrap siteError" data-notification="Вывод ошибки">
                        <label class="input-label" for="site">Сайт</label>
                        <input class="input" name="site" id="site" type="text"/>
                    </div>

                    <div class="input-wrap">
                        <label class="input-label" for="messenger">*Мессенджер</label>
                        <select class="input" name="messenger" id="messenger">
                            @foreach($messengers as $messenger)
                                <option value="{{$messenger}}">{{$messenger}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap organizationError" data-notification="Вывод ошибки">
                        <label class="input-label" for="organization">*Компания</label>
                        <input class="input" name="organization" id="organization" required type="text"/>
                    </div>

                    <div class="input-wrap addressError" data-notification="Вывод ошибки">
                        <label class="input-label" for="address">*Адрес</label>
                        <input class="input" name="address" id="address" required type="text"/>
                    </div>

                    <div class="input-wrap innError" data-notification="Вывод ошибки">
                        <label class="input-label" for="inn">*ИНН</label>
                        <input class="input" name="inn" id="inn" required type="text"/>
                    </div>

                    <div class="input-wrap ogrnError" data-notification="Вывод ошибки">
                        <label class="input-label" for="ogrn">*ОГРН/ОГРНИП</label>
                        <input class="input" name="ogrn" id="ogrn" required type="text"/>
                    </div>
                </div>

                <div class="button-box">
                    <a class="user-data-edit red-color password-switch " href="{{route('admin.user.list')}}">Назад</a>

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
