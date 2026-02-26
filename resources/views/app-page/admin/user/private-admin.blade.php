@extends('page.admin-page')
@section('admin-content')
<section class="admin">
    <div class="wrap-user-data-profile user-data">
        <div class="admin-title">
            <div class="admin-title-page">
                Личные данные @if($user->role === App\Enum\UserRoles::MASTER)
                    владельца
                @else
                    пользователя
                @endif
            </div>
        </div>
        <div class="user-profile-box">
            <div class="user-data-profile">
                <article class="title-data-profile">ФИО</article>
                <ul class="user-data-profile-list">
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            Фамилия:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->surname}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            Имя:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->name}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            Отчество:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->patronymic}}
                        </article>
                    </li>
                </ul>
            </div>

            <div class="user-data-profile">
                <article class="title-data-profile">Контакты</article>
                <ul class="user-data-profile-list">
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            email:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->email}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            сайт:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->site}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            телефон:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->phone}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            messenger:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->messenger}}
                        </article>
                    </li>
                </ul>
            </div>

            <div class="user-data-profile position-column-2-2">
                <article class="title-data-profile">Реквизиты</article>
                <ul class="user-data-profile-list">
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            Название фирмы:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->organization}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            ИНН:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->inn}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            ОГРН/ОГРНИП:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->ogrn}}
                        </article>
                    </li>
                    <li class="user-data-profile-item">
                        <article class="user-data-item">
                            Адрес:
                        </article>
                        <article class="user-data-item color-user-data">
                            {{$user->address}}
                        </article>
                    </li>
                </ul>
            </div>

            <div class="regular-button position-column-2-2">
                <div class="button-link red-color js-change">
                    Изменить пароль
                </div>

                @if($user->role === \App\Enum\UserRoles::MASTER)
                    <a class="button-link green-color" href="{{route('admin.show.update', [$user->role, $user])}}">
                        Редактировать профиль
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
