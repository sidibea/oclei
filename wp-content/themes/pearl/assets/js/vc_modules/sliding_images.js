'use strict';

(function ($) {

    var screenTopPostion = 0;
    var elementVisible = false;
    var speedFactor = 0.1;

    $(document).ready(function () {
        screenTopPostion = $(window).scrollTop();
        slideImages();
    });

    $(window).load(function () {
        screenTopPostion = $(window).scrollTop();
        slideImages();
    });

    $(window).scroll(function () {
        slideImages();
    });

    function slideImages() {
        var st = $(window).scrollTop();
        var scrollAmount = 0;
        $('.stm_sliding_images').each(function () {

            if ($(this).is_on_screen()) {
                var rightImg = $(this).find('.stm_sliding_image__right');
                var leftImg = $(this).find('.stm_sliding_image__left');
                if (!elementVisible) {
                    elementVisible = true;
                    screenTopPostion = $(window).scrollTop();
                }

                scrollAmount = Math.abs((st - screenTopPostion) * speedFactor);

                if (scrollAmount > 90) scrollAmount = 90;

                rightImg.css({
                    'transform': 'translateY(-' + scrollAmount + 'px)'
                });

                leftImg.css({
                    'transform': 'translateY(' + scrollAmount + 'px)'
                });
            } else {
            }
        });
    }
})(jQuery);