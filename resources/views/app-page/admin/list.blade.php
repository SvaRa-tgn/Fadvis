@extends('page.admin-page')
@section('admin-content')
    <section class="admin">
        <div class="wrap-user-data-profile user-list">
            <div class="admin-title position-column-2">
                <div class="create-box">
                    @if(Route::currentRouteName() === 'admin.category.list')
                        <a class="create-box-link green-color" href="{{route('admin.category.create')}}">Создать</a>
                    @elseif(Route::currentRouteName() === 'admin.color.list')
                        <a class="create-box-link green-color" href="{{route('admin.color.create')}}">Создать</a>
                    @elseif(Route::currentRouteName() === 'admin.user.list')
                        <a class="create-box-link green-color" href="{{route('admin.user.create')}}">Создать</a>
                    @elseif(Route::currentRouteName() === 'admin.product.list')
                        <a class="create-box-link green-color" href="{{route('admin.product.create')}}">Создать</a>
                    @elseif(Route::currentRouteName() === 'profile.patient.list')
                        <a class="create-box-link green-color" href="{{route('profile.patient.create', $user->id)}}">Создать</a>
                    @elseif(Route::currentRouteName() === 'profile.order.list')
                        <span class="create-box-link green-color js-order-up" data-user="{{$user->id}}">Создать</span>
                    @endif
                </div>
                <div class="admin-title-page">
                    @if(Route::currentRouteName() === 'admin.category.list')
                        Список категорий
                    @elseif(Route::currentRouteName() === 'admin.color.list')
                        Список цветов
                    @elseif(Route::currentRouteName() === 'admin.order.list')
                        Список заказов
                    @elseif(Route::currentRouteName() === 'admin.user.list')
                        Список контрагентов
                    @elseif(Route::currentRouteName() === 'admin.product.list')
                        Список товаров
                    @elseif(Route::currentRouteName() === 'profile.patient.list')
                        Список пациентов
                    @elseif(Route::currentRouteName() === 'profile.order.list')
                        Список заказов
                    @endif

                </div>
            </div>
            <div class="user-data-profile for-list">
                <ul class="data-list-admin">
                    @if(Route::currentRouteName() === 'admin.user.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">ФИО</article>
                            <article class="data-list-item-article">Организация</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'admin.product.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">Название</article>
                            <article class="data-list-item-article">Категория</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'profile.patient.list')
                        <li class="data-list-item pos-list-profile">
                            <article class="data-list-item-article">ФИО</article>
                            <article class="data-list-item-article">Телефон</article>
                            <article class="data-list-item-article">Email</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'profile.order.list')
                        <li class="data-list-item pos-order-profile">
                            <article class="data-list-item-article">Номер</article>
                            <article class="data-list-item-article">Пациент</article>
                            <article class="data-list-item-article">Сумма</article>
                            <article class="data-list-item-article">Дата</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'admin.order.list')
                        <li class="data-list-item pos-order-admin">
                            <article class="data-list-item-article">Номер</article>
                            <article class="data-list-item-article">Контрагент</article>
                            <article class="data-list-item-article">Пациент</article>
                            <article class="data-list-item-article">Сумма</article>
                            <article class="data-list-item-article">Дата</article>
                        </li>
                    @else
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">Название</article>
                        </li>
                    @endif

                        @if(Route::currentRouteName() === 'profile.patient.list')
                        @if(!$patients->isEmpty())
                            @foreach($patients as $patient)
                                <li class="data-list-item pos-list-profile">
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('profile.patient.update', [$user->id, $patient->id])}}">
                                            {{$patient->surname. ' '
                                                . $patient->name
                                                . ' ' . ($patient->patronymic ?: '')}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$patient->phone}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$patient->email}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Пациенты пока не созданы</article>
                            </li>
                        @endif
                    @endif

                    @if(Route::currentRouteName() === 'profile.order.list')
                        @if(!$orders->isEmpty())
                            @foreach($orders as $order)
                                <li class="data-list-item pos-order-profile">
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('profile.order.show', ['user' => $user->id, 'order' => $order->number])}}">
                                            {{$order->number}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->patient->surname. ' '
                                                 . $order->patient->name
                                                 . ' ' . ($order->patient->patronymic ?: '')}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->formatted_total}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->created_at->format('d.m.Y')}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Заказы пока не созданы</article>
                            </li>
                        @endif
                    @endif

                    @if(Route::currentRouteName() === 'admin.user.list')
                        @if(!$users->isEmpty())
                            @foreach($users as $user)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$user->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.user.update', $user->id)}}">
                                            {{$user->surname. ' ' . Str::substr($user->name, 0, 1) . ' ' . Str::substr($user->patronymic, 0, 1)}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$user->organization}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Контрагенты пока не созданы</article>
                            </li>
                        @endif
                    @endif

                    @if(Route::currentRouteName() === 'admin.order.list')
                        @if(!$orders->isEmpty())
                            @foreach($orders as $order)
                                <li class="data-list-item pos-order-admin">
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.order.show', ['order' => $order->number])}}">
                                            {{$order->number}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->user->surname. ' '
                                                 . $order->user->name
                                                 . ' ' . ($order->user->patronymic ?: '')}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->patient->surname. ' '
                                                 . $order->patient->name
                                                 . ' ' . ($order->patient->patronymic ?: '')}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->formatted_total}}
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->created_at->format('d.m.Y')}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Заказы пока не созданы</article>
                            </li>
                        @endif
                    @endif
                    @if(Route::currentRouteName() === 'admin.category.list')
                        @if(!$categories->isEmpty())
                            @foreach($categories as $category)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$category->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.category.update', $category)}}">
                                            {{$category->name}}
                                        </a>
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Категории пока не созданы</article>
                            </li>
                        @endif
                    @endif
                    @if(Route::currentRouteName() === 'admin.color.list')
                        @if(!$colors->isEmpty())
                            @foreach($colors as $color)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$color->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.color.update', $color)}}">
                                            {{$color->name}}
                                        </a>
                                    </article>
                                    <article
                                        class="data-list-item-article @if($color->status->value === 'active') active-status @else deactive-status @endif">
                                        {{$color->status->caption()}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Цвета пока не созданы</article>
                            </li>
                        @endif
                    @endif
                    @if(Route::currentRouteName() === 'admin.product.list')
                        @if(!$products->isEmpty())
                            @foreach($products as $product)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$product->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.product.update', $product)}}">
                                            {{$product->name}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$product->category->name}}
                                    </article>
                                </li>
                            @endforeach
                        @else
                            <li class="data-list-item">
                                <article class="data-list-item-article">#</article>
                                <article class="data-list-item-article">Товары пока не созданы</article>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </section>
@endsection
