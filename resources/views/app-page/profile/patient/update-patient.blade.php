@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="admin">
            <section class="wrap-user-data-profile user-data">
                <div class="admin-title">
                    <div class="admin-title-page">
                        Редактирование пациента
                    </div>
                </div>
                <form class="form-admin js-response" data-form="js-create" method="POST" action="{{ route('api.v1.patient.update', [$user, $patient]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-block form-block-alt">
                        <div class="input-wrap surnameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="surname">Фамилия</label>
                            <input class="input" name="surname" id="surname" type="text" value="{{$patient->surname}}"/>
                        </div>

                        <div class="input-wrap nameError" data-notification="Вывод ошибки">
                            <label class="input-label" for="name">Имя</label>
                            <input class="input" name="name" id="name" type="text" value="{{$patient->name}}"/>
                        </div>

                        <div class="input-wrap patronymicError" data-notification="Вывод ошибки">
                            <label class="input-label" for="patronymic">Отчество</label>
                            <input class="input" name="patronymic" id="patronymic" type="text" value="{{$patient->patronymic}}"/>
                        </div>

                        <div class="input-wrap date_birthError" data-notification="Вывод ошибки">
                            <label class="input-label" for="date_birth">Дата рождения</label>
                            <input class="input" name="date_birth" id="date_birth" type="date" value="{{$patient->birth_date->format('Y-m-d')}}"/>
                        </div>

                        <div class="input-wrap genderError" data-notification="Вывод ошибки">
                            <label class="input-label" for="gender">Пол</label>
                            <select class="input" name="gender" id="gender">
                                <option value="{{$patient->gender}}">{{$patient->gender->caption()}}</option>
                                @foreach($genders as $gender)
                                    @if ($patient->gender !== $gender)
                                        <option value="{{$gender->value}}">{{$gender->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap emailError" data-notification="Вывод ошибки">
                            <label class="input-label" for="email">Email</label>
                            <input class="input" name="email" id="email" type="email" value="{{$patient->email}}"/>
                        </div>

                        <div class="input-wrap phoneError" data-notification="Вывод ошибки">
                            <label class="input-label" for="phone">Телефон</label>
                            <input class="input" name="phone" id="phone" type="tel" value="{{$patient->phone}}"/>
                        </div>

                        <div class="input-wrap messengerError" data-notification="Вывод ошибки">
                            <label class="input-label" for="messenger">Мессенджер</label>
                            <select class="input" name="messenger" id="messenger">
                                <option value="{{$patient->messenger}}">{{$patient->messenger}}</option>
                                @foreach($messengers as $messenger)
                                    @if ($patient->messenger->value !== $messenger)
                                        <option value="{{$messenger}}">{{$messenger}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-block form-block-alt">
                        <div class="input-wrap left_typeError" data-notification="Вывод ошибки">
                            <label class="input-label" for="left_type">Протезирование Левой стороны</label>
                            <select class="input js-left-select" name="left_type" id="left_type">
                                @if ($patient->left_type === null)
                                    <option value="null">Не нужно</option>
                                    @foreach($types as $type)
                                        <option value="{{$type}}">{{$type->caption()}}</option>
                                    @endforeach
                                @else
                                    <option value="{{$patient->left_type}}">{{$patient->left_type->caption()}}</option>
                                    @foreach($types as $type)
                                        @if ($patient->left_type !== $type)
                                            <option value="{{$type}}">{{$type->caption()}}</option>
                                        @endif
                                    @endforeach
                                    <option value="null">Не нужно</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-wrap right_typeError" data-notification="Вывод ошибки">
                            <label class="input-label" for="right_type">Протезирование Правой стороны</label>
                            <select class="input js-right-select" name="right_type" id="right_type">
                                @if ($patient->right_type === null)
                                    <option value="null">Не нужно</option>
                                    @foreach($types as $type)
                                        <option value="{{$type}}">{{$type->caption()}}</option>
                                    @endforeach
                                @else
                                    <option value="{{$patient->right_type}}">{{$patient->right_type->caption()}}</option>
                                    @foreach($types as $type)
                                        @if ($patient->right_type !== $type)
                                            <option value="{{$type}}">{{$type->caption()}}</option>
                                        @endif
                                    @endforeach
                                    <option value="null">Не нужно</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-block form-block-alt js-select-level hide">
                        <div class="input-wrap left_typeError hide" data-notification="Вывод ошибки">
                            <label class="input-label" for="left_level_hand">Протезирование Левой руки</label>
                            <select class="input js-left-hand" id="left_level_hand" >
                                <option value="{{$patient->left_level}}">{{$patient->left_level->caption()}}</option>
                                @foreach($hands as $hand)
                                    @if ($hand !== \App\Enum\ProthesisLevel::UNIVERSAL_KNOT && $hand !== $patient->left_level)
                                        <option value="{{$hand}}">{{$hand->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap typeError hide" data-notification="Вывод ошибки">
                            <label class="input-label" for="left_level_wrist">Протезирование Левой кисти</label>
                            <select class="input js-left-wrist" id="left_level_wrist" >
                                <option value="{{$patient->left_level}}">{{$patient->left_level->caption()}}</option>
                                @foreach($wrists as $wrist)
                                    @if ($wrist !== $patient->left_level)
                                        <option value="{{$wrist}}">{{$wrist->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap left_typeError hide" data-notification="Вывод ошибки">
                            <label class="input-label" for="right_level_hand">Протезирование Правой руки</label>
                            <select class="input js-right-hand" id="right_level_hand" >
                                <option value="{{$patient->right_level}}">{{$patient->right_level->caption()}}</option>
                                @foreach($hands as $hand)
                                    @if ($hand !== \App\Enum\ProthesisLevel::UNIVERSAL_KNOT && $hand !== $patient->right_level)
                                        <option value="{{$hand}}">{{$hand->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-wrap typeError hide" data-notification="Вывод ошибки">
                            <label class="input-label" for="right_level_wrist">Протезирование Правой кисти</label>
                            <select class="input js-right-wrist" id="right_level_wrist" >
                                <option value="{{$patient->right_level}}">{{$patient->right_level->caption()}}</option>
                                @foreach($wrists as $wrist)
                                    @if ($wrist !== $patient->right_level)
                                        <option value="{{$wrist}}">{{$wrist->caption()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!--<div class="form-block form-block-alt">
                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото (Необязательно)</label>
                            <input class="input" name="first_img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>

                        <div class="input-wrap imgError">
                            <label class="input-label" for="img">Выберите фото (Необязательно)</label>
                            <input class="input" name="second_img" id="img" type="file" accept="image/png, image/jpeg"/>
                        </div>
                    </div>-->

                    <div class="regular-button position-column-2-2">
                        <div class="button-box">
                            <a class="button-link red-color" href="{{route('profile.patient.list', $user)}}">
                                Отменить
                            </a>
                        </div>

                        <div class="button-box">
                            <button class="button-link js-button green-color">
                                Сохранить
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
    </main>
@endsection
