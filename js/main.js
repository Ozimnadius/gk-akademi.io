// $(function () {


    const slider = new Swiper ('.slider__container', {
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
            formatFractionTotal: function(number) {
               if (number <10) {
                   return '0'+number;
               } else  {
                   return number;
               }
            },
            formatFractionCurrent: function(number) {
                if (number <10) {
                    return '0'+number;
                } else  {
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
// });