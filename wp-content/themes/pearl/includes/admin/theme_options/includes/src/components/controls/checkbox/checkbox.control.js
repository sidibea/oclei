class CheckboxControlController{
    constructor(){

    };

    $onInit() {
        this.data.value = (this.data.value === 'true');
    }
}

export const CheckboxControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/checkbox/checkbox.control.html',
    controller:   CheckboxControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};