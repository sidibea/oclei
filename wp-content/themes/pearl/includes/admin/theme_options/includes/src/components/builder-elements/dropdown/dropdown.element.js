export class DropdownElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;

        this.styles = {
            'style_1' : 'Style 1', //hc
            'style_2' : 'Style 2' //travel
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

    addCustomDropdowns() {
        if(angular.isUndefined(this.element.dropdown)) {
            this.element.dropdown = []
        }

        let label = this.label;
        let url = this.url;

        if(label != '' && url != '') {
            this.element.dropdown.push({
                label : label,
                url : url,
            });

            this.label = this.url = '';
        }
    }

    removeCustomDropdown(key) {
        this.element.dropdown.splice(key, 1);
    }

}