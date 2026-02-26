const appOrder = {

    /* ---------------- helpers ---------------- */

    mapCollection(text) {
        if (text === 'ЭКСЦ') return 'ekcs';
        if (text === 'Альфа') return 'alfa';
        return null;
    },

    mapCollectionCaption(value) {
        if (value === 'ekcs') return 'ЭКСЦ';
        if (value === 'alfa') return 'Альфа';
        return null;
    },

    mapView(text) {
        if (text === 'Активный') return 'active';
        if (text === 'Пассивный') return 'passive';
        return null;
    },

    mapViewCaption(value) {
        if (value === 'active') return 'Активный';
        if (value === 'passive') return 'Пассивный';
        return null;
    },

    activateFilter(items, matchText) {
        if (!matchText) return;
        items.each(function () {
            const el = $(this);
            if (el.text().trim() === matchText) {
                if (!el.hasClass('active-filter')) {
                    el.addClass('active-filter disabled-filter');
                }
            }
        });
    },

    /* ---------------- patient ---------------- */

    selectPatient() {
        $('.js-select-patient').on('change', function () {
            const select = $(this);
            const form = select.closest('.js-make-form');
            const patientId = select.val();
            const button = form.find('.create-order-form');
            const baseUrl = button.data('base-url');

            if (patientId) {
                form.find('.js-attention-patient').addClass('hide');
                button.removeClass('hide')
                    .attr('href', `${baseUrl}/${patientId}/create`);
            } else {
                form.find('.js-attention-patient').removeClass('hide');
                button.addClass('hide').attr('href', '#');
            }
        });
    },

    /* ---------------- open block ---------------- */

    openBlock() {
        $('.js-slide-box').on('click', function () {
            const box = $(this);
            const item = box.closest('.order-block-item');
            const content = item.find('.js-box-close');

            $('.js-box-close').slideUp(300);
            $('.js-slide-box .arrow').removeClass('rotate');

            if (!content.is(':visible')) {
                content.slideDown(300);
                box.find('.arrow').addClass('rotate');
                appOrder.renderProducts(item);
            }
        });
    },

    /* ---------------- render products ---------------- */

    renderProducts(orderItem) {
        const products = orderItem.closest('.order-block').data('products') || [];
        const side = orderItem.find('.user-data-profile').data('side');

        const selected = orderItem.find('.checkbox-order:checked')
            .map(function () { return String(this.value); }).get();

        orderItem.find('.wrap-knot-box').each(function () {
            const box = $(this);
            const knot = box.data('knot');
            const list = box.find('.item-select-list');

            let filtered = products.filter(p =>
                (p.side === side || p.side === 'universal') &&
                p.level === knot
            );

            const activeGrip = orderItem.find('.js-grip.active-filter').map(function () {
                return appOrder.mapCollection($(this).text().trim());
            }).get();

            const activeSize = orderItem.find('.js-size.active-filter').map(function () {
                return $(this).text().trim();
            }).get();

            const activeSystem = orderItem.find('.js-system.active-filter').map(function () {
                return appOrder.mapView($(this).text().trim());
            }).get();

            if (['shoulder_knot', 'elbow_knot', 'wrist_knot'].includes(knot) && activeGrip.length) {
                filtered = filtered.filter(p =>
                    activeGrip.includes(p.grip) || p.grip === null
                );
            }

            if (activeSize.length) {
                filtered = filtered.filter(p =>
                    activeSize.includes(p.size) || p.size === 'custom'
                );
            }

            if (
                (knot === 'wrist_knot' || ['nozzle', 'wrist', 'finger'].includes(knot)) &&
                activeSystem.length
            ) {
                filtered = filtered.filter(p => activeSystem.includes(p.system));
            }

            list.empty();

            if (!filtered.length) {
                list.append(`<li class="item-select-item"><span class="data-item">Нет доступных товаров</span></li>`);
                return;
            }

            filtered.forEach(p => {
                list.append(`
                    <li class="item-select-item">
                        <label class="data-item">
                            <input type="checkbox"
                                   class="input checkbox-order"
                                   value="${p.id}"
                                   ${selected.includes(String(p.id)) ? 'checked' : ''}
                                   data-product='${JSON.stringify(p)}'>
                            <article class="data-item-info">${p.name}</article>
                            <article class="data-item-info">${p.price} ₽</article>
                            <div class="wrap-checkbox-link">
                                <i class="fa fa-external-link-square checkbox-link" aria-hidden="true"></i>
                            </div>
                        </label>
                    </li>
                `);
            });
        });
    },

    /* ---------------- filter click ---------------- */

    selectValue() {
        $(document).on('click', '.choice-filter:not(.disabled-filter)', function () {
            const item = $(this);
            const box = item.closest('.js-order-value-box');
            const groupClass = item.attr('class').split(' ').find(c => c.endsWith('-list'));

            const wasActive = item.hasClass('active-filter');
            box.find('.' + groupClass).removeClass('active-filter');
            if (!wasActive) item.addClass('active-filter');

            const orderItem = item.closest('.order-block-item');
            appOrder.renderProducts(orderItem);
        });
    },

    /* ---------------- checkbox -> filters ---------------- */

    syncFiltersFromProduct() {
        $(document).on('change', '.checkbox-order', function () {
            const checkbox = $(this);
            const orderItem = checkbox.closest('.order-block-item');
            const knotBox = checkbox.closest('.wrap-knot-box');
            const knot = knotBox.data('knot');

            const grips = orderItem.find('li.grip-list');
            const sizes = orderItem.find('li.size-list');
            const systems = orderItem.find('li.system-list');

            const allGrips = orderItem.find('li.grip-list');
            const allSizes = orderItem.find('li.size-list');
            const allSystems = orderItem.find('li.system-list');

            const mapCollection = (v) => v === 'ekcs' ? 'ЭКСЦ' : v === 'alfa' ? 'Альфа' : null;
            const mapView = (v) => v === 'active' ? 'Активный' : v === 'passive' ? 'Пассивный' : null;

            const visibleNozzleKnot = orderItem.find('.wrap-knot-box.js-nozzle:not(.hide)');
            const hasSelectedHahd = orderItem.find('.wrap-knot-box.js-wrist_knot input:checked, .wrap-knot-box.js-shoulder_knot input:checked, .wrap-knot-box.js-elbow_knot input:checked').length > 0;
            const activeBox = orderItem.find('.wrap-knot-box.js-nozzle:not(.hide), .wrap-knot-box.js-finger:not(.hide)');

            // Проверяем выбранные товары во всём orderItem
            const hasSelectedProductsAnywhere = orderItem.find('input.checkbox-order:checked').length > 0;

            if (hasSelectedProductsAnywhere) {
                activeBox.find('.order-bottom-link.green-color').removeClass('hide');
                activeBox.find('.order-bottom-link-disabled').addClass('hide');
            } else {
                activeBox.find('.order-bottom-link.green-color').addClass('hide');
                activeBox.find('.order-bottom-link-disabled').removeClass('hide');
            }

            if (!checkbox.is(':checked')) {
                const orderItem = checkbox.closest('.order-block-item');

                const allGrips = orderItem.find('li.grip-list');
                const allSizes = orderItem.find('li.size-list');
                const allSystems = orderItem.find('li.system-list');

                const visibleShoulderElbow = orderItem.find('.wrap-knot-box.js-shoulder_knot:not(.hide), .wrap-knot-box.js-elbow_knot:not(.hide)');
                const visibleWrist = orderItem.find('.wrap-knot-box.js-wrist_knot:not(.hide)');
                const visibleNozzle = orderItem.find('.wrap-knot-box.js-nozzle:not(.hide)');
                const visibleOther = orderItem.find('.wrap-knot-box.js-wrist:not(.hide), .wrap-knot-box.js-finger:not(.hide)');

                const hasSelectedShoulderElbow = orderItem.find('.wrap-knot-box.js-shoulder_knot input:checked, .wrap-knot-box.js-elbow_knot input:checked').length > 0;
                const hasSelectedWrist = orderItem.find('.wrap-knot-box.js-wrist_knot input:checked, .wrap-knot-box.js-shoulder_knot input:checked, .wrap-knot-box.js-elbow_knot input:checked').length > 0;
                const hasSelectedOther = orderItem.find('.wrap-knot-box.js-nozzle input:checked, .wrap-knot-box.js-wrist input:checked, .wrap-knot-box.js-finger input:checked').length > 0;

                // сбрасываем фильтры только для видимых блоков
                if (visibleShoulderElbow.length && !hasSelectedShoulderElbow) {
                    allGrips.removeClass('disabled-filter active-filter js-active-input').addClass('js-grip');
                    allSizes.removeClass('disabled-filter active-filter js-active-input').addClass('js-size');
                }

                if (visibleWrist.length) {
                    allSystems.removeClass('disabled-filter active-filter js-active-input').addClass('js-system');
                }

                if (visibleWrist.length && !hasSelectedWrist) {
                    // Всегда сбрасываем фильтр system для wrist_knot
                    allSystems.removeClass('disabled-filter active-filter js-active-input').addClass('js-system');

                    // GRIP и SIZE сбрасываем только если нет выбранных товаров в этом блоке
                    allGrips.removeClass('disabled-filter active-filter js-active-input').addClass('js-grip');
                    allSizes.removeClass('disabled-filter active-filter js-active-input').addClass('js-size');
                }

                if (visibleNozzle && !hasSelectedWrist) {
                    allSystems.removeClass('disabled-filter active-filter js-active-input').addClass('js-system');
                }

                if (visibleOther.length && !hasSelectedOther) {
                    allSizes.removeClass('disabled-filter active-filter js-active-input').addClass('js-size');
                    allSystems.removeClass('disabled-filter active-filter js-active-input').addClass('js-system');
                }

                appOrder.renderProducts(orderItem);
                return;
            }

            const product = checkbox.data('product');

            /* ----------------------------------------
               SHOULDER + ELBOW
            ---------------------------------------- */
            if (['shoulder_knot', 'elbow_knot'].includes(knot)) {
                const gripText = mapCollection(product.grip);

                // GRIP
                grips.addClass('disabled-filter');
                if (gripText) {
                    grips.each(function () {
                        const li = $(this);
                        if (li.text().trim() === gripText) {
                            li.addClass('active-filter js-active-input');
                        }
                    });
                }

                // SIZE
                sizes.addClass('disabled-filter');
                sizes.each(function () {
                    const li = $(this);
                    if (li.text().trim() === product.size) {
                        li.addClass('active-filter js-active-input');
                    }
                });
            }

            /* ----------------------------------------
               WRIST_KNOT
            ---------------------------------------- */
            if (knot === 'wrist_knot') {
                const gripText = mapCollection(product.grip);

                grips.addClass('disabled-filter');
                if (gripText) {
                    grips.each(function () {
                        const li = $(this);
                        if (li.text().trim() === gripText) {
                            li.addClass('active-filter js-active-input');
                        }
                    });
                }

                sizes.addClass('disabled-filter');
                sizes.each(function () {
                    const li = $(this);
                    if (li.text().trim() === product.size) {
                        li.addClass('active-filter js-active-input');
                    }
                });

                const systemText = mapView(product.system);
                systems.addClass('disabled-filter');
                if (systemText) {
                    systems.each(function () {
                        const li = $(this);
                        if (li.text().trim() === systemText) {
                            li.addClass('active-filter js-active-input');
                        }
                    });
                }
            }

            /* ----------------------------------------
               NOZZLE / WRIST / FINGER
            ---------------------------------------- */
            if (['nozzle', 'wrist', 'finger'].includes(knot)) {
                sizes.addClass('disabled-filter');
                sizes.each(function () {
                    const li = $(this);
                    if (li.text().trim() === product.size) {
                        li.addClass('active-filter js-active-input');
                    }
                });

                const systemText = mapView(product.system);
                systems.addClass('disabled-filter');
                if (systemText) {
                    systems.each(function () {
                        const li = $(this);
                        if (li.text().trim() === systemText) {
                            li.addClass('active-filter js-active-input');
                        }
                    });
                }
            }

            appOrder.renderProducts(orderItem);
        });
    },

    /* ---------------- switch knot ---------------- */

    switchKnot() {
        $(document).on('click', '.js-switch-next, .js-switch-prev', function () {
            const btn = $(this);
            const orderItem = btn.closest('.order-block-item');
            const targetClass = btn.hasClass('js-switch-next') ? btn.data('next') : btn.data('prev');

            if (!targetClass) return;

            // Скрываем все блоки, показываем выбранный
            orderItem.find('.wrap-knot-box').addClass('hide');
            orderItem.find('.' + targetClass).removeClass('hide');

            // Переключаем активный header
            orderItem.find('.item-select-header-item').removeClass('item-select-active');
            orderItem.find(`.item-select-header-item.${targetClass}`).addClass('item-select-active');

            // Находим списки фильтров
            const grip = orderItem.find('.grip-list');
            const system = orderItem.find('.system-list');
            const size = orderItem.find('.size-list');

            // Проверяем, есть ли "заблокированные" активные фильтры
            const gripLocked = grip.hasClass('js-active-input');
            const systemLocked = system.hasClass('js-active-input');
            const sizeLocked = size.hasClass('js-active-input');

            // ⬇ Логика фильтров по типу узла
            if (['js-shoulder_knot', 'js-elbow_knot'].includes(targetClass)) {
                if (!systemLocked) system.addClass('disabled-filter').removeClass('js-system');
                if (!gripLocked) grip.removeClass('disabled-filter').addClass('js-grip');
            }

            if (targetClass === 'js-wrist_knot') {
                if (!gripLocked) grip.removeClass('disabled-filter').addClass('js-grip');
                if (!systemLocked) system.removeClass('disabled-filter').addClass('js-system');
            }

            if (targetClass === 'js-nozzle' || targetClass === 'js-finger') {
                if (!gripLocked) grip.addClass('disabled-filter').removeClass('js-grip');
                if (!systemLocked) system.removeClass('disabled-filter').addClass('js-system');

                // ---- кнопки "Добавить к заказу" ----
                const activeBox = orderItem.find(`.wrap-knot-box.${targetClass}:not(.hide)`);

                // Проверяем выбранные товары во всём orderItem
                const hasSelectedProductsAnywhere = orderItem.find('input.checkbox-order:checked').length > 0;

                if (hasSelectedProductsAnywhere) {
                    activeBox.find('.order-bottom-link.green-color').removeClass('hide');
                    activeBox.find('.order-bottom-link-disabled').addClass('hide');
                } else {
                    activeBox.find('.order-bottom-link.green-color').addClass('hide');
                    activeBox.find('.order-bottom-link-disabled').removeClass('hide');
                }
            }

            // Обновляем список товаров после переключения
            appOrder.renderProducts(orderItem);
        });
    },


    viewProduct() {
        $(document).on('click', '.checkbox-link', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const icon = $(this);
            const item = icon.closest('.item-select-item');
            const checkbox = item.find('.checkbox-order');
            const product = checkbox.data('product');
            const popUp = $('.pop-up');

            if (!product) return;

            // ---- открываем попап ----
            $('.visible').addClass('no-scroll');
            popUp.addClass('pop-up-active');
            popUp.find('.view-product-box').removeClass('hide');

            // ---- enum helpers ----
            const mapSide = (v) => {
                if (v === 'left') return 'Левая';
                if (v === 'right') return 'Правая';
                if (v === 'universal') return 'Универсальная';
                return '-';
            };

            const mapType = (v) => {
                if (v === 'prothesis_hand') return 'Протез руки';
                if (v === 'prothesis_wrist') return 'Протез кисти';
                return '-';
            };

            const mapLevel = (v) => {
                if (v === 'shoulder_knot') return 'Плечевой узел';
                if (v === 'elbow_knot') return 'Локтевой узел';
                if (v === 'wrist_knot') return 'Запястный узел';
                if (v === 'nozzle') return 'Насадка';
                if (v === 'wrist') return 'Пястье';
                if (v === 'finger') return 'Палец';
                if (v === 'universal_knot') return 'Универсальный узел';
                return '-';
            };

            const normalizeValue = (v) => v ?? 'Индивидуальный подбор';

            popUp.find('.item-img')
                .attr('src', product.link || '')
                .attr('alt', product.name || '');

            popUp.find('.filter-article').text(product.name || '');

            const info = popUp.find('.product-info-list');

            info.find('[data-field="price"]').html(`${product.price} <i class="fa fa-ruble"></i>`);
            info.find('[data-field="size"]').text(product.size || '-');
            info.find('[data-field="side"]').text(mapSide(product.side));
            info.find('[data-field="type"]').text(mapType(product.type));
            info.find('[data-field="level"]').text(mapLevel(product.level));
            info.find('[data-field="volume_size"]').text(normalizeValue(product.volume_size));
            info.find('[data-field="lenght_size"]').text(normalizeValue(product.lenght_size));
            info.find('[data-field="manufacturer"]').text(product.manufacturer || '-');
        });

        $(document).on('click', '.js-close-view', function () {
            $('.visible').removeClass('no-scroll');
            $('.pop-up').removeClass('pop-up-active');
        });
    },

    /* ---------------- make order ---------------- */

        makeOrder() {
            $(document).on('click', '.make-order', function () {

                const orderBox = $('.js-order-item-box');
                let total = 0;

                /* 1️⃣ Сброс всех итоговых списков */
                orderBox.find('.total-order-list').each(function () {
                    const list = $(this);
                    list.find('.js-item').remove();

                    list.append(`
                <li class="total-order-item js-item">
                    <div class="not-selected">
                        Комплектующие не выбраны
                    </div>
                </li>
            `);
                });

                /* 2️⃣ Проходим по всем wrap-knot-box */
                $('.wrap-knot-box').each(function () {
                    const box = $(this);

                    const knot = box.data('knot');
                    if (!knot) return;

                    // 👉 определяем сторону
                    const side = box.hasClass('js-left')
                        ? 'js-left'
                        : box.hasClass('js-right')
                            ? 'js-right'
                            : null;

                    if (!side) return;

                    // 👉 ищем соответствующий итоговый список
                    const targetList = orderBox.find(
                        `.total-order-list.js-${knot}.${side}`
                    );

                    if (!targetList.length) return;

                    const checkedInputs = box.find('input.checkbox-order:checked');
                    if (!checkedInputs.length) return;

                    // убираем "не выбраны"
                    targetList.find('.not-selected').closest('.js-item').remove();

                    checkedInputs.each(function () {
                        const product = $(this).data('product');
                        if (!product) return;

                        // ➕ суммируем стоимость
                        const price = Number(product.price) || 0;
                        total += price;

                        // ➕ добавляем товар
                        targetList.append(
                            appOrder.renderTotalOrderItem(product, side)
                        );
                    });
                });

                /* 3️⃣ Обновляем сумму */
                $('.js-total').text(total);

                /* 4️⃣ Показываем блок заказа */
                orderBox.removeClass('hide');

                /* 5️⃣ Управление кнопками */
                if (total > 0) {
                    $('.create-order').removeClass('hide');
                    $('.create-order-disabled').addClass('hide');
                } else {
                    $('.create-order').addClass('hide');
                    $('.create-order-disabled').removeClass('hide');
                }

                /* 6️⃣ Информационный попап */
                const popUp = $('.pop-up');
                const message = popUp.find('.info-message-box');

                popUp.addClass('pop-up-active');
                popUp.find('.view-product-box').addClass('hide');
                message.removeClass('hide');
                message.find('.pop-up-button').removeClass('hide');

                $('.pop-up-info').text(
                    'Товары добавлены к заказу, вы можете посмотреть во вкладке "Состав заказа"'
                );
            });
        },



    closeModal() {
        $('.js-view-close ').on('click', function () {
            const popUp = $('.pop-up');
            const message = popUp.find('.info-message-box');

            $('.visible').removeClass('no-scroll');
            popUp.removeClass('pop-up-active');
            popUp.find('.view-product-box').addClass('hide');
            message.addClass('hide');
            message.find('.pop-up-button').addClass('hide');
        })
    },

    renderTotalOrderItem(p, side) {
        const inputName =
            side === 'js-left'
                ? 'left_products[]'
                : side === 'js-right'
                    ? 'right_products[]'
                    : 'products[]';

        return `
        <li class="total-order-item js-item">
            <div class="data-item di-total">
                <input type="hidden" name="${inputName}" value="${p.id}">
                <article class="data-item-info">
                    ${p.name}
                </article>
                <article class="data-item-info">
                    <div>
                        ${p.price} <i class="fa fa-ruble"></i>
                    </div>
                </article>
                <div class="wrap-checkbox-link">
                    <i class="fa fa-trash js-remove-total-item" aria-hidden="true"></i>
                </div>
            </div>
        </li>
    `;
    },


    recalculateTotal() {
        let total = 0;

        $('.wrap-total-order .data-item').each(function () {
            const priceText = $(this)
                .find('.data-item-info')
                .last()
                .text()
                .replace(/[^\d]/g, '');

            total += Number(priceText || 0);
        });

        $('.js-total').text(total);
    },

    removeTotalItem() {
        $(document).on('click', '.js-remove-total-item', function () {

            const item = $(this).closest('.js-item');
            const list = item.closest('.total-order-list');
            const wrapTotalOrder = item.closest('.wrap-total-order');

            // 1️⃣ Удаляем товар
            item.remove();

            // 2️⃣ Если в списке не осталось товаров — добавляем заглушку
            if (!list.find('.js-item .data-item').length) {
                list.append(`
                <li class="total-order-item js-item">
                    <div class="not-selected">
                        Комплектующие не выбраны
                    </div>
                </li>
            `);
            }

            // 3️⃣ Пересчёт суммы
            appOrder.recalculateTotal();

            // 4️⃣ Проверяем — остались ли товары вообще
            const hasAnyProducts = wrapTotalOrder.find('.js-item .data-item').length > 0;

            if (!hasAnyProducts) {
                $('.create-order').addClass('hide');
                $('.create-order-disabled').removeClass('hide');
            }
        });
    },
};

/* ---------------- init ---------------- */

$(document).ready(() => {
    appOrder.selectPatient();
    appOrder.openBlock();
    appOrder.selectValue();
    appOrder.switchKnot();
    appOrder.syncFiltersFromProduct();
    appOrder.viewProduct();
    appOrder.closeModal();
    appOrder.makeOrder();
    appOrder.removeTotalItem();
    appOrder.submitOrder();
});



