@extends('/index')
@section('content')
    <div class="main-content for-phone">
        <section class="form-wrap">
            <div class="form-title">
                Заявка на протез
            </div>
            <form class="form js-response" data-form="js-create" method="POST" action="{{ route('api.v1.prothesis.create') }}">
                @csrf
                <div class="form-block form-block-alt">
                    <div class="input-wrap nameError">
                        <label class="input-label" for="name">Имя (обязательно)</label>
                        <input class="input" name="name" id="name" required type="text"/>
                    </div>

                    <div class="input-wrap surnameError">
                        <label class="input-label" for="surname">Фамилия (обязательно)</label>
                        <input class="input" name="surname" id="surname" required type="text"/>
                    </div>

                    <div class="input-wrap patronymicError">
                        <label class="input-label" for="patronymic">Отчество</label>
                        <input class="input" name="patronymic" id="patronymic" type="text"/>
                    </div>

                    <div class="input-wrap phoneError">
                        <label class="input-label" for="phone">Телефон (обязательно)</label>
                        <input class="input" name="phone" id="phone" required type="tel"/>
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

                <div class="form-block form-block-alt ">
                    <div class="title-form application-label">
                        Сколько Вам лет?
                    </div>
                    @foreach($ages as $age)
                        <div class="checkbox-wrap padding-form app-label">
                            <input class="checkbox" name="age_period" id="small" type="radio" value="{{$age->value}}"/>
                            <label class="checkbox-label" for="small">{{$age->caption()}}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-block form-block-alt is_programError">
                    <div class="title-form application-label">
                        Есть ли у Вас ИПРА или ПРП? (обязательно)
                    </div>
                    <div class="wrap-description-form">
                        <article class="description-form application-label">
                            ИПРА - индивидуальная программа реабилитации или абилитации
                        </article>
                        <article class="description-form application-label padding-bottom">
                            ПРП - программа реабилитации пострадавшего
                        </article>
                    </div>

                    <div class="checkbox-wrap padding-form app-label">
                        <input class="checkbox" name="is_program" id="check" type="radio" value="1"/>
                        <label class="checkbox-label" for="check">Есть</label>
                    </div>

                    <div class="checkbox-wrap app-label">
                        <input class="checkbox" name="is_program" id="no-check" type="radio" value="0"/>
                        <label class="checkbox-label" for="no-check">Нет</label>
                    </div>
                </div>

                <div class="form-block form-block-alt">
                    <div class="input-wrap">
                        <label class="input-label" for="prothesis_function">Какой тип функциональности рассматриваете?</label>
                        <select class="input" name="prothesis_function" id="prothesis_function">
                            @foreach(\App\Enum\ProthesisFunction::getAllTypes() as $function)
                                <option value="{{$function->value}}">{{$function->caption()}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-wrap padding-form">
                        <label class="input-label" for="prosthesis_level">Тип протеза</label>
                        <select class="input" name="prosthesis_level" id="prosthesis-type">
                            @foreach(\App\Enum\ProthesisLevel::getAllTypes() as $level)
                                @if ($level !== \App\Enum\ProthesisLevel::UNIVERSAL_KNOT)
                                    <option value="{{$level->value}}">{{$level->caption()}}</option>
                                @endif
                            @endforeach
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

                    <div class="button-box">
                        <button class="button-link js-button red-color">
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
        </section>
    </div>
@endsection
