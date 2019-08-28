'use strict';

(function ($) {
    "use strict";

    $(document).ready(function () {
        var inputs = $('input, textarea').not(':input[type=button], ' + ':input[type=submit], ' + ':input[type=reset], ' + ':input[type=checkbox], ' + ':input[type=radio], ' + '.default-form, ' + ':input[type=search][name="s"], ' + '#coupon_code, ' + ':input[type=hidden]');

        var wrapper = 'stm_material_form';

        $(inputs).each(function () {

            if ($('body').hasClass('woocommerce-page')) return;

            var label = $(this).attr('placeholder');

            $(this).wrap("<div class='" + wrapper + "'></div>");

            if (typeof label !== 'undefined') {
                $(this).closest('.' + wrapper).prepend("<span>" + label + "</span>");
                $(this).attr('placeholder', '');
            }

            checkValue($(this));
        });

        $(inputs).on('focusout change', function (e) {
            checkValue($(this));
        });

        $(inputs).on('focus', function (e) {
            $(this).closest('.stm_material_form').addClass('stm_has-value');
        });

        changeTextarea();

        $('select').on('change', function () {
            if ($(this).children('option:first-child').is(':selected')) {
                $(this).closest('.stm_select').removeClass('stm_has-value');
            } else {
                $(this).closest('.stm_select').addClass('stm_has-value');
            }
        });
    });

    var timer;

    function checkValue($el) {
        var val = $el.val();

        if (val == '') {
            if ($el.hasClass('hasDatepicker') || $el.hasClass('stm_timepicker')) {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    if (!$el.is(':focus') && val !== '') {
                        $el.closest('.stm_material_form').removeClass('stm_has-value');
                        checkValue($el);
                    }
                }, 300);
            } else {
                $el.closest('.stm_material_form').removeClass('stm_has-value');
            }
        } else {
            $el.closest('.stm_material_form').addClass('stm_has-value');
        }
    }

    function changeTextarea() {
        if ($('textarea').length) {
            $('textarea').each(function () {
                $(this).attr('rows', 1);
            });
            var ta = document.querySelector('textarea');
            ta.addEventListener('focus', function () {
                autosize(ta);
            });
        }
    }
})(jQuery);