@extends('page.admin-page')
@section('admin-content')
    <section class="admin">
        <div class="wrap-user-data-profile user-data ">
            <div class="admin-title">
                <div class="admin-title-page">
                    Просмотр заказа
                </div>
            </div>

            <section class="wrap-order-view">
                <div class="wrap-order-view-title">
                    Заказ № {{$order->number}}
                </div>

                <div class="wrap-order-list">
                    <div class="order-view order-data">
                        <div class="order-view-title">
                            Заказчик:
                        </div>
                        <ul class="order-view-list">
                            <li class="order-view-item">
                                ФИО:
                            </li>
                            <li class="order-view-item">
                                {{$order->user->surname . ' ' . $order->user->name . ' ' . $order->user->patronymic}}
                            </li>
                            <li class="order-view-item">
                                фирма:
                            </li>
                            <li class="order-view-item">
                                {{$order->user->organization}}
                            </li>
                            <li class="order-view-item">
                                email:
                            </li>
                            <li class="order-view-item">
                                {{$order->user->email}}
                            </li>
                            <li class="order-view-item">
                                телефон:
                            </li>
                            <li class="order-view-item">
                                {{$order->user->phone}}
                            </li>
                        </ul>
                    </div>

                    <div class="order-view">
                        <div class="order-view-title">
                            Пациент:
                        </div>
                        <ul class="order-view-list">
                            <li class="order-view-item">
                                ФИО:
                            </li>
                            <li class="order-view-item">
                                {{$order->patient->surname . ' ' . $order->patient->name . ' ' . $order->patient->patronymic}}
                            </li>
                            <li class="order-view-item">
                                email:
                            </li>
                            <li class="order-view-item">
                                {{$order->patient->email}}
                            </li>
                            <li class="order-view-item">
                                телефон:
                            </li>
                            <li class="order-view-item">
                                {{$order->patient->phone}}
                            </li>
                        </ul>
                    </div>

                    @if ($order->patient->right_type === \App\Enum\ProthesisType::PROTHESIS_HAND
                        && $rightHand !== null)
                        <div class="order-view">
                            <div class="order-view-title">
                                Протез правой руки:
                            </div>
                            <ul class="order-view-product-list">
                                @foreach($rightHand->products as $product)
                                    <li class="order-view-product-item">
                                        <div class="view-product">
                                            {{$product->name}}
                                        </div>
                                        <div class="view-product">
                                            {{$product->formatted_total}} <i class="fa fa-ruble"></i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="order-view-total-list">
                                <li class="order-view-total-item">
                                    Итого за протез:
                                </li>
                                <li class="order-view-total-item">
                                    {{$rightHand->formatted_total}} <i class="fa fa-ruble"></i>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if ($order->patient->left_type === \App\Enum\ProthesisType::PROTHESIS_HAND && $leftHand !== null)
                        <div class="order-view">
                            <div class="order-view-title">
                                Протез левой руки:
                            </div>
                            <ul class="order-view-product-list">
                                @foreach($leftHand->products as $product)
                                    <li class="order-view-product-item">
                                        <div class="view-product">
                                            {{$product->name}}
                                        </div>
                                        <div class="view-product">
                                            {{$product->formatted_total}} <i class="fa fa-ruble"></i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="order-view-total-list">
                                <li class="order-view-total-item">
                                    Итого за протез:
                                </li>
                                <li class="order-view-total-item">
                                    {{$leftHand->formatted_total}} <i class="fa fa-ruble"></i>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if ($order->patient->left_type === \App\Enum\ProthesisType::PROTHESIS_WRIST && $leftWrist !== null)
                        <div class="order-view">
                            <div class="order-view-title">
                                Протез левой кисти:
                            </div>
                            <ul class="order-view-product-list">
                                @foreach($leftWrist->products as $product)
                                    <li class="order-view-product-item">
                                        <div class="view-product">
                                            {{$product->name}}
                                        </div>
                                        <div class="view-product">
                                            {{$product->formatted_total}} <i class="fa fa-ruble"></i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="order-view-total-list">
                                <li class="order-view-total-item">
                                    Итого за протез:
                                </li>
                                <li class="order-view-total-item">
                                    {{$leftWrist->formatted_total}} <i class="fa fa-ruble"></i>
                                </li>
                            </ul>
                        </div>
                    @endif

                    @if ($order->patient->right_type === \App\Enum\ProthesisType::PROTHESIS_WRIST && $rightWrist !== null)
                        <div class="order-view">
                            <div class="order-view-title">
                                Протез правой кисти:
                            </div>
                            <ul class="order-view-product-list">
                                @foreach($rightWrist->products as $product)
                                    <li class="order-view-product-item">
                                        <div class="view-product">
                                            {{$product->name}}
                                        </div>
                                        <div class="view-product">
                                            {{$product->formatted_total}} <i class="fa fa-ruble"></i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="order-view-total-list">
                                <li class="order-view-total-item">
                                    Итого за протез:
                                </li>
                                <li class="order-view-total-item">
                                    {{$rightWrist->formatted_total}} <i class="fa fa-ruble"></i>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="order-view-total-price">
                    <ul class="order-view-total-price-list">
                        <li class="order-view-total-price-item">
                            Стоимость заказа
                        </li>
                        <li class="order-view-total-price-item">
                            {{$order->formatted_total}} <i class="fa fa-ruble"></i>
                        </li>
                    </ul>
                </div>
            </section>

            <ul class="action-pdf-list">
                <li class="action-pdf-item js-download red-color">
                    <a href="{{route('api.v1.order.pdf.download', $order->number)}}"
                       class="js-download"
                       style="color: inherit; text-decoration: none; width: 100%; height: 100%; display: block;">
                        Скачать PDF
                    </a>
                </li>
                <li class="action-pdf-item js-resend green-color">
                    Переслать PDF
                </li>
            </ul>
        </div>
    </section>
@endsection
