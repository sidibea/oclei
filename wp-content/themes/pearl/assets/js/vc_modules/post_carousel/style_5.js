'use strict';

(function ($) {
    "use strict";

    var owl = $('.stm_posts_carousel_style_5 .owl-carousel');
    var data = owl.data();
    var number_row_laptop = data['numberRowLaptop'];
    var number_row_desktop = data['numberRowDesktop'];
    var number_row_tablet = data['numberRowTablet'];
    var loop = data['loop'];
    var dots = data['dots'];
    var autoplay = data['autoplay'];
    var nav = data['nav'];

    $(document).ready(function () {
        var owlRtl = false;
        if ($('body').hasClass('rtl')) {
            owlRtl = true;
        }

        owl.owlCarousel({
            rtl: owlRtl,
            items: 1,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: number_row_tablet
                },
                1025: {
                    items: number_row_laptop
                },
                1367: {
                    items: number_row_desktop
                }
            },
            dots: dots,
            autoplay: autoplay,
            nav: nav,
            margin: 0,
            autoplaySpeed: 1500,
            slideBy: 1,
            loop: loop
        });
    });
})(jQuery);