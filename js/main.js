$(function () {

    /*CALLORDER*/
    const callorder = $('.callorder');
    $('form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this),
            data = form.serialize();

        $.ajax({
            dataType: "json",
            type: "POST",
            url: 'ajax.php',
            data: data,
            success: function (result) {

                if (result.status) {
                    form.append(result.html);
                } else {
                    alert('Что-то пошло не так, попробуйте еще раз!!!');
                }
            },
            error: function (result) {
                alert('Что-то пошло не так, попробуйте еще раз!!!');
            }
        });
    });

    $('body').on('click', '.form__success-close', function (e) {
        $('.form__success').remove();
    });

    $('body').on('click', '.jsCallorderOpen', function (e) {
        e.preventDefault();
        modal.removeClass('active');
        callorder.addClass('active');
    });
    $('body').on('click', '.jsCallorderClose', function (e) {
        e.preventDefault();
        callorder.removeClass('active');
    });
    /*END CALLORDER*/

    /*MODAL*/
    const modal = $('.modal');
    $('body').on('click', '.jsModalOpen', function (e) {
        e.preventDefault();
        let modalContent = modal.find('.modal__content'),
        data = {
            id: parseInt($(this).data('id')),
            action: 'modalOpen'
        };

        $.ajax({
            dataType: "json",
            type: "POST",
            url: 'ajax.php',
            data: data,
            success: function (result) {
                if (result.status) {
                    modalContent.html(result.html);
                    modal.addClass('active');
                    callorder.removeClass('active');
                } else {
                    alert('Что-то пошло не так, попробуйте еще раз!!!');
                }
            },
            error: function (result) {
                alert('Что-то пошло не так, попробуйте еще раз!!!');
            }
        });
    });
    $('body').on('click', '.jsModalClose', function (e) {
        e.preventDefault();
        modal.removeClass('active');
    });
    /*END MODAL*/

    /*SWIPER*/
    const slider = new Swiper('.slider__container', {
        // Optional parameters
        // loop: true,
        speed: 700,
        mousewheel: true,
        // Navigation arrows
        navigation: {
            nextEl: '.slider__next',
            prevEl: '.slider__prev',
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
            formatFractionTotal: function (number) {
                if (number < 10) {
                    return '0' + number;
                } else {
                    return number;
                }
            },
            formatFractionCurrent: function (number) {
                if (number < 10) {
                    return '0' + number;
                } else {
                    return number;
                }
            },
            renderFraction: function (currentClass, totalClass) {
                return '<div class="' + currentClass + ' slider__pagination-item"></div>' +
                    '<div class="slider__pagination-seporator"></div> ' +
                    '<div class="' + totalClass + ' slider__pagination-item"></div>';
            },
        },

    });
    /*END SWIPER*/

});