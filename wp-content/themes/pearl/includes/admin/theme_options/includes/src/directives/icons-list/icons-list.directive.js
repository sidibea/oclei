export const iconsList = (DialogService, $filter, $document) => {
    "use strict";

    const link = (scope, elem, attrs) => {

        elem.bind('click', () => {
            scope.openList();
        });

        scope.iconName = '';
        scope.iconSearch = '';
        scope.setName = 'FontAwesome';
        scope.icons = [];
        scope.iconSets = stm_icons;
        scope.currentSet = scope.iconSets[ scope.setName ];
        scope.iconsSetsNames = [];

        scope.filteredIcons = scope.currentSet;
        scope.limit = 150;

        angular.forEach(stm_icons, function (value, key) {
            scope.iconsSetsNames.push(key);

            angular.forEach(value, function (icon) {
                scope.icons.push(icon);
            })
        });


        scope.openList = () => {
            let html = angular.element('body');

            let options = {
                parent: html,
                scope:    scope
            };

            scope.list = DialogService.fromTemplate('iconpicker', options);

            setTimeout(() => {
                scope.$emit('iconsList:opened');
            }, 500);

            scope.list.result.then(
                (selectedIcon) => {
                    scope.icon = selectedIcon;
                }
            )
        }


        scope.getFilteredIcons = (iconName) => {

            if ( iconName === 0 ) {
                scope.limit = 150;
                scope.filteredIcons = scope.currentSet;
            }
            scope.filteredIcons = $filter('filter')(scope.currentSet, iconName);
        }

        scope.updateLimit = () => {
            scope.limit += 50;
        }

        scope.selectIcon = (icon) => {
            scope.list.close(icon);
            scope.isOpen = false;
        }

        scope.setCurrentIconSet = (set_name, iconSearch) => {
            scope.limit = 150;
            scope.currentSet = scope.iconSets[ set_name ];
            scope.setName = set_name;

            scope.getFilteredIcons(iconSearch);
        }


    }


    return {
        link:     link,
        scope:    {
            icon: '=',
        },
        restrict: 'A'
    }

}