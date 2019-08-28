export class PopupElementController{
    constructor($mdDialog, $window){
        this.$mdDialog = $mdDialog;

        this.pages = $window.stmPages;

        this.icons = [];

        let $_this = this;
        angular.forEach(stm_icons, function(value, key) {
            angular.forEach(value, function(icon){
                $_this.icons.push(icon);
            })
        });
    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

}