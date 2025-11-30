const appMaster = {

  header: function () {
    let num = 1;
    $(document).on('scroll', function () {

      if ($(document).scrollTop() > num) {
        $('.header').addClass('nav-scroll');
        $('.navigation-list-bottom').addClass('navigation-down');
      } else {
        $('.header').removeClass('nav-scroll');
        $('.navigation-list-bottom').removeClass('navigation-down');
      }
    });
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
      $('.wrap-pop-up').toggleClass('wrap-pop-up-active');
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
      slide = $('.slider-main-item'),
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
  }
};

$(document).ready(function () {
  appMaster.header();
  appMaster.hoverItem();
  appMaster.signInPopup();
  appMaster.authBoxSlider();
  appMaster.sliderFlicker();
  appMaster.productSlider();
  appMaster.switchAdminAside();
});
