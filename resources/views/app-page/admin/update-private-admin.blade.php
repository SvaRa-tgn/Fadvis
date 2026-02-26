@extends('page.admin-page')
@section('admin-content')
    <div class="admin">
        <section class="form-wrap">
            <div class="wrap-user-data-profile user-data">
                <div class="admin-title ">
                    <div class="title-box">
                        Редактирование Профиля
                    </div>
                </div>

                <form class="form-admin js-response" data-form="js-update" method="POST" action="{{route('api.v1.admin.update', $user->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">Фамилия</label>
                            <input class="input" name="surname" id="surname" value="{{$user->surname}}" required type="text"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">Имя</label>
                            <input class="input" name="name" id="name" value="{{$user->name}}" required type="text"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">Отчество</label>
                            <input class="input" name="patronymic" id="patronymic" value="{{$user->patronymic}}" required type="text"/>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap emailError" data-notification="Вывод ошибки">
                            <label class="input-label" for="email">Email</label>
                            <input class="input" name="email" id="email" value="{{$user->email}}" required type="email"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">Телефон</label>
                            <input class="input" name="phone" id="phone" value="{{$user->phone}}" required type="tel"/>
                        </div>

                        <div class="input-wrap siteError" data-notification="Вывод ошибки">
                            <label class="input-label" for="site">Сайт</label>
                            <input class="input" name="site" id="site" value="{{$user->site}}" required type="text"/>
                        </div>

                        <div class="input-wrap">
                            <label class="input-label" for="messenger">*Мессенджер</label>
                            <select class="input" name="messenger" id="messenger">
                                <option value="{{$user->messenger}}">{{$user->messenger}}</option>
                                @foreach($messengers as $messenger)
                                    @if ($user->messenger->value !== $messenger)
                                        <option value="{{$messenger}}">{{$messenger}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap organizationError" data-notification="Вывод ошибки">
                            <label class="input-label" for="organization">Компания</label>
                            <input class="input" name="organization" id="organization" value="{{$user->organization}}" required type="text"/>
                        </div>

                        <div class="input-wrap addressError" data-notification="Вывод ошибки">
                            <label class="input-label" for="address">Адрес</label>
                            <input class="input" name="address" id="address" value="{{$user->address}}" required type="text"/>
                        </div>

                        <div class="input-wrap innError" data-notification="Вывод ошибки">
                            <label class="input-label" for="inn">ИНН</label>
                            <input class="input" name="inn" id="inn" value="{{$user->inn}}" required type="text"/>
                        </div>

                        <div class="input-wrap ogrnError" data-notification="Вывод ошибки">
                            <label class="input-label" for="ogrn">ОГРН/ОГРНИП</label>
                            <input class="input" name="ogrn" id="ogrn" value="{{$user->ogrn}}" required type="text"/>
                        </div>
                    </div>

                    <div class="regular-button position-column-2-2">
                        <div class="button-box">
                            <a class="button-link red-color" href="{{route('admin.user.show', [Auth::user()->role, Auth::user()->slug])}}">
                                Отменить
                            </a>
                        </div>

                        <div class="button-box ">
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
@endsection
