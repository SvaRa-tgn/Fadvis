<section class="wrap-pop-up new-patient-box">
    <ul class="wrap-pop-up-content">
        <li class="update-content update-box">
            <div class="update-header">
                <div class="update-close">
                    <i class="fa fa-times close-switch" aria-hidden="true"></i>
                </div>
                <div class="update-title">
                    Новый пациент
                </div>
            </div>
            <div class="update-body">
                @if (isset($user))
                    <form class="update-form js-response" data-patient="order-patient" method="POST" action="{{ route('api.v1.patient.create', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">*Фамилия</label>
                            <input class="input update-block-alt" name="surname" id="surname" required type="text"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">*Имя</label>
                            <input class="input update-block-alt" name="name" id="name" required type="text"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">*Отчество</label>
                            <input class="input update-block-alt" name="patronymic" id="patronymic" required type="text"/>
                        </div>

                        <div class="input-wrap emailError" data-notification="Вывод ошибки">
                            <label class="input-label" for="email">*Email</label>
                            <input class="input update-block-alt" name="email" id="email" required type="email"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">*Телефон</label>
                            <input class="input update-block-alt" name="phone" id="phone" required type="tel"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото (Необязательно)</label>
                            <input class="input" name="first_img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img2">Выберите фото (Необязательно)</label>
                            <input class="input" name="second_img" id="img2" type="file" accept="image/png, image/jpeg"/>
                        </div>

                        <div class="update-button-box" >
                            <div class="update-button update-link close-switch" >Закрыть</div>
                            <button class="update-button">Сохранить</button>
                        </div>
                    </form>
                @endif
            </div>
        </li>
    </ul>
</section>
