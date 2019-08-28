class FontcommonControlController{
    constructor(){

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
            this.choices.push(k);
        });

        if(this.data.value == '') {
            this.data.value = {};
        }

        this.fontStyles = ['name', 'color', 'subset'];

        /*Font family set empty strings if empty*/
        let $_this = this;
        angular.forEach($_this.fontStyles, function(name, key){
            if(angular.isUndefined($_this.data.value[name]) ) {
                $_this.data.value[name] = '';
            }
        });

    }

    colorChange(color) {
        var $ = jQuery;
        $('.stm_to-single_control-fontcommon').closest('.stm_to-controls-wrapper').find('.stm-font-preview.no-color').each(function(){
            $(this).css('color', color);
        })
    }

    fontChanged(font) {
        var $ = jQuery;
        $('.stm_to-single_control-fontcommon').closest('.stm_to-controls-wrapper').find('.stm-font-preview.no-font').each(function(){
            $(this).css('font-family', font);
        });
        var name = font.replace(" ", "+");
        var link = '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + name + ':300,300i,400,400i,600,600i,700,700i,800,800i" />';
        $('head').append(link);
    }
}

export const FontCommonControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/fontcommon/fontcommon.control.html',
    controller:   FontcommonControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};