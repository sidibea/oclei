'use strict';

(function ($) {
    $(document).ready(function () {
        $('.stm_countdown .stm_countdown-container').each(function () {
            var dateStart = $(this).data('date');
            $(this).countdown(dateStart, function (event) {

                var days_plural = '%!D:' + pearl_countdown_translations.days + ';';
                var hours_plural = '%!H:' + pearl_countdown_translations.hours + ';';
                var minutes_plural = '%!M:' + pearl_countdown_translations.minutes + ';';
                var seconds_plural = '%!S:' + pearl_countdown_translations.seconds + ';';

                var str = '' + '<div class="counter">' + '<span class="counter__label">' + days_plural + '</span>' + '<span class="counter__value">%D</span>' + '</div>' + '<div class="counter">' + '<span class="counter__label">' + hours_plural + '</span>' + '<span class="counter__value">%H</span>' + '</div>' + '<div class="counter">' + '<span class="counter__label">' + minutes_plural + '</span>' + '<span class="counter__value">%M</span>' + '</div>' + '<div class="counter">' + '<span class="counter__label">' + seconds_plural + '</span>' + '<span class="counter__value">%S</span>' + '</div>';

                $(this).html(event.strftime(str));
            });
        });
    });
})(jQuery);