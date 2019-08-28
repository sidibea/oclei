export class PreviewGenerator {
    constructor($http) {
        this.$http = $http;
        this.tpl = '';
        this.type = '';
        this.attrs = '';
    }


    parseAttrs() {
        let attrsArray = [];

        angular.forEach(this.attrs, function (v, k) {

            let parsedAtts = '';

            if (typeof v === 'array') {
                parsedAtts = v.join(' ');
            } else {
                parsedAtts = v;
            }

            attrsArray.push(`${k}="${v}"`);
        });

        return attrsArray.join(' ');
    }

    getTemplate() {
        if (angular.isUndefined(this.type)) {
            return;
        }
        return this.$http({
            method: 'GET',
            url: `${ngAppPath}templates/previews/${this.type}.html`
        })
    }

    generatePreview(type = '', attrs = '') {

        if (type.length === 0) {
            return;
        }
        this.type = type;
        this.attrs = attrs;

        this.getTemplate(this.type).then(
            (res) => {
                this.tpl = res;
                this.tpl = this.tpl.replace('{attrs}', this.attrs);
                return this.attrs;
            },
            (error) => {
                throw new Error(error.msg);
            }
        );
    }
}