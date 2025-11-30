<section class="wrap-pop-up wrap-pop-up-active reset-block">
    <ul class="wrap-pop-up-content">
        <li class="pop-up-content auth-box view-form">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Восстановление пароля
                </div>
            </div>
            <div class="pop-up-body">
                <form class="js-auth" method="POST" data-auth="auth" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <ul class="pop-up-list">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <li class="pop-up-item">
                            <label class="auth-label">
                                Логин (email):
                                <input class="auth-input" name="email" required type="text"/>
                            </label>

                        </li>
                        <li class="pop-up-item notification passwordError" data-notification="Вывод ошибки">
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
    </ul>
</section>
