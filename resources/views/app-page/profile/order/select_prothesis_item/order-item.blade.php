<div class="order-title js-slide-box">
    Состав заказа <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
</div>

<div class="user-data-profile js-box-close js-order-item-box hide">
    <div class="wrap-item-select">
        <div class="wrap-total-order">
            @if ($patient->left_type === \App\Enum\ProthesisType::PROTHESIS_HAND)
                <div class="total-order" data-side="left">
                    <article class="total-order-title">
                        Протез левой руки:
                    </article>

                    @if($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                        <ul class="total-order-list js-shoulder_knot js-left">
                            <li class="total-order-item">
                                Плечевой узел:
                            </li>
                            <li class="total-order-item js-item">
                                <div class="not-selected">
                                    Комплектующие не выбраны
                                </div>
                            </li>
                        </ul>
                    @endif

                    @if($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT
                    || $patient->left_level  === \App\Enum\ProthesisLevel::ELBOW_KNOT)
                        <ul class="total-order-list js-elbow_knot js-left">
                            <li class="total-order-item">
                                Локтевой узел:
                            </li>
                            <li class="total-order-item js-item">
                                <div class="not-selected">
                                    Комплектующие не выбраны
                                </div>
                            </li>
                        </ul>
                    @endif

                    <ul class="total-order-list js-wrist_knot js-left">
                        <li class="total-order-item">
                            Запястный узел:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>

                    <ul class="total-order-list js-nozzle js-left">
                        <li class="total-order-item">
                            Насадка:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>
                </div>
            @endif

            @if ($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_HAND)
                <div class="total-order" data-side="right">
                    <article class="total-order-title">
                        Протез правой руки:
                    </article>

                    @if($patient->right_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                        <ul class="total-order-list js-shoulder_knot js-right">
                            <li class="total-order-item">
                                Плечевой узел:
                            </li>
                            <li class="total-order-item js-item">
                                <div class="not-selected">
                                    Комплектующие не выбраны
                                </div>
                            </li>
                        </ul>
                    @endif

                    @if($patient->right_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT ||
                        $patient->right_level  === \App\Enum\ProthesisLevel::ELBOW_KNOT)
                        <ul class="total-order-list js-elbow_knot js-right">
                            <li class="total-order-item">
                                Локтевой узел:
                            </li>
                            <li class="total-order-item js-item">
                                <div class="not-selected">
                                    Комплектующие не выбраны
                                </div>
                            </li>
                        </ul>
                    @endif

                    <ul class="total-order-list js-wrist_knot js-right">
                        <li class="total-order-item">
                            Запястный узел:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>

                    <ul class="total-order-list js-nozzle js-right">
                        <li class="total-order-item">
                            Насадка:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>
                </div>
            @endif

            @if ($patient->left_type === \App\Enum\ProthesisType::PROTHESIS_WRIST)
                <div class="total-order" data-side="left">
                    <article class="total-order-title">
                        Протез левой кисти:
                    </article>
                    <ul class="total-order-list js-wrist js-left">
                        <li class="total-order-item">
                            Пястный узел:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>

                    <ul class="total-order-list js-item js-finger js-left">
                        <li class="total-order-item">
                            Пальцы:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>
                </div>
            @endif

            @if ($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_WRIST)
                <div class="total-order" data-side="right">
                    <article class="total-order-title">
                        Протез правой кисти:
                    </article>
                    <ul class="total-order-list js-wrist js-right">
                        <li class="total-order-item">
                            Пястный узел:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>

                    <ul class="total-order-list js-item js-finger js-right">
                        <li class="total-order-item">
                            Пальцы:
                        </li>
                        <li class="total-order-item js-item">
                            <div class="not-selected">
                                Комплектующие не выбраны
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="wrap-total-price">
            <article class="total-price-title">
                Стоимость заказа:
            </article>
            <article class="total-price">
                <div>
                    <span class="js-total">0</span> <i class="fa fa-ruble"></i>
                </div>
            </article>
        </div>
    </div>
</div>
