'use strict';

(function ($) {
    "use strict";

    $(document).ready(function () {
        postscarousel();
        posthover();
    });

    var carousel_timer;

    function posthover() {
        $('.stm_posts_carousel_style_4 li').on('mouseenter click', function (e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
            }
            clearTimeout(carousel_timer);

            var $container = $(this).closest('.stm_posts_carousel_style_4');
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

        $('.stm_posts_carousel_style_4 li').on('mouseleave', function (e) {
            postscarousel();
        });

        $('.stm_posts_carousel_style_4').swipe({
            swipeLeft: function swipeLeft(e) {
                if (window.innerWidth < 500) {
                    clearTimeout(carousel_timer);
                    postscarousel(0);
                }
            }
        });
    }

    function postscarousel() {
        var timeout = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 4000;


        carousel_timer = setTimeout(function () {

            var $carousel = $('.stm_posts_carousel_style_4');

            $carousel.each(function () {
                var current = $(this).find('li.active').index() + 1;
                var total = $(this).find('li').length;

                if (current == total) current = 0;

                $(this).find('.stm_posts_carousel_single').removeClass('active');
                $(this).find('.stm_posts_carousel_single').eq(current).addClass('active');

                $(this).find('li').removeClass('active');
                $(this).find('li').eq(current).addClass('active');
            });

            postscarousel();
        }, timeout);
    }
})(jQuery);