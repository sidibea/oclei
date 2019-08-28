class PosttypeControlController{
    constructor(){

    };

    $onInit() {
        console.log(this.data);
        if (angular.isUndefined(this.data.value) || this.data.value === '') {
            this.data.value = {};
        }
        this.data.value.enabled = this.stringToBool(this.data.value.enabled);
        this.data.value.has_archive = this.stringToBool(this.data.value.has_archive);
        this.data.value.public = this.stringToBool(this.data.value.public);
    }

    stringToBool(val) {
        if (angular.isString(val)) {
            return val === 'true' || val == 1;
        }
        return val;
    }



}

export const PosttypeControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/posttype/posttype.control.html',
    controller:   PosttypeControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};