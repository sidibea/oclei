

export function elementControl($window, $mdDialog) {
    "use strict";


    return {
        restrict: 'E',
        link:     link,
        templateUrl: ngAppPath + 'directives/element-control/element-control.directive.html'
    }
};