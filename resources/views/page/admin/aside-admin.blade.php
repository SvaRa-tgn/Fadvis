<aside class="aside">
    @if (Auth::user()->role === \App\Enum\UserRoles::MASTER->value)
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
                                          Route::currentRouteName() === 'admin.user.update'
                                          )
            active-menu-link @endif" href="{{route('admin.user.list')}}">Контрагенты</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link " href="admin-orders-list.html">Заказы</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.category.list' ||
                                          Route::currentRouteName() === 'admin.category.create' ||
                                          Route::currentRouteName() === 'admin.category.update'
                                          )

            active-menu-link @endif" href="{{route('admin.category.list')}}">Категории</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.color.list' ||
                                          Route::currentRouteName() === 'admin.color.create' ||
                                          Route::currentRouteName() === 'admin.color.update'
                                          )

            active-menu-link @endif" href="{{route('admin.color.list')}}">Цвета</a>
        </li>
        <li class="aside-menu-item">
            <a class="aside-menu-link @if(Route::currentRouteName() === 'admin.product.list' ||
                                          Route::currentRouteName() === 'admin.product.create' ||
                                          Route::currentRouteName() === 'admin.product.update'
                                          )

            active-menu-link @endif" href="{{route('admin.product.list')}}">Товары</a>
        </li>
        <li class="aside-menu-item">
            <form class="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="pop-up-button-box">
                    <button class="aside-button js-button">Выйти из аккаунта</button>
                    <div class="wrap-pop-up-button js-preloader hide">
                        <div class="wrap-spin ">
                            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                        </div>
                        <article>Обработка</article>
                    </div>
                </div>
            </form>
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
            active-menu-link @endif" href="{{route('profile.patient.list', $user->id)}}">Пациенты</a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link @if(Route::currentRouteName() === 'profile.order.list' ||
                                              Route::currentRouteName() === 'profile.order.create' ||
                                              Route::currentRouteName() === 'profile.order.update'
                                          )
            active-menu-link @endif" href="{{route('profile.order.list', $user->id)}}">Заказы</a>
            </li>
            <li class="aside-menu-item">
                <form class="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="pop-up-button-box">
                        <button class="aside-button js-button">Выйти из аккаунта</button>
                        <div class="wrap-pop-up-button js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    @endif
</aside>
