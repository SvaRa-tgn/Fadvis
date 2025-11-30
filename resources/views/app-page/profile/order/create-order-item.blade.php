@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('profile.order.list', $user)}}">Назад</a>
                    <div class="title-box">
                        Создание заказа
                    </div>
                </div>
                <form class="form-admin js-order" method="POST" data-link="{{route('api.v1.order.create', ['user' => $user])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="order-data-profile">
                        <article class="title-data-profile">Комплектующие к заказу</article>

                        <div class="wrap-data-order">
                            <article class="data-order-title">Информация по заказу:</article>
                            <ul class="data-order-info-list">
                                <li class="data-order-info-item">
                                    <article class="article-info">Пациент:</article>
                                    <article class="article-info-data">Пацинт АА</article>
                                </li>
                                <li class="data-order-info-item">
                                    <article class="article-info">Сторона протезирования:</article>
                                    <article class="article-info-data">Левая и правая</article>
                                </li>
                                <li class="data-order-info-item">
                                    <article class="article-info">Тип протезирования левой руки:</article>
                                    <article class="article-info-data">Левая и правая</article>
                                </li>
                                <li class="data-order-info-item">
                                    <article class="article-info">Тип протезирования правой руки:</article>
                                    <article class="article-info-data">Левая и правая</article>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="order-data-profile">
                        <div class="input-order">
                            <article class="select-value">Протезирование левой стороны</article>

                            <div class="select-type-block">
                                <article class="item-title">Плечевой узел</article>

                                <div class="wrap-item-select">
                                    <div class="add-item">
                                        Добавить товар
                                    </div>

                                    <div class="non-select hide">Товары не выбраны (добавьте при необходимости)</div>

                                    <ul class="item-select-list">
                                        <li class="item-select-item">
                                            <article class="article-item">КИБЕР-М.ПРА.XS.2.2</article>
                                            <article class="name-item">Кисть функционально-косметическая CYBER-M правая XS</article>
                                            <label for="quantity"><input type="number" id="quantity" value="1" min="1" max="10"></label>
                                            <article class="price-item">17000</article>
                                            <div class="item-delete">
                                                Удалить
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="select-type-block">
                                <article class="item-title">Локтевой узел</article>

                                <div class="wrap-item-select">
                                    <div class="add-item">
                                        Добавить товар
                                    </div>

                                    <div class="non-select ">Товары не выбраны (добавьте при необходимости)</div>

                                    <ul class="item-select-list hide">
                                        <li class="item-select-item">
                                            <article class="article-item">КИБЕР-М.ПРА.XS.2.2</article>
                                            <article class="name-item">Кисть функционально-косметическая CYBER-M правая XS</article>
                                            <label for="quantity"><input type="number" id="quantity" value="1" min="1" max="10"></label>
                                            <article class="price-item">17000</article>
                                            <div class="item-delete">
                                                Удалить
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="select-type-block">
                                <article class="item-title">Запястный узел</article>

                                <div class="wrap-item-select">
                                    <div class="add-item">
                                        Добавить товар
                                    </div>

                                    <div class="non-select ">Товары не выбраны (добавьте при необходимости)</div>

                                    <ul class="item-select-list hide">
                                        <li class="item-select-item">
                                            <article class="article-item">КИБЕР-М.ПРА.XS.2.2</article>
                                            <article class="name-item">Кисть функционально-косметическая CYBER-M правая XS</article>
                                            <label for="quantity"><input type="number" id="quantity" value="1" min="1" max="10"></label>
                                            <article class="price-item">17000</article>
                                            <div class="item-delete">
                                                Удалить
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="select-type-block">
                                <article class="item-title">Насадка</article>

                                <div class="wrap-item-select">
                                    <div class="add-item">
                                        Добавить товар
                                    </div>

                                    <div class="non-select ">Товары не выбраны (добавьте при необходимости)</div>

                                    <ul class="item-select-list hide">
                                        <li class="item-select-item">
                                            <article class="article-item">КИБЕР-М.ПРА.XS.2.2</article>
                                            <article class="name-item">Кисть функционально-косметическая CYBER-M правая XS</article>
                                            <label for="quantity"><input type="number" id="quantity" value="1" min="1" max="10"></label>
                                            <article class="price-item">17000</article>
                                            <div class="item-delete">
                                                Удалить
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection
