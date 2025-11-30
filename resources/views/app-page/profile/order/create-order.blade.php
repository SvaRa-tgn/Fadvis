@extends('page.admin-page')
@section('admin-content')
    <main class="main">
        <div class="main-content">
            <section class="form-wrap">
                <div class="form-title-box">
                    <a class="link-title" href="{{route('profile.order.list', $user)}}">Назад</a>
                    <div class="title-box">
                        Создание заказа
                    </div>
                </div>
                <form class="form-admin js-response" method="POST" action="{{route('api.v1.order.create', ['user' => $user])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="order-data-profile">
                        <article class="title-data-profile">Данные заказа</article>

                        <div class="input-order">
                            <label class="input-label" for="patient-order">*Выберите пациента</label>
                            <select class="input" name="patient" id="patient-order">
                                    <option value="">-- Выберите пациента --</option>
                                    @if (!$patients->isEmpty())
                                        @foreach($patients as $patient)
                                            <option
                                                value="{{$patient->id}}">{{$patient->surname . ' ' . $patient->name .  ' ' . $patient->patronymic}}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>

                        <div class="input-order position-order">
                            <article class="select-patient">Не нашли пациента?</article>
                            <div class="create-patient js-new-patient">
                                Создайте
                            </div>
                        </div>
                    </div>

                    <div class="order-data-profile side-box">
                        <div class="input-order">
                            <article class="select-value">Выберите сторону протезирования</article>

                            <div class="select-value-block pos-3">
                                @foreach($sides as $side)
                                    <div class="wrap-radio">
                                        <label class="radio-label">
                                            @if ($side === \App\Enum\ProthesisSide::UNIVERSAL)
                                                Левая и правая
                                                <input class="checkbox side-order" name="side" value="{{$side->value}}" type="radio"/>
                                            @else
                                                {{$side->captionSide()}}
                                                <input class="checkbox side-order" name="side" value="{{$side->value}}" type="radio"/>
                                            @endif

                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="order-data-profile left-type-box hide">
                        <div class="input-order">
                            <label class="input-label" for="left-side">*Выберите тип протезирования для левой руки</label>
                            <select class="input" name="left_type" id="left-side">
                                <option value="">-- Выберите тип протеза --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->value}}">{{$type->caption()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="order-data-profile right-type-box hide">
                        <div class="input-order">
                            <label class="input-label" for="right-side">*Выберите тип протезирования для правой руки</label>
                            <select class="input" name="right_type" id="right-side">
                                <option value="">-- Выберите тип протеза --</option>
                                @foreach($types as $type)
                                    <option value="{{$type->value}}">{{$type->caption()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="button-box">
                        <a class="user-data-edit red-color password-switch " href="{{route('profile.order.list', $user)}}">Назад</a>

                        <div class="wrap-button js-button ">
                            <button class="user-data-edit green-color">Выбрать комплектующие</button>
                        </div>

                        <div class="wrap-update-button js-preloader hide">
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
