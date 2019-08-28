class TextControlController{
    constructor(){

    };

    $onInit() {

    }
}

export const TextControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/default/text.control.html',
    controller:   TextControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};