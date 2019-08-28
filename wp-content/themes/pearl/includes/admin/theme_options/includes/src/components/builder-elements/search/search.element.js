export class SearchElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;

        this.styles = {
            'style_1' : 'Style 1', //hc
            'style_2' : 'Style 2', //medic
            'style_3' : 'Style 3', //beauty
            'style_4' : 'Style 4', //travel
            'style_5' : 'Style 5', //Magazine
            'style_6' : 'Style 6' //Advisory
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