
"use strict";

(function ($) {
    $.fn.owlRemoveItem = function (num) {
        var owl_data = $(this).data('owlCarousel');

        owl_data._items = $.map(owl_data._items, function (data, index) {
            if (index != num) return data;
        });

        $(this).find('.owl-item').eq(num).remove();
    };

    $.fn.owlFilter = function (data, callback) {
        var owl = this,
            owl_data = $(owl).data('owlCarousel'),
            $elemCopy = $('<div>').css('display', 'none');

        if (typeof $(owl).data('owl-clone') == 'undefined') {
            $(owl).find('.owl-item:not(.cloned)').clone().appendTo($elemCopy);
            $(owl).data('owl-clone', $elemCopy);
        } else {
            $elemCopy = $(owl).data('owl-clone');
        }

        owl.trigger('replace.owl.carousel', ['<div/>']);

        switch (data) {
            case '*':
                $elemCopy.children().each(function () {
                    owl.trigger('add.owl.carousel', [$(this).clone()]);
                });
                break;
            default:
                $elemCopy.find(data).each(function () {
                    owl.trigger('add.owl.carousel', [$(this).parent().clone()]);
                });
                break;
        }

        owl.owlRemoveItem(0);
        owl.trigger('refresh.owl.carousel').trigger('to.owl.carousel', [0]);

        if (callback) callback.call(this, owl);
    };
})(jQuery);