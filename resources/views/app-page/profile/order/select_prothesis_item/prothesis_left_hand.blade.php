<div class="order-title js-slide-box">
    Протез левой руки <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
</div>

<div class="user-data-profile js-box-close hide" data-side="left">
    <div class="wrap-item-select js-order-value-box">
        <div class="wrap-item-select-list">
            <ul class="filer-select-list">
                <li class="filer-select-item js-grip-list">
                    Крепление:
                </li>
                @foreach($grips as $grip)
                    <li class="filer-select-item grip-list choice-filter js-grip">
                        {{$grip->caption()}}
                    </li>
                @endforeach

                <li class="filer-select-item js-system-list">
                    Система:
                </li>
                @foreach($systems as $system)
                    <li class="filer-select-item system-list choice-filter disabled-filter">
                        {{$system->caption()}}
                    </li>
                @endforeach
            </ul>

            <ul class="filer-select-list">
                <li class="filer-select-item js-size-list">
                    Размеры:
                </li>
                @foreach($sizes as $size)
                    @if($size !== \App\Enum\ProthesisSize::CUSTOM)
                        <li class="filer-select-item size-list choice-filter js-size">
                            {{$size}}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <ul class="item-select-header-list
        {{($patient->left_level === \App\Enum\ProthesisLevel::ELBOW_KNOT)
        ? 'item-select-header-list-3fr'
        : (
            ($patient->left_level === \App\Enum\ProthesisLevel::WRIST_KNOT)
                ? 'wrist-box'
                : ''
          )
                }}">
            @if($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                <li class="item-select-header-item js-shoulder_knot item-select-active">
                    Плечевой узел
                </li>
            @endif
            @if(($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                || ($patient->left_level  === \App\Enum\ProthesisLevel::ELBOW_KNOT))
                <li class="item-select-header-item js-elbow_knot
                {{($patient->left_level === \App\Enum\ProthesisLevel::ELBOW_KNOT) ? 'item-select-active' : ''}}">
                    Локтевой узел
                </li>
            @endif
            <li class="item-select-header-item js-wrist_knot
            {{($patient->left_level === \App\Enum\ProthesisLevel::WRIST_KNOT) ? 'item-select-active' : ''}}">
                Запястный узел
            </li>
            <li class="item-select-header-item js-nozzle">
                Насадка
            </li>
        </ul>

        @if($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
            <div class="wrap-knot-box js-shoulder_knot js-left" data-knot="shoulder_knot">
                <ul class="item-select-list">
                    <li class="item-select-item ">
                        <div class="data-item">
                            <input type="checkbox" name="shoulder_knot" class="input checkbox-order" value="1">
                            <article class="data-item-info">
                                Кисть функционально-косметическая CYBER-M правая XS
                            </article>
                            <article class="data-item-info">
                                <div>
                                    13000 <i class="fa fa-ruble"></i>
                                </div>
                            </article>
                            <div class="wrap-checkbox-link">
                                <i class="fa fa-external-link-square checkbox-link" aria-hidden="true"></i>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="order-bottom">
                    <article class="order-bottom-link green-color js-switch-next" data-next="js-elbow_knot">Следующий узел</article>
                </div>
            </div>
        @endif

        @if(($patient->left_level  === \App\Enum\ProthesisLevel::SHOULDER_KNOT)
                || ($patient->left_level  === \App\Enum\ProthesisLevel::ELBOW_KNOT))
            <div class="wrap-knot-box js-elbow_knot js-left
            {{($patient->left_level !== \App\Enum\ProthesisLevel::ELBOW_KNOT) ? 'hide' : ''}}" data-knot="elbow_knot">
                <ul class="item-select-list">
                    <li class="item-select-item ">
                        <div class="data-item">
                            <input type="checkbox" name="elbow_knot" class="input checkbox-order" value="1">
                            <article class="data-item-info">
                                Кисть функционально-косметическая CYBER-M правая XS
                            </article>
                            <article class="data-item-info">
                                <div>
                                    13000 <i class="fa fa-ruble"></i>
                                </div>
                            </article>
                            <div class="wrap-checkbox-link">
                                <i class="fa fa-external-link-square checkbox-link" aria-hidden="true"></i>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="order-bottom">
                    @if($patient->left_level === \App\Enum\ProthesisLevel::ELBOW_KNOT)
                        <article class="order-bottom-link green-color js-switch-next" data-next="js-wrist_knot">Следующий узел</article>
                    @else
                        <div class="order-button-box">
                            <article class="order-bottom-link red-color js-switch-prev" data-prev="js-shoulder_knot">Предыдущий узел</article>
                            <article class="order-bottom-link green-color js-switch-next" data-next="js-wrist_knot">Следующий узел</article>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="wrap-knot-box js-wrist_knot js-left
        {{($patient->left_level !== \App\Enum\ProthesisLevel::WRIST_KNOT) ? 'hide' : ''}}" data-knot="wrist_knot">
            <ul class="item-select-list">
                <li class="item-select-item ">
                    <div class="data-item">
                        <input type="checkbox" name="wrist_knot" class="input checkbox-order" value="1">
                        <article class="data-item-info">
                            Кисть функционально-косметическая CYBER-M правая XS
                        </article>
                        <article class="data-item-info">
                            <div>
                                13000 <i class="fa fa-ruble"></i>
                            </div>
                        </article>
                        <div class="wrap-checkbox-link">
                            <i class="fa fa-external-link-square checkbox-link" aria-hidden="true"></i>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="order-bottom">
                @if($patient->left_level === \App\Enum\ProthesisLevel::WRIST_KNOT)
                    <article class="order-bottom-link green-color js-switch-next" data-next="js-nozzle">Следующий узел</article>
                @else
                    <div class="order-button-box">
                        <article class="order-bottom-link red-color js-switch-prev" data-prev="js-elbow_knot">Предыдущий узел</article>
                        <article class="order-bottom-link green-color js-switch-next" data-next="js-nozzle">Следующий узел</article>
                    </div>
                @endif
            </div>
        </div>

        <div class="wrap-knot-box js-nozzle js-left hide" data-knot="nozzle">
            <ul class="item-select-list">
                <li class="item-select-item ">
                    <div class="data-item">
                        <input type="checkbox" name="nozzle" class="input checkbox-order" value="1">
                        <article class="data-item-info">
                            Кисть функционально-косметическая CYBER-M правая XS
                        </article>
                        <article class="data-item-info">
                            <div>
                                13000 <i class="fa fa-ruble"></i>
                            </div>
                        </article>
                        <div class="wrap-checkbox-link">
                            <i class="fa fa-external-link-square checkbox-link" aria-hidden="true"></i>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="order-bottom">
                <div class="order-button-box">
                    <article class="order-bottom-link red-color js-switch-prev" data-prev="js-wrist_knot">Предыдущий узел</article>
                    <article class="order-bottom-link make-order green-color hide" data-make="hand">Добавить к заказу</article>
                    <div class="order-bottom-link-disabled">
                        Добавить к заказу
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

