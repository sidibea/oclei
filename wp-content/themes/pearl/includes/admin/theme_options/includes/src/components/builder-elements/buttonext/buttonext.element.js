export class ButtonextElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;

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