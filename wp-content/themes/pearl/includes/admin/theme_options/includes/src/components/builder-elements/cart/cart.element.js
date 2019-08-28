export class CartElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;

        this.styles = {
            'style_1' : 'Style 1', //hc
            'style_2' : 'Style 2', //rental
        };

        if(angular.isUndefined(this.element.value)) {
            this.element.value = 'style_1';
        }
    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

}