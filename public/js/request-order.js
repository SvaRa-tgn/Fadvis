let requestOrderData = {
    apiRequest: function (){
        let patient  = $('#patient-order'),
            form     = $('.js-order'),
            side     = $('.side-order'),
            left     = $('#left-side'),
            right    = $('#right-side'),
            sideBox  = $('.side-box'),
            leftBox  = $('.left-type-box'),
            rightBox = $('.right-type-box'),
            link     = form.attr('data-link');

        function values () {
            return {
                patient: patient.val(),
                side: side.val(),
                left_side: left.val(),
                right_side: right.val(),
            };
        }

        function ajax (formData, link) {
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

                },
            })
        }

        patient.on('change', function () {
            if (patient.val() !== '') {
                sideBox.removeClass('hide');
            }
        })

        side.on('change', function (){
            if ($(this).val() === 'left') {
                leftBox.removeClass('hide');
                rightBox.addClass('hide');
            } else if ($(this).val() === 'right') {
                leftBox.addClass('hide');
                rightBox.removeClass('hide');
            } else if ($(this).val() === 'universal') {
                leftBox.removeClass('hide');
                rightBox.removeClass('hide');
            }
        })

    },
};

$(document).ready(function () {
    requestOrderData.apiRequest();
});
