"use strict";

jQuery(document).ready(function ($) {
    "use strict";

    $(".stm_vertical_carousel").each(function () {
        var $el = $(this).find('.inner');
        var breakpoint_tablet = 769;
        var breakpoint_mobile = 479;
        $el.slick({
            dots: true,
            arrows: false,
            infinite: true,
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [{
                breakpoint: breakpoint_tablet,
                settings: {
                    slidesToShow: $el.data('slides-to-show-tablet'),
                    slidesToScroll: 1
                }
            }, {
                breakpoint: breakpoint_mobile,
                settings: {
                    slidesToShow: $el.data('slides-to-show-mobile'),
                    slidesToScroll: 1
                }
            }]
        });
    });
});