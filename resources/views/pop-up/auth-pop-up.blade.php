<section class="pop-up">
    <ul class="pop-up-list">
        <li class="pop-up-item auth-box hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Авторизация
                </div>
            </div>

            <div class="pop-up-body">
                <form class="js-response" data-form="js-auth" method="POST"
                      action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="pop-up-body-list">
                        <li class="pop-up-body-item">
                            <label class="auth-label label-style">
                                Логин (email):
                                <input class="auth-input" name="email" required type="text"/>
                            </label>

                        </li>
                        <li class="pop-up-body-item passwordError emailError" data-notification="Вывод ошибки">
                            <label class="auth-label label-style">
                                Пароль
                                <input class="auth-input" name="password" required type="password"/>
                            </label>
                        </li>
                    </ul>

                    <div class="pop-up-footer">
                        <article class="pop-up-link js-recovery">Восстановить пароль</article>

                        <div class="button-box">
                            <button class="button-link red-color js-button">
                                Войти
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
        </li>

        <li class="pop-up-item recovery-box hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Восстановление пароля
                </div>
            </div>

            <div class="pop-up-body">
                <form class="js-response" data-form="js-recovery" method="POST"
                      action="{{ route('recovery.email') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="pop-up-body-list">
                        <li class="pop-up-body-item">
                            <label class="auth-label label-style loginError">
                                Логин (email):
                                <input class="auth-input" name="email" required type="text"/>
                            </label>

                        </li>
                        <li class="pop-up-body-item pop-up-info emailError" data-notification="Вывод ошибки">
                            Для восстановления пароля укажите свой email указанный для регистрации,
                            мы вышлем инструкцию по восстановлению пароля.
                        </li>
                    </ul>

                    <div class="pop-up-footer">
                        <article class="pop-up-link js-recovery">Вход в личный кабинет</article>

                        <div class="button-box">
                            <button class="button-link red-color js-button">
                                Восстановить пароль
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
        </li>

        <li class="pop-up-item js-changed hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Редактирование пароля
                </div>
            </div>
            <div class="pop-up-body">
                @isset($user)
                    <form class="js-response" data-form="js-change" method="POST"
                          action="{{ route('api.v1.user.changePassword', $user) }}" enctype="multipart/form-data">
                        @endif
                        @csrf
                        @method('PUT')
                        <ul class="pop-up-body-list">
                            <li class="pop-up-body-item current_passwordError">
                                <label class="auth-label label-style">
                                    *Текущий пароль:
                                    <input class="auth-input" name="current_password" id="current_password"
                                           required type="password"/>
                                </label>

                            </li>
                            <li class="pop-up-body-item">
                                <label class="auth-label label-style">
                                    *Новый пароль:
                                    <input class="auth-input" name="password" id="password" required
                                           type="password"/>
                                </label>

                            </li>
                            <li class="pop-up-body-item passwordError">
                                <label class="auth-label label-style">
                                    *Подтверждение нового
                                    пароля:
                                    <input class="auth-input" name="password_confirmation"
                                           id="password_confirmation" required type="password"/>
                                </label>

                            </li>
                        </ul>

                        <div class="pop-up-button regular regular-button ">
                            <div class="button-link red-color js-close">
                                Закрыть
                            </div>
                            <button class="button-link js-button green-color">
                                Сохранить новый пароль
                            </button>

                            <div class="await-response js-preloader hide">
                                <div class="wrap-spin ">
                                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                </div>
                                <article>Обработка</article>
                            </div>
                        </div>
                    </form>
            </div>
        </li>

        @if (auth()->check())
            @isset($patients)
        <li class="pop-up-item order-box hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Выбор пациента
                </div>
            </div>

            <div class="pop-up-body">
                <div class="js-make-form" data-form="js-order">
                    @csrf
                    <ul class="pop-up-body-list">
                        <li class="pop-up-body-item  emailError" data-notification="Вывод ошибки">
                            <div class="order-wrap wrap-order-input position-column-2-3">
                                <label class="input-label" for="patient">
                                    Выберите пациента:
                                </label>
                                <select name="patient" id="patient" required class="input js-select-patient">
                                    @if (!$patients->isEmpty())
                                        <option value="">-- Выберите пациента --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{$patient->id}}">
                                            {{$patient->surname . ' ' . $patient->name . ' ' . $patient->patronymic}}
                                        </option>
                                    @endforeach
                                    @else
                                        <option value="">Нет пациентов, создайте их</option>
                                    @endif
                                </select>
                            </div>
                        </li>

                        <li class="pop-up-body-item  emailError" data-notification="Вывод ошибки">
                            <div class="position-column-2-3 wrap-order-input">
                                <article class="order-text">
                                    Нет пациента создайте
                                </article>
                                <div class="button-box">
                                    <a class="create-patient red-color"  href="{{route('profile.patient.create', auth()->user())}}">
                                        Создать пациента
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="pop-up-button regular regular-button ">
                        <div class="button-link red-color js-close">
                            Закрыть
                        </div>
                        <a class="button-link create-order-form hide js-button green-color" data-base-url="/profile/{{ auth()->user()->id }}/order" href="#">
                            Создать заказ
                        </a>

                        <div class="button-link js-attention-patient disabled">
                            Выберите пациента
                        </div>

                        <div class="await-response js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </div>
            </div>
        </li>
            @endif
        @endif

        <li class="pop-up-item message-box hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Сообщение
                </div>
            </div>

            <div class="pop-up-body">
                <form>
                    <ul class="pop-up-body-list">
                        <li class="pop-up-body-item label-style pop-up-info js-info emailError" data-notification="Вывод ошибки">
                            Ответ
                        </li>
                    </ul>

                    <div class="pop-up-button error-button hide">
                        <div class="message-box-button ">
                            <div class="button-box">
                                <div class="button-link red-color js-close">
                                    Закрыть
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pop-up-button link-button hide">
                        <div class="message-box-button ">
                            <div class="button-box">
                                <a class="button-link js-link green-color" href="">
                                    Отлично
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pop-up-button regular regular-button ">
                        <div class="button-link red-color js-close">
                            Закрыть
                        </div>
                        <a class="button-link js-link green-color" href="#">
                            Восстановить пароль
                        </a>

                        <div class="await-response js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="pop-up-item info-message-box hide">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Сообщение
                </div>
            </div>

            <div class="pop-up-body">
                <form>
                    <ul class="pop-up-body-list">
                        <li class="pop-up-body-item label-style pop-up-info js-info emailError" data-notification="Вывод ошибки">
                            Ответ
                        </li>
                    </ul>

                    <div class="pop-up-button link-button hide">
                        <div class="message-box-button ">
                            <div class="button-box">
                                <div class="button-link js-view-close green-color">
                                    Отлично
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="pop-up-item view-product-box hide">
            <div class="order-choice-item position-row-auto-fr">
                <div class="pop-up-header">
                    <div class="pop-up-close">
                        <i class="fa fa-times js-close-view" aria-hidden="true"></i>
                    </div>
                    <div class="pop-up-title">
                        Выбор комплектующих
                    </div>
                </div>
                <div class="wrap-choice-img">
                    <img class="item-img" src="../img/temp/2.jpg" alt="Fadvis">
                    <div class="filter">
                        <div class="filter-box-order">
                            <article class="filter-article">
                                Кисть функционально-косметическая CYBER-M правая XS
                            </article>
                        </div>
                    </div>
                </div>
                <ul class="product-info-list">
                    <li class="product-info-item">
                        <article class="description">Цена:</article>
                        <article class="description" data-field="price">17000 <i class="fa fa-ruble"></i> </article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Размер:</article>
                        <article class="description" data-field="size">XXS</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Сторона протезирования:</article>
                        <article class="description" data-field="side">Левая</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Протез:</article>
                        <article class="description" data-field="type">Рука</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Узел протеза:</article>
                        <article class="description" data-field="level">Плечевой узел</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Объем пястья, см:</article>
                        <article class="description" data-field="volume_size">Индивидуально</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Длина от запястья до конца среднего пальца, см:</article>
                        <article class="description" data-field="lenght_size">Индивидуально</article>
                    </li>
                    <li class="product-info-item">
                        <article class="description">Производитель:</article>
                        <article class="description" data-field="manufacturer">Fadvis</article>
                    </li>
                </ul>
            </div>
        </li>

        @if (isset($order) && $order)
            <li class="pop-up-item resend-box hide">
                <div class="pop-up-header">
                    <div class="pop-up-close">
                        <i class="fa fa-times js-close" aria-hidden="true"></i>
                    </div>
                    <div class="pop-up-title">
                        Переслать заказ
                    </div>
                </div>

                <div class="pop-up-body">
                    <form class="js-response" data-form="js-create" method="POST" action="{{ route('api.v1.order.pdf.resend', $order) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="wrap-popup-box">
                            <input class="auth-input" name="email" required type="email" placeholder="Введите email"/>
                            <div class="button-box">
                                <button class="button-link red-color js-button">
                                    Отправить
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
            </li>
        @endif
    </ul>
</section>
