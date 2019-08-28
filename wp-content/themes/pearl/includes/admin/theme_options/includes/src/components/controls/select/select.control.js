class SelectControlController {
    constructor() {

    };

    $onInit() {
    }

    checkValue() {
        this.data.value = this.data.value === '' ? false : this.data.value;
    }

    getValue(k, v) {
        if (typeof k === 'number') {
            return v;
        }
        return k;
    }



}

export const SelectControlComponent = {
    templateUrl: ngAppPath + 'components/controls/select/select.control.html',
    controller: SelectControlController,
    controllerAs: 'vm',
    bindings: {
        'data': "<",
    }
};