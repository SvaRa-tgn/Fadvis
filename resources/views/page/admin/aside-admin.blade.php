<aside class="aside full-version">
    @if (Auth::user()->role === \App\Enum\UserRoles::MASTER)
    <ul class="aside-menu-list">
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.user.show') active-menu-link @endif"
               href="{{route('admin.user.show',
[Auth::user()->role, str_slug(Auth::user()->surname . ' ' . Auth::user()->name . ' ' . Auth::user()->patronymic, '_')])}}">
                Личные данные
            </a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.user.list' ||
                                          Route::currentRouteName() === 'admin.user.create' ||
                                          Route::currentRouteName() === 'admin.user.update')
            active-menu-link @endif" href="{{route('admin.user.list')}}">Контрагенты</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.order.list' ||
                                          Route::currentRouteName() === 'admin.order.show')
            active-menu-link @endif" href="{{route('admin.order.list')}}">Заказы</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.category.list' ||
                                          Route::currentRouteName() === 'admin.category.create' ||
                                          Route::currentRouteName() === 'admin.category.update')
            active-menu-link @endif" href="{{route('admin.category.list')}}">Категории</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.color.list' ||
                                          Route::currentRouteName() === 'admin.color.create' ||
                                          Route::currentRouteName() === 'admin.color.update')
            active-menu-link @endif" href="{{route('admin.color.list')}}">Цвета</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.product.list' ||
                                          Route::currentRouteName() === 'admin.product.create' ||
                                          Route::currentRouteName() === 'admin.product.update')
            active-menu-link @endif" href="{{route('admin.product.list')}}">Товары</a>
        </li>
        <li class="aside-menu-item">
            <div class="wrap-logout-form">
                <form class="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="button-box">
                        <button class="button-link red-color">
                            Выйти из аккаунта
                        </button>
                    </div>
                </form>
            </div>
        </li>
    </ul>
    @else
        <ul class="aside-menu-list">
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.user.show') active-menu-link @endif"
                   href="{{route('profile.user.show',
[Auth::user()->role, str_slug(Auth::user()->surname . ' ' . Auth::user()->name . ' ' . Auth::user()->patronymic, '_')])}}">
                    Личные данные
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.patient.list' ||
                                              Route::currentRouteName() === 'profile.patient.create' ||
                                              Route::currentRouteName() === 'profile.patient.update'
                                          )
            active-menu-link @endif" href="{{route('profile.patient.list', $user)}}">Пациенты</a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.order.list' ||
                                              Route::currentRouteName() === 'profile.order.create' ||
                                              Route::currentRouteName() === 'profile.order.update'
                                          )
            active-menu-link @endif" href="{{route('profile.order.list', $user)}}">Заказы</a>
            </li>
            <li class="aside-menu-item">
                <div class="wrap-logout-form">
                    <form class="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="button-box">
                            <button class="button-link red-color">
                                Выйти из аккаунта
                            </button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    @endif
</aside>

<aside class="aside adaptive-version">
    @if (Auth::user()->role === \App\Enum\UserRoles::MASTER)
        <ul class="aside-menu-list">
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.user.show') active-menu-link @endif"
                   href="{{route('admin.user.show',
[Auth::user()->role, str_slug(Auth::user()->surname . ' ' . Auth::user()->name . ' ' . Auth::user()->patronymic, '_')])}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.user.list' ||
                                          Route::currentRouteName() === 'admin.user.create' ||
                                          Route::currentRouteName() === 'admin.user.update')
            active-menu-link @endif" href="{{route('admin.user.list')}}"><i class="fa fa-users" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.order.list' ||
                                          Route::currentRouteName() === 'admin.order.show')
            active-menu-link @endif" href="{{route('admin.order.list')}}"><i class="fa fa-th-list" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.category.list' ||
                                          Route::currentRouteName() === 'admin.category.create' ||
                                          Route::currentRouteName() === 'admin.category.update')
            active-menu-link @endif" href="{{route('admin.category.list')}}"><i class="fa fa-sitemap" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.color.list' ||
                                          Route::currentRouteName() === 'admin.color.create' ||
                                          Route::currentRouteName() === 'admin.color.update')
            active-menu-link @endif" href="{{route('admin.color.list')}}"><i class="fa fa-tint" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.product.list' ||
                                          Route::currentRouteName() === 'admin.product.create' ||
                                          Route::currentRouteName() === 'admin.product.update')
            active-menu-link @endif" href="{{route('admin.product.list')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <div class="wrap-logout-form">
                    <form class="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="button-box">
                            <button class="button-link red-color">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    @else
        <ul class="aside-menu-list">
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.user.show') active-menu-link @endif"
                   href="{{route('profile.user.show',
    [Auth::user()->role, str_slug(Auth::user()->surname . ' ' . Auth::user()->name . ' ' . Auth::user()->patronymic, '_')])}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.patient.list' ||
                                              Route::currentRouteName() === 'profile.patient.create' ||
                                              Route::currentRouteName() === 'profile.patient.update'
                                          )
            active-menu-link @endif" href="{{route('profile.patient.list', $user->id)}}"><i class="fa fa-users" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.order.list' ||
                                              Route::currentRouteName() === 'profile.order.create' ||
                                              Route::currentRouteName() === 'profile.order.update'
                                          )
            active-menu-link @endif" href="{{route('profile.order.list', $user->id)}}"><i class="fa fa-th-list" aria-hidden="true"></i></a>
            </li>
            <li class="aside-menu-item">
                <div class="wrap-logout-form">
                    <form class="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="button-box">
                            <button class="button-link red-color">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    @endif
</aside>
