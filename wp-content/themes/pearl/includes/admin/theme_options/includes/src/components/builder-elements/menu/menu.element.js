export class MenuElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;


        this.menus = stmMenus;
        if(angular.isUndefined(this.element.data)) {
            this.element.data = {}
        }

        if(angular.isUndefined(this.element.data.id)) {
            this.element.data.id = '';
        }

        if(angular.isUndefined(this.element.data.position)) {
            this.element.data.position = 'right';
        }

        if(angular.isUndefined(this.element.data.style)) {
            this.element.data.style = 'default';
        }

        this.icons = [];
        let $_this = this;
        angular.forEach(stm_icons, function(value, key) {
            angular.forEach(value, function(icon){
                $_this.icons.push(icon);
            })
        });

        if (angular.isUndefined(this.element.data.font)) {
            this.element.data.font = 'hf';
        }

        if (angular.isDefined(this.element.data.lh)) {
            this.element.data.lh = parseInt(this.element.data.lh);
        }

        if (angular.isDefined(this.element.data.fsz)) {
            this.element.data.fsz = parseInt(this.element.data.fsz);
        }


    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

}