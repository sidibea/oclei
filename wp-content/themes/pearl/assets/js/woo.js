'use strict';

(function ($) {
    "use strict";

    $(document).ready(function () {
        $('body').on('click', '.quantity span', function () {
            var input = $(this).closest('.quantity').find('input');
            var value = parseInt(input.val());
            if ($(this).hasClass('increase')) {
                input.val(value + 1);
            } else {
                if (value !== 1) input.val(parseInt(value) - 1);
            }
            input.trigger('change');
        });

        if ($('body').hasClass('single-product')) {
            var selector = '.woocommerce-product-gallery__image';
            var original_place = $(selector + ':first-child').find('.attachment-shop_single');
            var original_image = original_place.attr('src');
            var original_srcset = original_place.attr('srcset');
            $(selector).mouseenter(function () {
                original_place.attr('src', $(this).find('img').attr('src'));
                original_place.attr('srcset', $(this).find('img').attr('srcset'));
            });
            $(selector).mouseleave(function () {
                original_place.attr('src', original_image);
                original_place.attr('srcset', original_srcset);
            });
        }

        $('.woo_filter_title').click(function () {
            $(this).toggleClass('current');
            $(this).parents().find('.woo_filter_dropdown').slideToggle();
        });

        $('.shop_grid_button.view_3').click(function () {
            $(this).parents().find('.products').removeClass().addClass('products stm_products stm_products_3');
            createCookie('stm_filter_column_viewed', "stm_products_3", 7);
        });
        $('.shop_grid_button.view_4').click(function () {
            $(this).parents().find('.products').removeClass().addClass('products stm_products stm_products_4');
            createCookie('stm_filter_column_viewed', "stm_products_4", 7);
        });

        $('.woo_quick_view').on('click', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url: stm_ajaxurl,
                dataType: 'json',
                context: this,
                data: {
                    'id': id,
                    'action': 'pearl_woo_quick_view'
                },
                beforeSend: function beforeSend() {
                    $('.quick-view-preloader').show();
                },
                complete: function complete(data) {
                    var dt = data.responseJSON;
                    var $items = $(dt.content);
                    $("#quick_view_box").html($items);
                    $('.quick-view-preloader').hide();
                }
            });
        });
    });
})(jQuery);