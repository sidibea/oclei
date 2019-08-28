'use strict';

(function ($) {

    $(document).ready(function () {
        slideImages();
    });

    $(window).load(function () {
        slideImages();
    });

    $(window).scroll(function () {
        slideImages();
    });

    var screenTopPostion = 0;
    var elementVisible = false;
    var speedFactor = 0.15;

    function slideImages() {
        var st = $(window).scrollTop();
        var scrollAmount = 0;
        $('.stm_sliding_image_text__image').each(function () {
            if ($(this).is_on_screen()) {
                if (!elementVisible) {
                    elementVisible = true;
                    screenTopPostion = $(window).scrollTop();
                }

                scrollAmount = Math.abs((st - screenTopPostion) * speedFactor);

                if (scrollAmount > 500) scrollAmount = 500;

                $(this).css({
                    'transform': 'translateX(-' + scrollAmount + 'px)'
                });
            } else {
            }
        });
    }
})(jQuery);