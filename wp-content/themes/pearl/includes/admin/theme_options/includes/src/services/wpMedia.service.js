export class WpMediaService {
    constructor($window, $q) {
        this.$window = $window;
        this.frame = {};
        this.$q = $q;
    }

    openModal() {
        this.frame = this.$window.wp.media({
            title   : "Select image",
            library: {type: ""},
            button  : {
                text: "Select"
            },
            multiple: false
        }).open()
    }

    getSelectedImageLink(size = 'full') {
        let vm = this;
        let deffered = this.$q.defer();

        this.frame.on('select', function(){
            let frameObj = vm.frame.state().get("selection").first().toJSON();

            let url = frameObj.url;
            if(!angular.isUndefined(frameObj.sizes) && !angular.isUndefined(frameObj.sizes[size])) {
                url = frameObj.sizes[size].url;
            }
            let res = {
                'id' : frameObj.id,
                'url' : url
            };
            deffered.resolve(res);
        });

        return deffered.promise;
    }

    getImageById(id) {
        return this.$window.wp.media.attachment(id).fetch();
    }
}