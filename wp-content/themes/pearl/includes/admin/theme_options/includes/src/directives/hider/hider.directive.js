export const hider = () => {
    "use strict";

    const link = (scope,elem,attrs) => {
        var $ = jQuery;
        var $elem = $(elem);
        var $wrapper = $elem.closest('.stm_to-controls-wrapper');
        var hide_elements = '.stm_to-single_control-posttype__inner, .stm_to-single_control:not(.stm_to-single_control-posttype)';

        scope.$watch('onChange', function(value) {
            if (angular.isString(value)) {
                value = value === 'true';
            }
            if(value) {
                $wrapper.find(hide_elements).fadeIn(300);
            } else {
                $wrapper.find(hide_elements).fadeOut(300);
            }
        });

    };

    const scope = {
        onChange: '=',
    };

    return {
        restrict: 'A',
        scope : scope,
        link: link,
    };

};
