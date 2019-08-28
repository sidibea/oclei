class SwitchControlController{
    constructor(){

    };

    $onInit() {
        this.data.value = (this.data.value === 'true' || this.data.value === true);
    }
}

export const SwitchControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/switch/switch.control.html',
    controller:   SwitchControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};