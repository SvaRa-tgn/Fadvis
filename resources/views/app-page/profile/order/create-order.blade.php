@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <section class="admin">
            <div class="wrap-user-data-profile user-data">
                <div class="admin-title">
                    <div class="admin-title-page">
                        Новый заказ
                    </div>
                </div>

                <form class="js-response" method="POST" data-form="js-create"
                      action="{{ route('api.v1.order.create', ['user' => $user, 'patient' => $patient]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="order-info">
                        <div class="wrap-order-block">
                            <div class="user-data-profile position-row-fr-auto">
                                <div class="order-title">
                                    Пациент
                                </div>

                                <div class="wrap-order-body js-data-patient" data-patient="{{$patient}}">
                                    <div class="order-body">
                                        <ul class="order-patient-list">
                                            <li class="order-patient-item">
                                                ФИО:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->surname . ' ' . $patient->name . ' ' . $patient->patronymic}}
                                            </li>
                                            <li class="order-patient-item">
                                                Пол:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->gender->caption()}}
                                            </li>
                                            <li class="order-patient-item">
                                                Дата рождения:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->birth_date->format('d.m.Y')}}
                                            </li>
                                            <li class="order-patient-item">
                                                Телефон:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->phone}}
                                            </li>
                                            <li class="order-patient-item">
                                                Мессенджер:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->messenger}}
                                            </li>
                                            <li class="order-patient-item">
                                                email:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->email}}
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="order-body">
                                        <ul class="order-patient-list">
                                            <li class="order-patient-item">
                                                Левая сторона:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->left_type ? $patient->left_type->caption() : 'Не требуется'}}
                                            </li>
                                            <li class="order-patient-item">
                                                Протезирование:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->left_level ? $patient->left_level->caption() : 'Не требуется'}}
                                            </li>
                                            <li class="order-patient-item">
                                                Правая сторона:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->right_type ? $patient->right_type->caption() : 'Не требуется'}}
                                            </li>
                                            <li class="order-patient-item">
                                                Протезирование:
                                            </li>
                                            <li class="order-patient-item">
                                                {{$patient->right_level ? $patient->right_level->caption() : 'Не требуется'}}
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="button-link red-color" href="#">
                                        Выбрать другого пациента
                                    </a>

                                    <a class="button-link green-color" href="#">
                                        Редактировать пациента
                                    </a>
                                </div>
                            </div>
                        </div>

                        <section class="order-block" data-products="{{$products}}">
                            <ul class="order-block-list">
                                @if ($patient->left_type === \App\Enum\ProthesisType::PROTHESIS_HAND)
                                    <li class="order-block-item">
                                        @include('app-page.profile.order.select_prothesis_item.prothesis_left_hand')
                                    </li>
                                @endif

                                @if ($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_HAND)
                                    <li class="order-block-item">
                                        @include('app-page.profile.order.select_prothesis_item.prothesis_right_hand')
                                    </li>
                                @endif

                                @if ($patient->left_type === \App\Enum\ProthesisType::PROTHESIS_WRIST)
                                    <li class="order-block-item">
                                        @include('app-page.profile.order.select_prothesis_item.prothesis_left_wrist')
                                    </li>
                                @endif

                                @if ($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_WRIST)
                                    <li class="order-block-item">
                                        @include('app-page.profile.order.select_prothesis_item.prothesis_right_wrist')
                                    </li>
                                @endif

                                <li class="order-block-item ">
                                    @include('app-page.profile.order.select_prothesis_item.order-item')
                                </li>

                                <li class="order-block-item">
                                    <div class="order-title js-slide-box">
                                        Комментарий к заказу <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
                                    </div>

                                    <div class="user-data-profile js-box-close hide">
                                        <div class="wrap-text-area">
                                            <textarea class="input text-area" name="description"
                                                      id="description"></textarea>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </section>

                        <div class="button-box regular-button ">
                            <a class="button-link red-color" href="#">
                                Отменить
                            </a>
                            <button class="button-link create-order green-color hide js-button">
                                Создать заказ
                            </button>
                            <div class="button-link create-order-disabled disabled">
                                Создать заказ
                            </div>

                            <div class="await-response js-preloader hide">
                                <div class="wrap-spin ">
                                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                                </div>
                                <article>Обработка</article>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
