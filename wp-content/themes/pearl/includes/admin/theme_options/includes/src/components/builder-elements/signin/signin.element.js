export class SigninElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;
    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

}