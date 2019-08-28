
class IconpickerControlController{
    constructor(){
    };


    $onInit() {
    }
}

export const IconpickerControlComponent = {
    templateUrl:  ngAppPath + 'components/controls/iconpicker/iconpicker.control.html',
    controller:   IconpickerControlController,
    controllerAs: 'vm',
    bindings:     {
        'data' : "<",
    }
};