class SocialsControlController{
    constructor(){

    };

    $onInit() {
        if(this.data.value === '') {
            this.data.value = []
        }
        this.social = '';
        this.url = '';
    }

    addSocial() {
        if(this.data.value === '') {
            this.data.value = []
        }
        if(this.url !== '' && this.social !== '') {
            this.data.value.push({
                'social': 'fa fa-' + this.social,
                'url': this.url
            });
            this.social = '';
            this.url = '';
        }
    }

    removeSocial(key) {
        this.data.value.splice(key, 1);
    }
}

export const SocialsControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/socials/socials.control.html',
    controller:   SocialsControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};