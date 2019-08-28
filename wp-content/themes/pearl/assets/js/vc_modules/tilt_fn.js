'use strict';

(function ($) {

    var options = {
        movement: {
            imgWrapper: {
                translation: { x: -10, y: -10, z: 15 },
                rotation: { x: -10, y: 20, z: 10 },
                reverseAnimation: {
                    duration: 1200,
                    easing: 'easeOutElastic',
                    elasticity: 600
                }
            },
            caption: {
                translation: { x: 20, y: 20, z: 0 },
                rotation: { x: 0, y: 0, z: 0 },
                reverseAnimation: {
                    duration: 1500,
                    easing: 'easeOutElastic',
                    elasticity: 600
                }
            }

        }
    };

    function init() {
        [].slice.call(document.querySelectorAll('.tilter')).forEach(function (el, pos) {
            new TiltFx(el, [options]);
        });
    }

    $(window).load(function () {
        init();
    });
})(jQuery);