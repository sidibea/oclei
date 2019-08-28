'use strict';

jQuery(document).ready(function ($) {

    var counters = [];

    $('.stm-counter__value').each(function () {
        var stmId = $(this).attr('id');
        var counterValue = $(this).data('value');
        var duration = $(this).data('duration');
        var separator = $(this).data('separator');
        var decimals = $(this).data('decimals');

        counters[stmId] = new CountUp(stmId, 0, counterValue, decimals, duration, {
            useEasing: true,
            useGrouping: true,
            separator: separator
        });
    });

    $(window).load(function () {
        $('.stm-counter__value').each(function () {
            var loadId = $(this).attr('id');
            if ($("#" + loadId).is_on_screen()) {
                counters[loadId].start();
            }
        });
    });

    $(window).scroll(function () {
        $('.stm-counter__value').each(function () {
            var loadId = $(this).attr('id');
            if ($("#" + loadId).is_on_screen()) {
                counters[loadId].start();
            }
        });
    });
});