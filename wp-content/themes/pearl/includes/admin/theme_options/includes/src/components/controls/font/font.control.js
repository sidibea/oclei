class FontControlController {
    constructor() {

    };

    $onInit() {

        this.options = {
            label: '',
            default: this.data.value,
            genericPalette: false,
            history: true,
            openOnInput: true
        };

        this.fonts = ngGoogleFonts;
        this.choices = [];

        angular.forEach(this.fonts, (v, k) => {
            this.choices.push({
                'label': v.label,
                'value': k,
            });
        });

        if (this.data.value == '') {
            this.data.value = {};
        }

        // if(angular.isDefined(this.data.value.name)) {
        //     this.data.value.name = {
        //         label: this.data.value.name,
        //         value: this.data.value.name,
        //     };
        // } else {
        //     this.data.value.name = {
        //         label: this.fonts[''].label,
        //         value: '',
        //     };
        // }

        this.fontStyles = ['name', 'size', 'ln', 'ls', 'mgb', 'color', 'fw'];

        /*Font family set empty strings if empty*/
        let $_this = this;
        angular.forEach($_this.fontStyles, function (name, key) {
            if (angular.isUndefined($_this.data.value[name])) {
                $_this.data.value[name] = '';
            }
        });
    }

    loadGfonts(name) {
        if(name) {
            var $ = jQuery;
            var name = name.replace(" ", "+");
            var link = '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + name + ':300,300i,400,400i,600,600i,700,700i,800,800i" />';
            $('head').append(link);
        }
    }

    preventLineHeight(fs, ln) {
        if(fs > ln) this.data.value.ln = parseFloat(fs);
    }
}

export const FontControlComponent = {
    templateUrl: ngAppPath + 'components/controls/font/font.control.html',
    controller: FontControlController,
    controllerAs: 'vm',
    bindings: {
        'data': "<",
    }
};