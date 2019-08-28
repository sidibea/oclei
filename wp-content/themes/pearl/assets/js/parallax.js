"use strict";


(function ($) {
    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function () {
        windowHeight = $window.height();
    });

    $.fn.parallax = function (xpos, speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var firstTop;

        $this.each(function () {
            firstTop = $this.offset().top;
        });

        if (outerHeight) {
            getHeight = function getHeight(jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function getHeight(jqo) {
                return jqo.height();
            };
        }

        if (arguments.length < 1 || xpos === null) xpos = "50%";
        if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
        if (arguments.length < 3 || outerHeight === null) outerHeight = true;

        function update() {
            var pos = $window.scrollTop();

            $this.each(function () {
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);

                if (top + height < pos || top > pos + windowHeight) {
                    return;
                }

                $this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
            });
        }

        $window.bind('scroll', update).resize(update);
        update();
    };

    $(window).load(function () {
        "use strict";

        $('.stm-parallax').each(function () {
            var parallax_id = $(this).attr('data-parallax');
            $('.stm-parallax[data-parallax="' + parallax_id + '"').parallax("50%", 0.3);
        });
    });
})(jQuery);