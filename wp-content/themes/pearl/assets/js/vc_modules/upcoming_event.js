'use strict';

(function ($) {
    $(document).ready(function () {
        $('.stm_upcoming_event__counter .stm_upcoming_event__counter-container').each(function () {
            var dateStart = $(this).data('date');
            var timeStamp = new Date(dateStart).getTime();
            var daysCount = Math.round(Math.abs(timeStamp) / 86400000 );
            $(this).countdown(dateStart, function (event) {

                var month_plural = '%!m:' + pearl_translations.month + ';';
                var days_plural = '%!D:' + pearl_translations.days + ';';
                var hours_plural = '%!H:' + pearl_translations.hours + ';';
                var minutes_plural = '%!M:' + pearl_translations.minutes + ';';
                var seconds_plural = '%!S:' + pearl_translations.seconds + ';';

                var counter = function counter(type) {
                    var format, plural;
                    switch (type) {
                        case 'm':
                            format = '%m';
                            plural = month_plural;
                            break;
                        case 'd':
                            format = '%D';
                            plural = days_plural;
                            break;
                        case 'h':
                            format = '%H';
                            plural = hours_plural;
                            break;
                        case 'M':
                            format = '%M';
                            plural = minutes_plural;
                            break;
                        case 'S':
                            format = '%S';
                            plural = seconds_plural;
                            break;
                    }

                    return '<div class="counter">' + '<span class="counter__label">' + plural + '</span>' + '<span class="counter__value heading_font stc">' + format + '</span>' + '</div>';
                };

                var str = counter('d') + counter('h') + counter('M') + counter('S');

                $(this).html(event.strftime(str));
            });
        });
    });
})(jQuery);