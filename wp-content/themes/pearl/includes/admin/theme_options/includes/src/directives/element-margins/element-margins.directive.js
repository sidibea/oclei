export const elementMargins = (siteBreakpoints) => {
    "use strict";


    const link = (scope, element, attrs) => {
        scope.sides = ['top', 'right', 'bottom', 'left'];
        scope.breakpoints = siteBreakpoints;
    };

    return {
        link: link,
        restrict: 'E',
        scope: {
            model: '='
        },
        templateUrl: ngAppPath + 'directives/element-margins/element-margins.directive.html'
    }
};