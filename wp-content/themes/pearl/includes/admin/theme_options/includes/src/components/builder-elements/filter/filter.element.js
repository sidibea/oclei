export class FilterElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;
    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

    addCustomFilters() {
        if(angular.isUndefined(this.element.filter)) {
            this.element.filter = []
        }

        let label = this.label;
        let url = this.url;
        let icon = this.icon;
        let color = this.color;

        if(label != '' && url != '') {
            this.element.filter.push({
                label : label,
                url : url,
                icon : icon,
                color : color,
            });

            this.label = this.url = this.icon = this.color = '';
        }
    }

    removeCustomFilter(key) {
        this.element.filter.splice(key, 1);
    }

}