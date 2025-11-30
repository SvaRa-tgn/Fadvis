@extends('/index')
@section('content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title">
                    Заявка на прайс
                </div>
                <form class="form js-response" method="POST" action="{{ route('api.v1.price.create') }}">
                    @csrf
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError">
                            <label class="input-label" for="surname">Фамилия (обязательно)</label>
                            <input class="input" name="surname" id="surname" required type="text"/>
                        </div>

                        <div class="input-wrap nameError">
                            <label class="input-label" for="name">Имя (обязательно)</label>
                            <input class="input" name="name" id="name" required type="text"/>
                        </div>

                        <div class="input-wrap patronymicError">
                            <label class="input-label" for="patronymic">Отчество (При наличии)</label>
                            <input class="input" name="patronymic" id="patronymic" type="text"/>
                        </div>

                        <div class="input-wrap phoneError">
                            <label class="input-label" for="phone">Телефон (обязательно)</label>
                            <input class="input" name="phone" id="phone" placeholder="+79991112233" required type="tel"/>
                        </div>

                        <div class="input-wrap emailError">
                            <label class="input-label" for="email">Email (обязательно)</label>
                            <input class="input" name="email" id="email" required type="email"/>
                        </div>

                        <div class="input-wrap organizationError">
                            <label class="input-label" for="organization">Компания (обязательно)</label>
                            <input class="input" name="organization" id="organization" required type="text"/>
                        </div>

                        <div class="input-wrap cityError">
                            <label class="input-label" for="city">Ваш город (обязательно)</label>
                            <input class="input" name="city" id="city" required type="text"/>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap">
                            <label class="input-label" for="interest">Что особенно заинтересовало?</label>
                            <input class="input" name="interest" id="interest" type="text"/>
                        </div>

                        <div class="input-wrap text-area-block">
                            <label class="input-label" for="questions">Есть дополнительные вопросы?</label>
                            <textarea class="input text-area" name="questions" id="questions"></textarea>
                        </div>
                    </div>

                    <div class="form-block">
                        <div class="attention-wrap">
                            * Отправляя заявку Вы соглашаетесь с Политикой обработки персональных данных
                        </div>

                        <div class="wrap-button js-button">
                            <button class="button">Отправить заявку</button>
                        </div>

                        <div class="wrap-pop-up-button js-preloader hide">
                            <div class="wrap-spin ">
                                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                            </div>
                            <article>Обработка</article>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection
