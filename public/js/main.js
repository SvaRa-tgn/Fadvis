const appMaster = {

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

    $('.js-close').on('click', function (){
        $('.visible').removeClass('no-scroll');
        $('.wrap-pop-up').removeClass('wrap-pop-up-active');
        $('.js-response')[0].reset();
        $('.js-auth')[0].reset();
        $('.notification').removeClass('form-notification')
    })
  },

  selectWatcher: function () {
      $('#type').on('change', function (){
          let value = $(this).val();

          if (value === 'prothesis_hand') {
              $('.hand').removeClass('hide non-actual');
              $('.wrist').addClass('hide non-actual');
          } else {
              $('.hand').addClass('hide non-actual');
              $('.wrist').removeClass('hide non-actual');
          }
      })
  },

  authBoxSlider: function () {
    $('.pop-up-link').on('click', function () {
      $('.auth-box').toggleClass('view-form');
      $('.recovery-box').toggleClass('view-form');
    })
  },

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
      form.eq(eq-1).removeClass('hide');
    })
  },
};

$(document).ready(function () {
  appMaster.hoverItem();
  appMaster.signInPopup();
  appMaster.selectWatcher();
  appMaster.authBoxSlider();
  appMaster.sliderFlicker();
  appMaster.productSlider();
  appMaster.switchAdminAside();
  appMaster.newPatient();
  appMaster.toggleSizeItem();
});
