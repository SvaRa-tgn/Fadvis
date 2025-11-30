<body class="visible">
<div class="wrapper">
    <header class="header" id="home">
        <div class="header-wrap">
            <section class="logo-module">
                <a href="{{route('main')}}" class="logo-link">
                    <img class="logo" src="{{asset('img/logo/fadvis-logo-cropped.svg')}}" alt="Fadvis">
                </a>
            </section>
            <nav class="navigation">
                <ul class="navigation-list">
                    <li class="navigation-item">
                        <a href="{{route('main')}}" class="navigation-link">Главная</a>
                    </li>
                    <li class="navigation-item">
                        <a href="{{route('show.catalog')}}" class="navigation-link">Каталог</a>
                    </li>
                    <li class="navigation-item">
                        <a href="{{route('show.price.form')}}" class="navigation-link">Получить прайс</a>
                    </li>
                    <li class="navigation-item">
                        <a href="{{route('show.prothesis.form')}}" class="navigation-link">Получить протез</a>
                    </li>
                    <li class="navigation-item">
                        <a href="#contact" class="navigation-link">Контакты</a>
                    </li>
                </ul>
            </nav>
            <section class="auth">
                <ul class="auth-list">
                    <li class="auth-item">
                        <i class="fa fa-cart-arrow-down fa-custom" data-auth="Корзина" aria-hidden="true"></i>
                    </li>
                    <li class="auth-item">
                        @if (Auth::check())
                            <a class="login-link login-profile"
                               @if (Auth::user()->role === \App\Enum\UserRoles::MASTER->value)
                                   href="{{route('admin.user.show', [Auth::user()->role, Auth::user()->slug])}}">
                                   <i class="fa fa-user fa-custom" data-auth="Админка" aria-hidden="true"></i>
                               @else
                                   href="{{route('profile.user.show', [Auth::user()->role, Auth::user()->slug])}}">
                                   <i class="fa fa-user fa-custom" data-auth="Личный кабинет" aria-hidden="true"></i>
                               @endif
                            </a>
                        @else
                            <a class="login-link login-auth" href="#">
                                <i class="fa fa-sign-in fa-custom pop-up-switch" data-auth="Войти" aria-hidden="true"></i>
                            </a>
                        @endif
                    </li>
                </ul>
            </section>
        </div>
    </header>
