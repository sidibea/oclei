class DividerControlController{
    constructor(){

    };

    $onInit() {

    }
}

export const DividerControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/divider/divider.control.html',
    controller:   DividerControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};