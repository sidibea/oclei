export class TextElementController {
    constructor($mdDialog) {
        this.$mdDialog = $mdDialog;
    };

    saveElement(element) {
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

}