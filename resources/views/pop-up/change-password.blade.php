<section class="wrap-pop-up change-password-block">
    <ul class="wrap-pop-up-content">
        <li class="pop-up-content update-content update-box view-form">
            <div class="update-header">
                <div class="update-close">
                    <i class="fa fa-times js-close" aria-hidden="true"></i>
                </div>
                <div class="update-title">
                    Редактирование пароля
                </div>
            </div>
            <div class="update-body">
                @isset($user)
                <form class="update-form js-response" data-form="changed" method="POST" action="{{ route('api.v1.user.changePassword', $user->id) }}" enctype="multipart/form-data">
                    @else
                        <form class="update-form js-response" method="POST" action="" enctype="multipart/form-data">
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="input-wrap current_passwordError" data-notification="Вывод ошибки">
                        <label class="input-label" for="current_password">*Текущий пароль</label>
                        <input class="input update-block-alt" name="current_password" id="current_password" required type="password"/>
                    </div>

                    <div class="input-wrap passwordError" data-notification="Вывод ошибки">
                        <label class="input-label" for="password">*Новый пароль</label>
                        <input class="input update-block-alt" name="password" id="password" required type="password"/>
                    </div>

                    <div class="input-wrap passwordError" data-notification="Вывод ошибки">
                        <label class="input-label" for="password_confirmation">*Подтверждение нового пароля</label>
                        <input class="input update-block-alt" name="password_confirmation" id="password_confirmation" required type="password"/>
                    </div>

                    <div class="update-button-box">
                        <div class="update-button update-link js-close" >Закрыть</div>
                        <button class="update-button">Сохранить</button>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</section>
