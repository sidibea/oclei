export class FontResizerElementController {
    constructor($http,$mdDialog) {
        this.$mdDialog = $mdDialog;
    }




    saveElement(element) {
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }
}