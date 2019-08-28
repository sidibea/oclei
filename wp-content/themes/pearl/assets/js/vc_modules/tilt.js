'use strict';

(function ($) {
    var tiltSettings = {
        movement: {
            lines: {
                translation: { x: 40, y: 40, z: 0 },
                reverseAnimation: { duration: 1500, easing: 'easeOutElastic' }
            },
            caption: {
                translation: { x: 20, y: 20, z: 0 },
                rotation: { x: 0, y: 0, z: -5 },
                reverseAnimation: { duration: 1000, easing: 'easeOutExpo' }
            },
            overlay: {
                translation: { x: -30, y: -30, z: 0 },
                rotation: { x: 0, y: 0, z: 3 },
                reverseAnimation: { duration: 750, easing: 'easeOutExpo' }
            },
            shine: {
                translation: { x: 100, y: 100, z: 0 },
                reverseAnimation: { duration: 750, easing: 'easeOutExpo' }
            }
        }
    };

    function init() {
        [].slice.call(document.querySelectorAll('.tilter')).forEach(function (el, pos) {
            new TiltFx(el, tiltSettings);
        });
    }

    $(document).ready(function () {
        init();
    });
})(jQuery);