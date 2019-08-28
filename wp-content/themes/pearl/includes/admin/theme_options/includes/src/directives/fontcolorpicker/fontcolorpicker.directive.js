export const fontcolorpicker = () => {
    "use strict";

    const link = (scope,elem,attrs) => {
        var $ = jQuery;
        var $elem = $(elem);
        var $wrapper = $elem.closest('.stm_to-controls-wrapper');
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
