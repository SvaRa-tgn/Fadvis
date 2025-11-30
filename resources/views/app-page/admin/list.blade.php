@extends('page.admin-page')
@section('admin-content')
    <section class="admin">
        <div class="wrap-user-data-profile user-list">
            <div class="wrap-admin-header">
                <div class="create-box">
                    @if(Route::currentRouteName() === 'admin.category.list')
                        <a class="create-box-link" href="{{route('admin.category.create')}}">Создать категорию</a>
                    @elseif(Route::currentRouteName() === 'admin.color.list')
                        <a class="create-box-link" href="{{route('admin.color.create')}}">Создать цвет</a>
                    @elseif(Route::currentRouteName() === 'admin.user.list')
                        <a class="create-box-link" href="{{route('admin.user.create')}}">Создать контрагента</a>
                    @elseif(Route::currentRouteName() === 'admin.product.list')
                        <a class="create-box-link" href="{{route('admin.product.create')}}">Создать товар</a>
                    @elseif(Route::currentRouteName() === 'profile.patient.list')
                        <a class="create-box-link" href="{{route('profile.patient.create', $user->id)}}">Создать пациента</a>
                    @elseif(Route::currentRouteName() === 'profile.order.list')
                        <a class="create-box-link" href="{{route('profile.order.create', $user->id)}}">Создать заказ</a>
                    @endif
                </div>
                <div class="admin-title">
                    @if(Route::currentRouteName() === 'admin.category.list')
                        Список категорий
                    @elseif(Route::currentRouteName() === 'admin.color.list')
                        Список цветов
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
            <div class="user-data-profile">
                <ul class="data-list">
                    @if(Route::currentRouteName() === 'admin.user.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">ФИО</article>
                            <article class="data-list-item-article">Организация</article>
                            <article class="data-list-item-article">Статус</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'admin.product.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">Название</article>
                            <article class="data-list-item-article">Категория</article>
                            <article class="data-list-item-article">Статус</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'profile.patient.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">ФИО</article>
                            <article class="data-list-item-article">Телефон</article>
                            <article class="data-list-item-article">Email</article>
                        </li>
                    @elseif(Route::currentRouteName() === 'profile.order.list')
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">Пациент</article>
                            <article class="data-list-item-article">Сумма</article>
                            <article class="data-list-item-article">Дата</article>
                        </li>
                    @else
                        <li class="data-list-item">
                            <article class="data-list-item-article">ID</article>
                            <article class="data-list-item-article">Название</article>
                            <article class="data-list-item-article">Статус</article>
                        </li>
                    @endif

                    @if(Route::currentRouteName() === 'profile.patient.list')
                        @if(!$patients->isEmpty())
                            @foreach($patients as $patient)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$patient->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('profile.patient.update', [$user->id, $patient->id])}}">
                                            {{$patient->surname. ' ' . Str::substr($patient->name, 0, 1) . ' ' . Str::substr($patient->patronymic, 0, 1)}}
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
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$order->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                            href="{{route('profile.patient.update', [$user->id, $order->id])}}">
                                            {{$order->number}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$order->total_amount}}
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
                                    <article class="data-list-item-article @if($user->getStatus()->value === 'active') active-status @else deactive-status @endif">
                                        {{\App\Enum\Status::tryFrom($user->status)->caption()}}
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
                    @if(Route::currentRouteName() === 'admin.category.list')
                        @if(!$categories->isEmpty())
                            @foreach($categories as $category)
                                <li class="data-list-item">
                                    <article class="data-list-item-article">{{$category->id}}</article>
                                    <article class="data-list-item-article">
                                        <a class="data-list-item-link"
                                           href="{{route('admin.category.update', $category->id)}}">
                                            {{$category->name}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article @if($category->getStatus()->value === 'active') active-status @else deactive-status @endif">
                                        {{\App\Enum\Status::tryFrom($category->status)->caption()}}
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
                                           href="{{route('admin.color.update', $color->id)}}">
                                            {{$color->name}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article @if($color->getStatus()->value === 'active') active-status @else deactive-status @endif">
                                        {{\App\Enum\Status::tryFrom($color->status)->caption()}}
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
                                           href="{{route('admin.product.update', $product->id)}}">
                                            {{$product->name}}
                                        </a>
                                    </article>
                                    <article class="data-list-item-article">
                                        {{$product->category->name}}
                                    </article>
                                    <article class="data-list-item-article @if($product->getStatus()->value === 'active') active-status @else deactive-status @endif">
                                        {{$product->getStatus()->caption()}}
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
