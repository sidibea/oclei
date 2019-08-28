'use strict';

(function ($) {
    "use strict";

    var owlRtl = false;
    if ($('body').hasClass('rtl')) {
        owlRtl = true;
    }

    $(document).ready(function () {
        $('[data-carousel="style_2"]').each(function () {
            var autoplay = $(this).data('autoplay');
            $(this).find('.stm_projects_mini__carousel').owlCarousel({
                rtl: owlRtl,
                items: 1,
                dots: true,
                nav: false,
                autoplay: autoplay,
                slideBy: 1,
                navText: '',
                loop: true
            });
        });
    });
})(jQuery);