export class BuilderElementsController{
    constructor($mdDialog) {
        this.$mdDialog = $mdDialog;
        this.elements = builderElements;
    }

    selectElement(element) {
        this.$mdDialog.hide(element);
    }
}