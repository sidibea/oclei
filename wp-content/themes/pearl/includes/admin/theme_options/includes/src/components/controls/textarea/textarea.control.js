class TextareaControlController{
    constructor(){

    };

    $onInit() {

    }
}

export const TextareaControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/textarea/textarea.control.html',
    controller:   TextareaControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};