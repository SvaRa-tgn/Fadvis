// =========================
// UI
// =========================
const appOrder = {

    selectPatient() {
        $('.js-select-patient').on('change', function () {
            const select = $(this);
            const form = select.closest('.js-response');
            const patientId = select.val();
            const button = form.find('.js-button');
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
            }
        });
    },

    selectValue() {
        $(document).on('click', '.choice-filter:not(.disabled-filter)', function () {
            const item = $(this);
            const orderBox = item.closest('.js-order-value-box');

            const groupClass = item.attr('class')
                .split(' ')
                .find(c => c.endsWith('-list'));

            const wasActive = item.hasClass('active-filter');

            orderBox.find('.' + groupClass).removeClass('active-filter');
            if (!wasActive) item.addClass('active-filter');

            OrderFilter.markManualFilter(orderBox);
            OrderFilter.updateProducts(orderBox);
        });
    }
};

// =========================
// FILTER ENGINE
// =========================
const OrderFilter = {

    selectedProducts: {},
    manualFilterTouched: {},

    GRIP_MAP: { 'ЭКЦС': 'ekcs', 'Альфа': 'alfa' },
    GRIP_REVERSE_MAP: { ekcs: 'ЭКЦС', alfa: 'Альфа' },

    SYSTEM_MAP: { 'Активный': 'active', 'Пассивный': 'passive' },
    SYSTEM_REVERSE_MAP: { active: 'Активный', passive: 'Пассивный' },

    RULES: {
        'js-shoulder_knot': { grip: true,  system: false },
        'js-elbow_knot':    { grip: true,  system: false },
        'js-wrist_knot':    { grip: true,  system: true  },
        'js-nozzle':        { grip: false, system: true  },
    },

    init() {
        this.bindSwitchKnot();
        this.bindProductSelect();

        $('.js-order-value-box').each((_, el) => {
            this.updateProducts($(el), true);
        });
    },

    // -------------------------
    bindSwitchKnot() {
        $(document).on('click', '.js-switch-next, .js-switch-prev', (e) => {
            const btn = $(e.currentTarget);
            const orderBox = btn.closest('.js-order-value-box');
            const target = btn.data('next') || btn.data('prev');
            if (!target) return;

            orderBox.find('.wrap-knot-box').addClass('hide');
            orderBox.find('.' + target).removeClass('hide');

            orderBox.find('.item-select-header-item')
                .removeClass('item-select-active')
                .filter('.' + target)
                .addClass('item-select-active');

            orderBox.find('.choice-filter.active-filter')
                .addClass('disabled-filter');

            this.updateProducts(orderBox);
        });
    },

    // -------------------------
    bindProductSelect() {
        $(document).on('change', '.checkbox-order', (e) => {
            const input = $(e.currentTarget);
            const orderBox = input.closest('.js-order-value-box');
            const knot = this.getCurrentKnot(orderBox);
            const id = String(input.val());

            this.selectedProducts[knot] ??= [];

            if (input.is(':checked')) {
                if (!this.selectedProducts[knot].includes(id)) {
                    this.selectedProducts[knot].push(id);
                }
            } else {
                this.selectedProducts[knot] =
                    this.selectedProducts[knot].filter(v => v !== id);
            }

            if (!this.selectedProducts[knot].length) {
                this.resetFilters(orderBox);
            } else {
                this.syncFiltersFromProducts(orderBox);
            }

            this.updateProducts(orderBox);
        });
    },

    // -------------------------
    markManualFilter(orderBox) {
        const key = this.getCurrentKnot(orderBox);
        this.manualFilterTouched[key] = true;
    },

    // -------------------------
    syncFiltersFromProducts(orderBox) {
        const knot = this.getCurrentKnot(orderBox);
        if (this.manualFilterTouched[knot]) return;

        const products = this.getSelectedProducts(orderBox, knot);
        const base = products.find(p =>
            p.collection !== null && p.size !== 'Индивидуальный'
        );
        if (!base) return;

        orderBox.find('.active-filter').removeClass('active-filter');

        if (base.collection) {
            orderBox.find('.grip-list')
                .filter((_, el) =>
                    $(el).text().trim() === this.GRIP_REVERSE_MAP[base.collection]
                ).addClass('active-filter');
        }

        if (base.size && base.size !== 'Индивидуальный') {
            orderBox.find('.size-list')
                .filter((_, el) => $(el).text().trim() === base.size)
                .addClass('active-filter');
        }

        if (base.view) {
            orderBox.find('.system-list')
                .filter((_, el) =>
                    $(el).text().trim() === this.SYSTEM_REVERSE_MAP[base.view]
                ).addClass('active-filter');
        }
    },

    // -------------------------
    resetFilters(orderBox) {
        const knot = this.getCurrentKnot(orderBox);
        this.manualFilterTouched[knot] = false;
        orderBox.find('.choice-filter')
            .removeClass('active-filter disabled-filter');
    },

    // -------------------------
    updateProducts(orderBox, initial = false) {
        const products = this.filterProducts(orderBox, initial);
        this.renderProducts(orderBox, products);
    },

    // -------------------------
    filterProducts(orderBox, initial) {
        let products = orderBox.closest('.order-block').data('products');
        if (!products) return [];
        if (typeof products === 'string') products = JSON.parse(products);

        const knot = this.getCurrentKnot(orderBox);
        const side = orderBox.find('.user-data-profile').data('side');

        let list = products.filter(p => {
            if (p.level !== knot) return false;
            if (side === 'left' && !['left', 'universal'].includes(p.side)) return false;
            if (side === 'right' && !['right', 'universal'].includes(p.side)) return false;
            return true;
        });

        if (initial) return list;

        const grip = orderBox.find('.grip-list.active-filter').text().trim();
        const system = orderBox.find('.system-list.active-filter').text().trim();
        const size = orderBox.find('.size-list.active-filter').text().trim();

        return list.filter(p => {
            if (grip) {
                const v = this.GRIP_MAP[grip];
                if (!(p.collection === v || p.collection === null)) return false;
            }

            if (system && p.view !== this.SYSTEM_MAP[system]) return false;

            if (size && ![size, 'Индивидуальный'].includes(p.size)) return false;

            return true;
        });
    },

    // -------------------------
    renderProducts(orderBox, products) {
        const box = orderBox.find('.wrap-knot-box:not(.hide)');
        const knot = this.getCurrentKnot(orderBox);
        const selected = this.selectedProducts[knot] || [];

        const list = box.find('.item-select-list').empty();

        if (!products.length) {
            list.append(`<li class="item-select-item empty">Нет товаров</li>`);
            return;
        }

        products.forEach(p => {
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
                    </label>
                </li>
            `);
        });
    },

    // -------------------------
    getCurrentKnot(orderBox) {
        return orderBox.find('.wrap-knot-box:not(.hide)').data('knot');
    },

    getSelectedProducts(orderBox, knot) {
        let products = orderBox.closest('.order-block').data('products');
        if (typeof products === 'string') products = JSON.parse(products);

        return (this.selectedProducts[knot] || [])
            .map(id => products.find(p => String(p.id) === id))
            .filter(Boolean);
    }
};

// =========================
// INIT
// =========================
$(document).ready(() => {
    appOrder.selectPatient();
    appOrder.openBlock();
    appOrder.selectValue();
    OrderFilter.init();
});
