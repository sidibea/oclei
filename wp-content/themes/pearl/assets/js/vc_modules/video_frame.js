'use strict';

(function ($) {
    $(document).ready(function () {
        $('.stm_embed_iframe').on('click', function (e) {
            e.preventDefault();
            var iframesrc = $(this).attr('href');
            $(this).append('<iframe src="' + iframesrc + '"></iframe>');
        });
    });
})(jQuery);