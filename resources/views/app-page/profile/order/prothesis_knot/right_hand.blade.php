@if($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_HAND)
    <li class="order-block-item js-block-item-products">
        <div class="order-title js-slide-box">
            Протез правой руки <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
        </div>

        <div class="user-data-profile js-box-close hide">
            @if($patient->right_level === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                <div class="order-body fieldset" data-level="shoulder_knot" data-side="right" data-server="right_hand">
                    <fieldset class="item-box">
                        <legend>{{\App\Enum\ProthesisLevel::SHOULDER_KNOT->caption()}}</legend>
                        <div class="order-empty">
                            Вы не выбрали комплектующие, Если вам не нужен этот узел просто пропустите его.
                        </div>
                        <ul class="item-box-list hide">
                            <li class="item-box-item">

                                <div class="item-box-text">Кисть функционально-косметическая CYBER-M правая XS</div>
                                <div class="item-box-text">
                                    <span>17000 <i class="fa fa-ruble"></i></span>
                                </div>
                                <div class="item-box-text js-delete-item">Удалить</div>
                            </li>
                        </ul>

                        <div class="order-bottom">
                            <article class="order-bottom-link js-open-select green-color"
                                     data-knot="right-hand-shoulder-knot">Выбрать комплектующие
                            </article>
                        </div>
                    </fieldset>
                </div>
            @endif

            @if($patient->right_level === \App\Enum\ProthesisLevel::SHOULDER_KNOT || $patient->right_level === \App\Enum\ProthesisLevel::ELBOW_KNOT)
                <div class="order-body fieldset" data-level="elbow_knot" data-side="right" data-server="right_hand">
                    <fieldset class="item-box">
                        <legend>{{\App\Enum\ProthesisLevel::ELBOW_KNOT->caption()}}</legend>
                        <div class="order-empty">
                            Вы не выбрали комплектующие, Если вам не нужен этот узел просто пропустите его.
                        </div>
                        <ul class="item-box-list hide">
                            <li class="item-box-item">

                                <div class="item-box-text">Кисть функционально-косметическая CYBER-M правая XS</div>
                                <div class="item-box-text">
                                    <span>17000 <i class="fa fa-ruble"></i></span>
                                </div>
                                <div class="item-box-text js-delete-item">Удалить</div>
                            </li>
                        </ul>

                        <div class="order-bottom">
                            <article class="order-bottom-link js-open-select green-color "
                                     data-knot="right-hand-elbow-knot">Выбрать комплектующие
                            </article>
                        </div>
                    </fieldset>
                </div>
            @endif
            @if($patient->right_level === \App\Enum\ProthesisLevel::SHOULDER_KNOT || $patient->right_level === \App\Enum\ProthesisLevel::ELBOW_KNOT || $patient->right_level === \App\Enum\ProthesisLevel::WRIST_KNOT)
                <div class="order-body fieldset" data-level="wrist_knot" data-side="right" data-server="right_hand">
                    <fieldset class="item-box">
                        <legend>{{\App\Enum\ProthesisLevel::WRIST_KNOT->caption()}}</legend>
                        <div class="order-empty">
                            Вы не выбрали комплектующие, Если вам не нужен этот узел просто пропустите его.
                        </div>
                        <ul class="item-box-list hide">
                            <li class="item-box-item">

                                <div class="item-box-text">Кисть функционально-косметическая CYBER-M правая XS</div>
                                <div class="item-box-text">
                                    <span>17000 <i class="fa fa-ruble"></i></span>
                                </div>
                                <div class="item-box-text js-delete-item">Удалить</div>
                            </li>
                        </ul>

                        <div class="order-bottom">
                            <article class="order-bottom-link js-open-select green-color "
                                     data-knot="right-hand-wrist-knot">Выбрать комплектующие
                            </article>
                        </div>
                    </fieldset>
                </div>
            @endif
            <div class="order-body fieldset" data-level="nozzle" data-side="right" data-server="right_hand">
                <fieldset class="item-box">
                    <legend>{{\App\Enum\ProthesisLevel::NOZZLE->caption()}}</legend>
                    <div class="order-empty">
                        Вы не выбрали комплектующие, Если вам не нужен этот узел просто пропустите его.
                    </div>
                    <ul class="item-box-list hide">
                        <li class="item-box-item">

                            <div class="item-box-text">Кисть функционально-косметическая CYBER-M правая XS</div>
                            <div class="item-box-text">
                                <span>17000 <i class="fa fa-ruble"></i></span>
                            </div>
                            <div class="item-box-text js-delete-item">Удалить</div>
                        </li>
                    </ul>

                    <div class="order-bottom">
                        <article class="order-bottom-link js-open-select green-color js-open-select"
                                 data-knot="right-hand-nozzle">Выбрать комплектующие
                        </article>
                    </div>
                </fieldset>
            </div>
        </div>
    </li>
@endif
