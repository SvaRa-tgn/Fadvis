<body class="visible">
<div class="wrapper">
    <header class="header">
        <section class="navigation">
            <div class="logo-box">
                <a href="{{route('main')}}" class="logo">
                    <img class="logo-link" src="{{asset('img/logo/fadvis.svg')}}" alt="Fadvis">
                </a>
            </div>

            <section class="nav-box">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{route('main')}}" class="nav-link">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('show.catalog')}}" class="nav-link">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('show.prothesis.form')}}" class="nav-link">Запросить протез</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('show.price.form')}}" class="nav-link">Запросить прайс</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link">Инфо</div>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Контакты</a>
                    </li>
                </ul>
            </section>

            <section class="profile-box">
                <ul class="auth-list js-reload-block">
                    @if ($user !== null)
                        <li class="auth-item">
                            @if ($user->role === \App\Enum\UserRoles::MASTER)
                                <a class="login-link login-profile "
                                   href="{{route('admin.user.show', [$user->role, $user])}}">
                                    <i class="fa fa-user fa-custom" data-auth="Личный кабинет"
                                       aria-hidden="true"></i>
                                </a>
                            @else
                                <a class="login-link login-profile "
                                   href="{{route('profile.user.show', [$user->role, $user])}}">
                                    <i class="fa fa-user fa-custom" data-auth="Личный кабинет"
                                       aria-hidden="true"></i>
                                </a>
                            @endif
                        </li>
                    @else
                        <li class="auth-item">
                            <div class="login-link login-auth ">
                                <i class="fa fa-sign-in fa-custom js-auth-box" data-auth="Авторизация"
                                   aria-hidden="true"></i>
                            </div>
                        </li>
                    @endif
                </ul>
            </section>
        </section>
    </header>
