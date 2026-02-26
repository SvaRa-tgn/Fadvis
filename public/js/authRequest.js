let requestData = {
    auth: function (){
        let authBox    = $('.auth-box'),
            messageBox = $('.message-box'),
            info       = $('.js-info'),
            close      = $('.error-button'),
            regular    = $('.regular-button')


        function sendRequest(formData, link, button, preloader){
            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    Accept: "application/json"
                },
                url: link,
                data: formData,
                success: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');
                    authBox.addClass('hide');
                    messageBox.removeClass('hide');
                    info.text('Вы успешно авторизовались');
                },
                error: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');

                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            let error = $("." + key + "Error");
                            error.addClass('notification');
                            error.attr('data-notification', errors[key][0]);
                        })
                    }

                    if (response.status === 500) {
                        authBox.addClass('hide');
                        messageBox.removeClass('hide');
                        info.text(response.responseJSON.message);
                        close.removeClass('hide');
                        regular.addClass('hide');
                    }
                },
            })
        }

        $('.js-auth').submit(function (e){
            e.preventDefault();

            let form = $(this),
                link      = form.attr('action'),
                button    = form.find('.js-button'),
                preloader = form.find('.js-preloader'),
                formData = new FormData(form[0]);

            button.addClass('hide');
            preloader.removeClass('hide');

            sendRequest(formData, link, button, preloader);
        })
    },

    apiRequest: function (){
        $('.js-responsefg').submit(function (e){
            e.preventDefault();
            let form         = $(this),
                notification = $('.notification-block'),
                link         = form.attr('action'),
                button       = form.find('.js-button'),
                preloader    = form.find('.js-preloader'),
                title        = notification.find('.pop-up-title'),
                notify       = notification.find('.notification'),
                linkAdmin    = $('.link-admin'),
                hide         = $('.non-actual').find('.input'),
                linkOrder    = form

            button.addClass('hide');
            preloader.removeClass('hide');
            console.log(hide.val());
            if (hide) {
                hide.prop('disabled', true);
            }

            let formData = new FormData(form[0]);

            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    Accept: "application/json",
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                },
                url: link,
                data: formData,
                success: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');
                    $('.visible').addClass('no-scroll');
                    $('.wrap-pop-up').removeClass('wrap-pop-up-active');
                    notification.addClass('wrap-pop-up-active');
                    $('.notification-switch').addClass('hide');
                    if (form.attr('data-delete') === 'delete' || form.attr('data-add') === 'add') {
                        notify.text(response.message.message);
                        linkAdmin.addClass('hide');
                        $('.js-close').removeClass('hide');
                        $('.js-reload-block').load(location.href + ' .js-reload-block>*', '');

                    } else if (form.attr('data-form') === 'changed') {
                        notify.text(response.message.message);
                        linkAdmin.addClass('hide');
                        $('.js-close').addClass('hide');
                        $('.link-logout').removeClass('hide');
                    } else if (form.attr('data-patient') === 'order-patient') {
                        notify.text(response.message.message);
                        linkAdmin.addClass('hide');
                        $('.js-close').removeClass('hide');
                        location.reload()
                    } else {
                        $('.js-close').addClass('hide');
                        linkAdmin.removeClass('hide').text('Отлично').attr('href', response.message.route);
                        notify.text(response.message.message);
                        form[0].reset();
                    }

                },
                error: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');

                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            let error = $("." + key + "Error");
                            error.addClass('form-notification');
                            error.attr('data-notification', errors[key][0]);
                        })
                    }

                    if (response.status === 500) {
                        $('.visible').addClass('no-scroll');
                        $('.wrap-pop-up').removeClass('wrap-pop-up-active');
                        notification.addClass('wrap-pop-up-active');
                        title.text('Ошибка');
                        notify.text(response.responseJSON.message);
                        $('.close').removeClass('hide');
                        linkAdmin.addClass('hide');
                    }
                },
            })
        })
    },

    logOut: function (){
        $('.logout-form-k').submit(function (e){
            e.preventDefault();
            let form         = $(this),
                notification = $('.notification-block'),
                link         = form.attr('action'),
                button       = form.find('.js-button'),
                preloader    = form.find('.js-preloader'),
                title        = notification.find('.pop-up-title'),
                notify       = notification.find('.notification'),
                linkAdmin    = $('.link-admin');

            button.addClass('hide');
            preloader.removeClass('hide');

            let formData = new FormData(form[0]);

            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    Accept: "application/json"
                },
                url: link,
                data: formData,
                success: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');
                    $('.visible').toggleClass('no-scroll');
                    $('.wrap-pop-up').removeClass('wrap-pop-up-active');
                    notification.addClass('wrap-pop-up-active');
                    $('.notification-switch').addClass('hide');
                    linkAdmin.removeClass('hide').text('Отлично').attr('href', response.message.route);
                    title.text(response.message.title);
                    notify.text(response.message.message);
                    form[0].reset();
                },
                error: (response) => {
                    button.removeClass('hide');
                    preloader.addClass('hide');

                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        console.log(errors);
                        Object.keys(errors).forEach(function (key) {
                            let error = $("." + key + "Error");
                            error.addClass('form-notification');
                            error.attr('data-notification', errors[key][0]);
                        })
                    }

                    if (response.status === 500) {
                        $('.visible').toggleClass('no-scroll');
                        $('.wrap-pop-up').removeClass('wrap-pop-up-active');
                        notification.addClass('wrap-pop-up-active');
                        title.text('Ошибка');
                        notify.text(response.responseJSON.message);
                        $('.close').removeClass('hide');
                        linkAdmin.addClass('hide');
                    }
                },
            })
        })
    },
};

$(document).ready(function () {
    requestData.auth();
    requestData.apiRequest();
    requestData.logOut();

});
