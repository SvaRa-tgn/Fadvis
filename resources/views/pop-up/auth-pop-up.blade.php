<section class="wrap-pop-up auth-block">
    <ul class="wrap-pop-up-content">
        <li class="pop-up-content auth-box view-form">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Авторизация
                </div>
            </div>
            <div class="pop-up-body">
                <form class="js-auth" method="POST" data-auth="auth" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="pop-up-list">
                        <li class="pop-up-item">
                            <label class="auth-label">
                                Логин (email):
                                <input class="auth-input" name="email" required type="text"/>
                            </label>

                        </li>
                        <li class="pop-up-item notification emailError" data-notification="Вывод ошибки">
                            <label class="auth-label">
                                Пароль
                                <input class="auth-input" name="password" required type="password"/>
                            </label>
                        </li>
                    </ul>
                    <div class="pop-up-button-box">
                        <article class="pop-up-link">Восстановить пароль</article>
                        <button class="pop-up-button js-button">Войти</button>
                        <div class="wrap-pop-up-button js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="pop-up-content recovery-box">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Восстановление пароля
                </div>
            </div>
            <div class="pop-up-body">
                <form class="js-auth" method="POST" data-auth="reset" action="{{ route('recovery.email') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="pop-up-list">
                        <li class="pop-up-item notification" data-notification="Вывод ошибки">
                            <label class="auth-label">
                                Логин (email):
                                <input class="auth-input" name="email" required type="text"/>
                            </label>
                        </li>
                        <li class="pop-up-item notification-item">
                            Для восстановления пароля укажите свой email указанный для регистрации,
                            на этот email мы вышлем инструкцию по восстановлению пароля.
                        </li>
                    </ul>
                    <div class="pop-up-button-box">
                        <article class="pop-up-link">Вход в личный кабинет</article>
                        <button class="pop-up-button js-button">Восстановить пароль</button>

                        <div class="wrap-pop-up-button js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</section>
