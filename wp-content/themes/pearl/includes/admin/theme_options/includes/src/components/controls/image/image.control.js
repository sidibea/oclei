class ImageControlController{
    constructor($http, $window, wpMedia, $scope){
        this.$http = $http;
        this.$window = $window;
        this.wpMedia = wpMedia;
        this.ajaxurl = $window.ajaxurl;
        this.$scope = $scope;
    };

    $onInit() {
        this.image = '';
        if(this.data.value) {
            this.getSelectedImage(this.data.value);
        }

        let $_this = this;
        this.$scope.$watch('vm.data.value', function(newId, oldId) {
            if(newId != oldId) {
                $_this.getSelectedImage(newId);
            }
        })
    }

    getSelectedImage(id) {
        this.$http({
            url : this.ajaxurl,
            method: 'GET',
            params: {
                image_id: this.data.value,
                action: 'pearl_get_thumbnail'
            },
        }).then((res) => {
            this.image = res.data;
        });
    }

    selectImage() {
        this.wpMedia.openModal();
        this.wpMedia.getSelectedImageLink('thumbnail').then((res) => {
            this.image = res.url;
            this.data.value = res.id;
        });
    }

    removeImage() {
        this.image = '';
        this.data.value = '';
    }
}

export const ImageControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/image/image.control.html',
    controller:   ImageControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};