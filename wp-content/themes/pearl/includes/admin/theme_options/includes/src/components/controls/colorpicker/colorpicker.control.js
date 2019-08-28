class ColorpickerControlController{
    constructor($scope){
        this.$scope = $scope;
    };

    $onInit() {
        this.options = {
            label: '',
            default: this.data.value,
            genericPalette: false,
            history: true,
            openOnInput: true,
            clearButton: false
        }
    }
}

export const ColorpickerControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/colorpicker/colorpicker.control.html',
    controller:   ColorpickerControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};