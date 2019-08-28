"use strict";

(function ($) {

    var windowWidth = 0;
    var quarter = 0;
    var height = 200;

    $(document).ready(function () {
        drawSvg();
    });

    $(window).resize(function () {
        drawSvg();
    });

    $(window).scroll(function () {
        animateSvg();
    });

    function drawSvg() {
        windowWidth = $("body").prop("clientWidth");

        $('svg.vc_row_canvas_anim').each(function () {
            $(this).addClass('loaded');

            quarter = windowWidth / 4;
            var $path = $(this).find('path');

            $path.attr('d', 'M0, ' + height + 'C' + quarter + ', 170' + ' ' + quarter * 3 + ', 170' + ' ' + windowWidth + ', ' + height + 'L' + windowWidth + ', ' + height + 'L0,' + height);
        });
    }

    var screenTopPostion = 0;
    var elementVisible = false;
    var speedFactor = 0.3;

    function animateSvg() {
        var st = $(window).scrollTop();
        var scrollAmount = 0;
        $('.vc_row_canvas_anim').each(function () {

            if ($(this).is_on_screen()) {
                var $path = $(this).find('path');
                if (!elementVisible) {
                    elementVisible = true;
                    screenTopPostion = $(window).scrollTop();
                }

                scrollAmount = Math.abs(height - Math.abs((st - screenTopPostion) * speedFactor));
                if (scrollAmount > height) scrollAmount = height;

                $path.attr('d', 'M0,' + scrollAmount + 'C' + quarter + ',170 ' + ' ' + quarter * 3 + ',170 ' + ' ' + windowWidth + ', ' + scrollAmount + 'L' + windowWidth + ', ' + height + 'L0,' + height);
            }
        });
    }
})(jQuery);