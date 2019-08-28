export class IconboxElementController{
    constructor($mdDialog, $filter, $scope, $window){
        this.$mdDialog = $mdDialog;
        this.$filter = $filter;
        this.$scope = $scope;
        this.icons = [];
        this.pages = $window.stmPages;
        if (angular.isDefined(this.element.data) && angular.isDefined(this.element.data.description)) {
            if (this.element.data.description !== 'undefined') {
                this.element.data.description = this.element.data.description.replace(/\\/g, '');
            }
        }

        let $_this = this;

        angular.forEach(stm_icons, function(value, key) {
            angular.forEach(value, function(icon){
                $_this.icons.push(icon);
            })
        });
        this.filteredIcons = this.icons;
        this.limit = 40;


        this.styles = {
            'style_1' : 'Style 1',
            'style_2' : 'Style 2',
            // 'style_3' : 'Style 3',
            // 'style_4' : 'Style 4'
        };
    };

    getFilteredIcons(iconName) {
        if (iconName.length === 0) {
            this.limit = 40;
            this.filteredIcons = this.icons;
        }
        this.filteredIcons = this.$filter('filter')(this.icons, iconName);
    }


    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

    updateLimit() {
        this.limit+=40;
    }

    sayToInfinite() {
        this.$scope.$emit('iconsList:opened');
    }

}