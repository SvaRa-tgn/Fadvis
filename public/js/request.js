let request = {
    getData: function (form) {
        return {
            visible    : $('.visible'),
            popUp      : $('.pop-up'),
            authBox    : $('.auth-box'),
            recoveryBox: $('.recovery-box'),
            messageBox : $('.message-box'),
            info       : $('.js-info'),
            close      : $('.error-button'),
            regular    : $('.regular'),
            linkBox    : $('.link-button'),
            linkBtn    : $('.js-link'),
            changed    : $('.js-changed'),
            popUpItem  : $('.pop-up-item'),
            link       : form.attr('action'),
            button     : form.find('.js-button'),
            preloader  : form.find('.js-preloader'),
            dataForm   : form.attr('data-form'),
            formData   : new FormData(form[0]),
        }
    },

    response422: function (data, response) {
        let errors = response.responseJSON.errors;
        Object.keys(errors).forEach(function (key) {
            let error = $("." + key + "Error");
            error.addClass('notification');
            error.attr('data-notification', errors[key][0]);
        })
    },

    response400or500: function (data, response) {
        if (!data.visible.hasClass('no-scroll')) {
            data.visible.addClass('no-scroll');
        }

        if (!data.popUp.hasClass('pop-up-active')) {
            data.popUp.addClass('pop-up-active');
        }

        data.popUpItem.addClass('hide');
        data.messageBox.removeClass('hide');
        data.regular.addClass('hide');
        data.close.removeClass('hide');
        data.info.text(response.responseJSON.message);
    },

    preloader: function (data) {
        data.button.toggleClass('hide');
        data.preloader.toggleClass('hide');
    },

    openPopup: function (data) {
        data.visible.addClass('no-scroll');
        data.popUp.addClass('pop-up-active');

        if (data.dataForm === 'js-create' || data.dataForm === 'js-update') {
            data.linkBtn.removeClass('hide')
        }
    },

    message: function (data, response) {
        if (!data.visible.hasClass('no-scroll')) {
            data.visible.addClass('no-scroll');
        }

        if (!data.popUp.hasClass('pop-up-active')) {
            data.popUp.addClass('pop-up-active');
        }

        if (data.dataForm === 'js-create' || data.dataForm === 'js-update') {
            data.popUpItem.addClass('hide');
            data.messageBox.removeClass('hide');
        } else if (data.dataForm === 'js-auth') {
            data.authBox.toggleClass('hide');
            data.messageBox.toggleClass('hide');
        } else if (data.dataForm === 'js-recovery') {
            data.recoveryBox.toggleClass('hide');
            data.messageBox.toggleClass('hide');
        } else if (data.dataForm === 'js-change') {
            data.changed.toggleClass('hide');
            data.messageBox.toggleClass('hide');
        } else {
            data.authBox.toggleClass('hide');
        }
        data.info.text(response.message.message);

        request.close(data, response)
    },

    close: function (data, response) {
        if (data.dataForm === 'js-create' || data.dataForm === 'js-update') {
            data.linkBox.removeClass('hide');
            data.linkBtn.attr('href', response.message.link);
            data.regular.addClass('hide');
        } else if (data.dataForm === 'js-auth') {
            data.linkBox.addClass('hide');
            data.regular.removeClass('hide');
            data.linkBtn.attr('href', response.message.link).text(response.message.text);
            $('.js-reload-block').load(location.href + ' .js-reload-block>*', '');
        } else if (data.dataForm === 'js-recovery' || data.dataForm === 'js-change') {
            data.regular.addClass('hide');
            data.close.removeClass('hide');
        }
    },

    sendRequest: function (data){
        $.ajax({
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            url: data.link,
            data: data.formData,
            success: (response) => {
                request.preloader(data);
                request.openPopup(data);
                request.message(data, response);
            },
            error: (response) => {
                request.preloader(data);

                if (response.status === 400) {
                    request.response400or500(data, response);
                }

                if (response.status === 422) {
                    request.response422(data, response);
                }

                if (response.status === 500) {
                    request.response400or500(data, response);
                }
            },
        })
    },

    submit: function () {
        $('.js-response').submit(function (e){
            e.preventDefault();

            let form = $(this),
                data = request.getData(form);

            request.preloader(data);

            request.sendRequest(data);
        })
    },
};

$(document).ready(function () {
    request.submit();
});
