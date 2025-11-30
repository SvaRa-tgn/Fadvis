@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('admin.user.list')}}">Назад</a>
                    <div class="title-box">
                        Редактирование контрагента
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{ route('api.v1.user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">Фамилия</label>
                            <input class="input" name="surname" id="surname" placeholder="{{$user->surname}}" type="text"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">Имя</label>
                            <input class="input" name="name" id="name" placeholder="{{$user->name}}" type="text"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">Отчество</label>
                            <input class="input" name="patronymic" id="patronymic" placeholder="{{$user->patronymic}}" type="text"/>
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
                            <label class="input-label" for="email">Email</label>
                            <input class="input" name="email" id="email" placeholder="{{$user->email}}" type="email"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">Телефон</label>
                            <input class="input" name="phone" id="phone" placeholder="{{$user->phone}}" type="tel"/>
                        </div>

                        <div class="input-wrap siteError" data-notification="Вывод ошибки">
                            <label class="input-label" for="site">Сайт</label>
                            <input class="input" name="site" id="site" placeholder="{{$user->site}}" type="text"/>
                        </div>

                        <div class="input-wrap">
                            <label class="input-label" for="messenger">*Мессенджер</label>
                            <select class="input" name="messenger" id="messenger">
                                <option value="{{$user->messenger}}">{{$user->messenger}}</option>
                                @foreach($messengers as $messenger)
                                    @if ($user->messenger !== $messenger)
                                        <option value="{{$messenger}}">{{$messenger}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap organizationError" data-notification="Вывод ошибки">
                            <label class="input-label" for="organization">Компания</label>
                            <input class="input" name="organization" id="organization" placeholder="{{$user->organization}}" type="text"/>
                        </div>

                        <div class="input-wrap addressError" data-notification="Вывод ошибки">
                            <label class="input-label" for="address">Адрес</label>
                            <input class="input" name="address" id="address" placeholder="{{$user->address}}" type="text"/>
                        </div>

                        <div class="input-wrap innError" data-notification="Вывод ошибки">
                            <label class="input-label" for="inn">ИНН</label>
                            <input class="input" name="inn" id="inn" placeholder="{{$user->inn}}" type="text"/>
                        </div>

                        <div class="input-wrap ogrnError" data-notification="Вывод ошибки">
                            <label class="input-label" for="ogrn">ОГРН/ОГРНИП</label>
                            <input class="input" name="ogrn" id="ogrn" placeholder="{{$user->ogrn}}" type="text"/>
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
