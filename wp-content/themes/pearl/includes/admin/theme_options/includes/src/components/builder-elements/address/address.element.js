export class AddressElementController {
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