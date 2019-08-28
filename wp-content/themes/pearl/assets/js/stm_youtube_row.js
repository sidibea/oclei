'use strict';

(function ($) {
    "use strict";

    $(window).load(function () {
        stm_init_video();
    });

    $(window).scroll(function () {
        stm_init_video();
    });

    function stm_init_video() {
        $('[data-vc-video-bg]').each(function () {
            if (!$(this).hasClass('stm-video-added')) {
                var currentScrollPos = $(document).scrollTop();
                var elementHeight = $(this).outerHeight();
                var elementPos = $(this).offset().top - elementHeight - 700;
                if (currentScrollPos > elementPos) {
                    var src = $(this).attr('data-vc-video-bg');
                    var youtube_id = $(this).attr('data-youtube-id');

                    if (typeof youtube_id !== 'undefined' && youtube_id !== '') {
                        src = 'https://www.youtube.com/embed/' + youtube_id + '?playlist=' + youtube_id + '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&mute=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&origin=';
                    }

                    if (typeof src !== 'undefined' && src !== '') {
                        var iframe = '<div class="stm_video_iframe">' + '<iframe src="' + src + '" ' + 'class="inner" ' + 'frameborder="0" ' + 'allowfullscreen="1" ' + 'width="100%" ' + 'height="100%">' + '</iframe>' + '</div>';
                        $(this).before(iframe);
                    }

                    $(this).addClass('stm-video-added');
                }
            }
        });
    }
})(jQuery);