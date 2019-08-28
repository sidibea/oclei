export class OfficesElementController{
    constructor($mdDialog){
        this.$mdDialog = $mdDialog;
        this.icons = [];

        let $_this = this;
        angular.forEach(stm_icons, function(value, key) {
            angular.forEach(value, function(icon){
                $_this.icons.push(icon);
            })
        });

        if (angular.isUndefined(this.element.margins)) {
            this.element.margins = {};
        }


        this.colors = [
            {
                name: 'Main color',
                value: 'mtc'
            },
            {
                name: 'Secondary color',
                value: 'stc'
            },
            {
                name: 'Third color',
                value: 'ttc'
            },
            {
                name: 'Custom',
                value: ''
            }
        ];
        this.sortableOptions = {
            items : '.stm_to-builder__office'
        }

    };

    $onInit() {
        if (angular.isUndefined(this.element.data)) {
            this.element.data = {};
            if(angular.isUndefined(this.element.data.offices)) {
                this.element.data.offices = [];
            }
        }
    }

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

    /*New office*/
    addNewOffice() {
        if(angular.isUndefined(this.element.data)) {
            this.element.data = {}
        }



        let offices = this.element.data.offices;
        let officeName = this.office;

        if(officeName != '' && !angular.isUndefined(officeName)) {
            offices.push({
                name : officeName
            });
            this.office = '';
        }
    }

    /*Add office info*/
    addOfficeItem(key) {
        let itemLabel = this.officeLabel[key];
        let itemUrl = this.officeUrl[key];
        let itemIcon = this.officeIcon[key];

        if(itemLabel != '' && !angular.isUndefined(itemLabel)) {
            let info = {
                label : itemLabel,
                icon : itemIcon,
                url : itemUrl,
            };

            let currentOffice = this.element.data.offices[key];

            if(angular.isUndefined(currentOffice.info)) {
                currentOffice.info = [];
            }

            currentOffice.info.push(info);

            this.officeLabel[key] = this.officeUrl[key] = this.officeIcon[key] = '';
        }
    }

    /*Delete Office item*/
    deleteOfficeItem(key, infokey) {
        this.element.data.offices[key].info.splice(infokey, 1);
    }

    changeOfficeOrder(index, array) {



    }
}