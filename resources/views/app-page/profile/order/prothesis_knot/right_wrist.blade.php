@if($patient->right_type === \App\Enum\ProthesisType::PROTHESIS_WRIST)
    <li class="order-block-item js-block-item-products">
        <div class="order-title js-slide-box">
            Протез правой кисти <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
        </div>

        <div class="user-data-profile js-box-close hide">
            <div class="order-body fieldset" data-level="wrist" data-side="right" data-server="right_wrist">
                <fieldset class="item-box">
                    <legend>{{\App\Enum\ProthesisLevel::WRIST->caption()}}</legend>
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
                                 data-knot="right-hand-wrist">Выбрать комплектующие
                        </article>
                    </div>
                </fieldset>
            </div>

            <div class="order-body fieldset" data-level="finger" data-side="right" data-server="right_wrist">
                <fieldset class="item-box">
                    <legend>{{\App\Enum\ProthesisLevel::FINGER->caption()}}</legend>
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
                                 data-knot="right-hand-finger">Выбрать комплектующие
                        </article>
                    </div>
                </fieldset>
            </div>
        </div>
    </li>
@endif
