export const colorSelector = () => {
    "use strict";

    const link = (scope, elem, attrs) => {

        scope.name = attrs.name ? attrs.name : false;
        scope.text = scope.name ? `Select color for ${scope.name}` : 'Select color';

        scope.isCustom = () => {
            return scope.for.name === 'Custom';
        };

        scope.colors = [
            {
                name: 'Main color',
                value: 'mtc'
            },
            {
                name: 'Secondary color',
                value: 'stc'
            },
            {
                name: 'Third color',
                value: 'ttc'
            },
            {
                name: 'Custom',
                value: ''
            }
        ];


        if (angular.isUndefined(scope.for)) {
            scope.for = scope.colors[0];
        }

        scope.selectCallback = () => {
        }

    };

    const scope = {
        for: '=',
    };


    return {
        restrict: 'E',
        scope: scope,
        link: link,
        templateUrl: ngAppPath + 'directives/color-selector/color-selector.directive.html'
    };

};