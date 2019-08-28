'use strict';

(function ($) {
    "use strict";

    $(document).ready(function () {
        post_carousel();
        post_carousel_hover();
    });

    var carousel_timer;

    function post_carousel_hover() {
        $('.stm_posts_carousel_style_2 li').on('click', function (e) {
            clearTimeout(carousel_timer);

            var $container = $(this).closest('.stm_posts_carousel_style_2');
            var image = '.stm_posts_carousel_single';
            var single = 'li';

            var current = $(this).index();
            var total = $(this).closest($container).find(single).length;
            if (current == total) current = 0;

            $container.find(image).removeClass('active');
            $container.find(single).removeClass('active');

            $(this).addClass('active');
            $container.find(image).eq(current).addClass('active');
        });
    }

    function post_carousel() {

        carousel_timer = setTimeout(function () {

            var $carousel = $('.stm_posts_carousel_style_2');

            $carousel.each(function () {
                var current = $(this).find('li.active').index() + 1;
                var total = $(this).find('li').length;

                if (current == total) current = 0;

                $(this).find('.stm_posts_carousel_single').removeClass('active');
                $(this).find('.stm_posts_carousel_single').eq(current).addClass('active');

                $(this).find('li').removeClass('active');
                $(this).find('li').eq(current).addClass('active');
            });

            post_carousel();
        }, 4000);
    }
})(jQuery);