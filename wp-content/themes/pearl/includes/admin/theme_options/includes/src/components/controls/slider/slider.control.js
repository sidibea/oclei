class SliderControlController{
    constructor(){

    };

    $onInit() {
        this.data.value = parseFloat(this.data.value);
    }
}

export const SliderControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/slider/slider.control.html',
    controller:   SliderControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};