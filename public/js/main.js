const appMaster = {
    sliderFlicker: function () {
        let n = 1,
            slide = $('.slider-flick'),
            opacity = 'slider-opacity',
            length = slide.length;

        function slider() {
            if (n < length) {
                slide.eq(n - 1).removeClass(opacity);
                slide.eq(n).addClass(opacity);
                n = n + 1;
            } else {
                n = 0
                slide.eq(-1).removeClass(opacity);
                slide.eq(n).addClass(opacity);
                n = n + 1;
            }
            return n
        }

        setInterval(slider, 6000);
    },

    checkPopUp: function () {
        let jsAuthBox   = $('.js-auth-box'),
            visible     = $('.visible'),
            popUp       = $('.pop-up'),
            jsAuth      = $('.js-auth'),
            jsResponse  = $('.js-response'),
            popUpItem   = $('.pop-up-item'),
            authBox     = $('.auth-box'),
            jsRecovery  = $('.js-recovery'),
            recoveryBox = $('.recovery-box'),
            jsClose     = $('.js-close'),
            jsChange    = $('.js-change'),
            jsChanged   = $('.js-changed'),
            input       = $('.auth-input');

        input.on('change', function(){
            input.parents('.pop-up-body-item').removeClass('notification');
        })

        jsAuthBox.on('click', function(){
            visible.toggleClass('no-scroll');
            popUp.toggleClass('pop-up-active');
            authBox.toggleClass('hide');
        })

        jsRecovery.on('click', function(){
            authBox.toggleClass('hide');
            recoveryBox.toggleClass('hide');
        })

        jsChange.on('click', function(){
            visible.toggleClass('no-scroll');
            popUp.toggleClass('pop-up-active');
            jsChanged.toggleClass('hide');
        })

        jsClose.on('click', function(){
            popUpItem.addClass('hide');
            popUp.toggleClass('pop-up-active');
            visible.toggleClass('no-scroll');
            location.reload();
        })
    },

    createPatient: function () {
        let leftLevel = 'left_level',
            rightLevel= 'right_level',
            leftSelect     = $('.js-left-select'),
            leftSelectVal  = leftSelect.val(),
            rightSelect    = $('.js-right-select'),
            rightSelectVal = rightSelect.val(),
            leftHand       = $('.js-left-hand'),
            leftWrist      = $('.js-left-wrist'),
            rightHand      = $('.js-right-hand'),
            rightWrist     = $('.js-right-wrist'),
            select         = $('.js-select-level');

        function optionLeft(first, second) {
            first.attr('name', leftLevel);
            second.removeAttr('name');
            select.removeClass('hide');

            if (first.parent().hasClass('hide')) {
                first.parent().removeClass('hide');
            }

            if (!second.parent().hasClass('hide')) {
                second.parent().addClass('hide');
            }
        }

        function optionRight(first, second) {
            first.attr('name', rightLevel);
            second.removeAttr('name');
            select.removeClass('hide');

            if (first.parent().hasClass('hide')) {
                first.parent().removeClass('hide');
            }

            if (!second.parent().hasClass('hide')) {
                second.parent().addClass('hide');
            }
        }

        function optionLeftHand() {
            optionLeft(leftHand, leftWrist);
        }

        function optionLeftWrist() {
            optionLeft(leftWrist, leftHand)
        }

        function optionRightHand() {
            optionRight(rightHand, rightWrist);
        }

        function optionRightWrist() {
            optionRight(rightWrist, rightHand);
        }

        if (leftSelectVal !== '' && leftSelectVal !== 'null') {
            if (leftSelectVal === 'prothesis_hand') {
                optionLeftHand();
            }

            if (leftSelectVal === 'prothesis_wrist') {
                optionLeftWrist();
            }
        }

        if (rightSelectVal !== '' && rightSelectVal !== 'null') {
            if (rightSelectVal === 'prothesis_hand') {
                optionRightHand();
            }

            if (rightSelectVal === 'prothesis_wrist') {
                optionRightWrist();
            }
        }

        leftSelect.on('change', function(){
            if (leftSelect.val() === '' || leftSelect.val() === 'null' ) {
                leftHand.removeAttr('name');
                leftWrist.removeAttr('name');

                if (!leftHand.parent().hasClass('hide')) {
                    leftHand.parent().addClass('hide');
                }

                if (!leftWrist.parent().hasClass('hide')) {
                    leftWrist.parent().addClass('hide');
                }

                if (!rightSelect.val() || rightSelect.val() === 'null') {
                    select.addClass('hide');
                }
            }

            if (leftSelect.val() === 'prothesis_hand') {
                optionLeftHand();
            }

            if (leftSelect.val() === 'prothesis_wrist') {
                optionLeftWrist();
            }
        })

        rightSelect.on('change', function(){
            if (rightSelect.val() === '' || rightSelect.val() === 'null' ) {
                rightHand.removeAttr('name');
                rightWrist.removeAttr('name');

                if (!rightHand.parent().hasClass('hide')) {
                    rightHand.parent().addClass('hide');
                }

                if (!rightWrist.parent().hasClass('hide')) {
                    rightWrist.parent().addClass('hide');
                }

                if (!leftSelect.val()  || leftSelect.val()  === 'null') {
                    select.addClass('hide');
                }
            }

            if (rightSelect.val() === 'prothesis_hand') {
                optionRightHand();
            }

            if (rightSelect.val() === 'prothesis_wrist') {
                optionRightWrist();
            }
        })
    },

    selectWatcher: function () {
        let hand = $('.hand'),
            wrist = $('.wrist');

        $('#type').on('change', function () {
            let value = $(this).val();

            if (value === 'prothesis_hand') {
                hand.removeClass('hide').find('select').attr('name', 'level');
                wrist.addClass('hide').find('select').removeAttr('name');
            } else {
                hand.addClass('hide').find('select').removeAttr('name');
                wrist.removeClass('hide').find('select').attr('name', 'level');
            }
        }).trigger('change');
    },

    orderPopUp: function () {
        $('.js-order-up').on('click', function(){
            $('.pop-up').addClass('pop-up-active');
            $('.order-box').removeClass('hide');
        })
    },

    hoverItem: function () {
        $('.catalog-link').hover(function () {
            $(this).parents('.filter-catalog').toggleClass('left-content-hover');
        })

        $('.product-link').hover(function () {
            $(this).parents('.filter-catalog').toggleClass('left-content-hover');
        })
    },

    signInPopup: function () {
        $('.pop-up-switch').on('click', function () {
            $('.visible').toggleClass('no-scroll');
            $('.auth-block').toggleClass('wrap-pop-up-active');
            $('.notification').removeClass('view-notification');
        })

        $('.notification-switch').on('click', function () {
            $('.visible').addClass('no-scroll');
            $('.wrap-pop-up').removeClass('wrap-pop-up-active');
            $('.js-response')[0].reset();
        })

        $('.password-switch').on('click', function () {
            $('.visible').addClass('no-scroll');
            $('.wrap-pop-up').removeClass('wrap-pop-up-active');
            $('.change-password-block').addClass('wrap-pop-up-active');
            $('.js-response')[0].reset();
        })

        $('.js-close').on('click', function () {
            $('.visible').removeClass('no-scroll');
            $('.wrap-pop-up').removeClass('wrap-pop-up-active');
            $('.js-response')[0].reset();
            $('.js-auth')[0].reset();
            $('.notification').removeClass('form-notification')
        })

        $('.js-resend').on('click', function () {
            $('.visible').addClass('no-scroll');
            $('.pop-up').addClass('pop-up-active');
            $('.pop-up-item').addClass('hide');
            $('.resend-box').removeClass('hide');
        })
    },


    authBoxSlider: function () {
        $('.pop-up-link').on('click', function () {
            $('.auth-box').toggleClass('view-form');
            $('.recovery-box').toggleClass('view-form');
        })
    },



    productSlider: function () {
        let sliderItem = $('.slider-item');

        $('.switch-item-img').click(function () {
            $('.switch-item-img').removeClass('active');
            $(this).addClass('active');
            let sliderItem = $(this).parents('.content-slider-wrap').children('.slider-list').children('.slider-item');

            let eq = $(this).parents('.switch-slider-item').index();

            sliderItem.removeClass('slider-item-active');
            sliderItem.eq(eq).addClass('slider-item-active');
        });
    },

    switchAdminAside: function () {
        $('.aside-menu-link').click(function () {
            $('.aside-menu-link').removeClass('active-menu-link');
            $(this).addClass('active-menu-link');
        })
    },

    newPatient: function () {
        $('.js-new-patient').on('click', function () {
            $('.visible').addClass('no-scroll');
            $('.new-patient-box').addClass('wrap-pop-up-active');
        })

        $('.close-switch').on('click', function () {
            $('.visible').removeClass('no-scroll');
            $('.new-patient-box').removeClass('wrap-pop-up-active');
            $('.new-item-box').removeClass('wrap-pop-up-active');
        })

        $('.add-item').on('click', function () {
            $('.visible').addClass('no-scroll');
            $('.new-item-box').addClass('wrap-pop-up-active');
        })
    },

    toggleSizeItem: function () {
        $('.size-filter-item').on('click', function () {
            let eq = $(this).index();
            let form = $('.position-item');
            $('.size-filter-item').removeClass('active-size');
            $(this).addClass('active-size');
            form.addClass('hide');
            form.eq(eq - 1).removeClass('hide');
        })
    },
};

$(document).ready(function () {
    appMaster.sliderFlicker();
    appMaster.checkPopUp();
    appMaster.createPatient();
    appMaster.orderPopUp();
    appMaster.hoverItem();
    appMaster.signInPopup();

    appMaster.selectWatcher();
    appMaster.authBoxSlider();
    appMaster.productSlider();
    appMaster.switchAdminAside();
    appMaster.newPatient();
    appMaster.toggleSizeItem();
});
