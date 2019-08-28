class RadioControlController{
    constructor(){

    };

    $onInit() {

    }
}

export const RadioControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/radio/radio.control.html',
    controller:   RadioControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};