"use strict";

(function ($) {
    $(document).ready(function () {
        $(".events_lessons_box .event_lesson_tabs:first-child").addClass("active");
        $('.events_lessons_box .event_lesson_tabs a').each(function (e) {
            if ($(this).parent().hasClass("active")) {
                $($(this).attr('href')).show();
            }
        });
        $('.events_lessons_box .event_lesson_tabs a').on('click', function (e) {
            $(this).parents(".events_lessons_box").find(".event_lesson_info").hide();
            $(this).parents(".events_lessons_box").find(".event_lesson_tabs").removeClass("active");
            $(this).parent().addClass("active");
            $($(this).attr("href")).show();
            return false;
        });
    });
})(jQuery);