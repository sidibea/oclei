'use strict';

(function ($) {
    $(document).ready(function () {
        $('.form_actions input[name="agreement"]').on('change', function () {
            var ischecked = $(this).is(':checked');
            if (ischecked) {
                $(this).closest('.form_actions').find('.btn').removeAttr('disabled');
            } else {
                $(this).closest('.form_actions').find('.btn').attr('disabled', 'disabled');
            }
        });

        var btn = '.' + stm_join_form_vars.btn;
        $(btn).click(function (e) {
            e.preventDefault();

            var eventId = 'stm_event_' + $(this).attr('data-id');
            var $form = $(this).closest('form');
            var formData = $form.serialize();
            var $message = $form.find('.ajax_message');

            if (localStorage.getItem(eventId) === 'joined') {
                var message = stm_join_form_vars.message;
                $message.text(message).slideDown();
                return;
            }

            $.ajax({
                url: stm_ajaxurl,
                dataType: 'json',
                context: this,
                method: 'POST',
                data: formData + '&action=pearl_event_participant',
                beforeSend: function beforeSend() {
                    $form.find('input').removeClass('error');
                    $(this).addClass('loading');
                    $message.slideUp().removeClass('success');
                },
                complete: function complete(data) {
                    $(this).removeClass('loading');
                    var data = data.responseJSON;
                    $.each(data.errors, function (index, value) {
                        var $input = $form.find('input[name="' + index + '"]');
                        $input.addClass('error');
                    });

                    if (data.status == 'success') {
                        localStorage.setItem(eventId, 'joined');
                    }

                    if (data.message) {
                        $message.text(data.message);
                        $message.slideDown();
                    }

                    if (data.status) $message.addClass(data.status);

                    if (data.count) {
                        $('a[href="#stm_event_' + data.id + '"] .stm_single_event_part-label, ' + '.stm_single_event_part-label span').text(data.count);
                    }
                }
            });
        });
    });
})(jQuery);