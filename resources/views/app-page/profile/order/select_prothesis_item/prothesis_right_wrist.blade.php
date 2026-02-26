<div class="order-title js-slide-box">
    Протез правой кисти <i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
</div>

<div class="user-data-profile js-box-close hide" data-side="right">
    <div class="wrap-item-select js-order-value-box">
        <div class="wrap-item-select-list">
            <ul class="filer-select-list">
                <li class="filer-select-item js-grip-list">
                    Крепление:
                </li>
                @foreach($grips as $grip)
                    <li class="filer-select-item choice-filter disabled-filter">
                        {{$grip->caption()}}
                    </li>
                @endforeach

                <li class="filer-select-item js-system-list">
                    Система:
                </li>
                @foreach($systems as $system)
                    <li class="filer-select-item system-list choice-filter js-system">
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

        <ul class="item-select-header-list wrist-box">
            <li class="item-select-header-item js-wrist item-select-active">
                Пястье
            </li>
            <li class="item-select-header-item js-finger">
                Пальцы
            </li>
        </ul>

        <div class="wrap-knot-box js-wrist js-right" data-knot="wrist">
            <ul class="item-select-list">
                <li class="item-select-item ">
                    <div class="data-item">
                        <input type="checkbox" name="surname" class="input checkbox-order" value="1">
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
                <article class="order-bottom-link green-color js-switch-next" data-next="js-finger">Следующий узел</article>
            </div>
        </div>

        <div class="wrap-knot-box js-finger js-right hide" data-knot="finger">
            <ul class="item-select-list">
                <li class="item-select-item ">
                    <div class="data-item">
                        <input type="checkbox" name="surname" class="input checkbox-order" value="1">
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
                    <article class="order-bottom-link red-color js-switch-prev" data-prev="js-wrist">Предыдущий узел</article>
                    <article class="order-bottom-link make-order green-color hide" data-make="wrist">Добавить к заказу</article>
                    <div class="order-bottom-link-disabled">
                        Добавить к заказу
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
