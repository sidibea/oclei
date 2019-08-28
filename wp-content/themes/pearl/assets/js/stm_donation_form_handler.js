'use strict';

(function ($) {

    $(document).ready(function () {
        "use strict";

        var form = $('.stm_donation_popup__form');
        var amountsWrapper = form.find('.amounts_wrapper');
        var customAmount = form.find('.custom-amount');

        customAmount.keydown(function () {
            var activeAmount = amountsWrapper.find('.stm_input_wrapper_radio.active');
            var amount = amountsWrapper.find('.stm_input_wrapper_radio');

            amount.each(function () {
                if (!$(this).hasClass('disabled')) {
                    $(this).addClass('disabled');
                }
            });

            activeAmount.removeClass('active');
        });

        customAmount.change(function () {
            var disabledAmount = amountsWrapper.find('.stm_input_wrapper_radio.disabled');

            if ($(this).val().length === 0) {
                disabledAmount.each(function () {
                    $(this).removeClass('disabled');

                    if ($(this).find('input').is(':checked')) {
                        $(this).addClass('active');
                    }
                });
            }
        });

        form.submit(function (e) {
            e.preventDefault();
            var form = $(this);

            var donationId = parseInt(form.data('donation-id'));

            var data = form.serialize() + ('&donationId=' + donationId + '&action=pearl_donate');

            $.ajax({
                url: stm_ajaxurl,
                method: 'post',
                data: data,
                beforeSend: function beforeSend() {
                    form.find('[type=submit]').addClass('loading');
                },
                success: function success(data) {
                    var newTab = window.open(data, '_blank');
                    if (newTab) {
                        newTab.focus();
                    } else {
                        form.find('[type=submit]').removeClass('loading');
                        alert('Please allow popups for this website');
                    }
                }
            });
        });
    });
})(jQuery);