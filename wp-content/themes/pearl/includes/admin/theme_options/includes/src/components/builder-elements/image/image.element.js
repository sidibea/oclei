export class ImageElementController{
    constructor($mdDialog, wpMedia, $scope, $http, $window){
        this.$mdDialog = $mdDialog;
        this.wpMedia = wpMedia;
        this.$scope = $scope;
        this.$http = $http;
        this.ajaxurl = $window.ajaxurl;

        if(this.element.value) {
            this.getSelectedImage(this.element.value);
        }

        this.$scope.$watch('vm.data.value', function(newId, oldId) {
            if(newId != oldId) {
                $_this.getSelectedImage(newId);
            }
        });

        if(angular.isUndefined(this.element.data)) {
            this.element.data = {}
        }

        if(angular.isUndefined(this.element.data.uselogo)) {
            this.element.data.uselogo = false;
        }

        this.element.data.uselogo = (this.element.data.uselogo === 'true');
    };

    saveElement(element){
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }

    selectImage() {
        this.wpMedia.openModal();
        this.wpMedia.getSelectedImageLink('thumbnail').then((res) => {
            this.image_url = res.url;
            this.element.value = res.id;
        });
    }

    removeImage() {
        this.image_url = this.element.value = '';
    }

    getSelectedImage(id) {
        this.$http({
            url : this.ajaxurl,
            method: 'GET',
            params: {
                image_id: this.element.value,
                action: 'pearl_get_thumbnail'
            },
        }).then((res) => {
            this.image_url = res.data;
        });
    }

}