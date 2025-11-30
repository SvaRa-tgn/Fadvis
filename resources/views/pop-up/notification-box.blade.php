<section class="wrap-pop-up notification-block">
    <ul class="wrap-pop-up-content">
        <li class="pop-up-content notification-box view-form">
            <div class="pop-up-header">
                <div class="pop-up-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="pop-up-title">
                    Сообщение
                </div>
            </div>
            <div class="pop-up-body">
                <ul class="pop-up-list">
                    <li class="pop-up-item notification body-message" data-notification="Вывод ошибки">
                        Тело сообщения.
                    </li>
                </ul>
                <div class="message-button-box">
                    @if(Route::currentRouteName() === route('master.user'))
                        <a class="pop-up-button link-admin" href="{{route('main')}}">Отлично</a>
                        <div class="pop-up-button pop-up-switch close" >Закрыть</div>
                    @else
                        <div class="pop-up-button js-close" >Закрыть</div>
                        <a class="pop-up-button link-admin hide" href="">Перейти в личный кабинет</a>

                        <form class="logout-form link-logout hide" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="pop-up-button-box notification-button-box">
                            <button class="pop-up-button width-all js-button">Отлично</button>
                            <div class="wrap-pop-up-button js-preloader hide">
                                <div class="wrap-spin ">
                                    <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                                </div>
                                <article>Обработка</article>
                            </div>
                        </div>
                        </form>
                    @endif
                </div>
            </div>
        </li>
    </ul>
</section>
