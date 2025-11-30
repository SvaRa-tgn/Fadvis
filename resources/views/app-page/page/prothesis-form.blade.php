@extends('/index')
@section('content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title">
                    Заявка на протез
                </div>
                <form class="form js-response" method="POST" action="{{ route('api.v1.prothesis.create') }}">
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

                        <div class="input-wrap cityError">
                            <label class="input-label" for="city">Ваш город (обязательно)</label>
                            <input class="input" name="city" id="city" required type="text"/>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="title-form">
                            Сколько Вам лет?
                        </div>
                        @foreach($ages as $age)
                            <div class="checkbox-wrap padding-form">
                                <label class="checkbox-label" for="small">{{$age->caption()}}</label>
                                <input class="checkbox" name="age_period" id="small" type="radio" value="{{$age->value}}"/>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="title-form">
                            Есть ли у Вас ИПРА или ПРП? (обязательно)
                        </div>
                        <div class="wrap-description-form">
                            <article class="description-form">
                                ИПРА - индивидуальная программа реабилитации или абилитации
                            </article>
                            <article class="description-form">
                                ПРП - программа реабилитации пострадавшего
                            </article>
                        </div>

                        <div class="checkbox-wrap padding-form">
                            <label class="checkbox-label" for="check">Есть</label>
                            <input class="checkbox" name="is_program" id="check" type="radio" value="1"/>
                        </div>

                        <div class="checkbox-wrap">
                            <label class="checkbox-label" for="no-check">Нет</label>
                            <input class="checkbox" name="is_program" id="no-check" type="radio" value="0"/>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap">
                            <label class="input-label" for="function">Какой тип функциональности рассматриваете?</label>
                            <select class="input" name="prothesis_function" id="function">
                                <option value="cosmetic">Косметический/рабочий - сменные насадки</option>
                                <option value="active">Активный тяговый - сгибание/разгибание за счёт тяг</option>
                                <option value="mechanic">Электромеханический - сгибание/разгибание от датчиков на коже</option>
                            </select>
                        </div>

                        <div class="input-wrap padding-form">
                            <label class="input-label" for="prosthesis-type">Тип протеза</label>
                            <select class="input" name="type" id="prosthesis-type">
                                <option value="forearm">Протез предплечья</option>
                                <option value="shoulder">Протез плеча</option>
                                <option value="part_shoulder">Протез вычленения плеча</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
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
