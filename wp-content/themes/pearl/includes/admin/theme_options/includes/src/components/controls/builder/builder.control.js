import {BuilderElementsController} from './../../../modals/builder/builder.modal';

import {DropdownElementController} from './../../builder-elements/dropdown/dropdown.element';
import {TextElementController} from './../../builder-elements/text/text.element';
import {OfficesElementController} from './../../builder-elements/offices/offices.element';
import {ImageElementController} from './../../builder-elements/image/image.element';
import {IconboxElementController} from './../../builder-elements/iconbox/iconbox.element';
import {IcontextElementController} from './../../builder-elements/icontext/icontext.element';
import {SocialsElementController} from './../../builder-elements/socials/socials.element';
import {MenuElementController} from './../../builder-elements/menu/menu.element';
import {ButtonElementController} from './../../builder-elements/button/button.element';
import {ButtonextElementController} from './../../builder-elements/buttonext/buttonext.element';
import {CartElementController} from './../../builder-elements/cart/cart.element';
import {SigninElementController} from './../../builder-elements/signin/signin.element';
import {SearchElementController} from './../../builder-elements/search/search.element';
import {PopupElementController} from './../../builder-elements/popup/popup.element';
import {FilterElementController} from './../../builder-elements/filter/filter.element';
import {WeatherElementController} from './../../builder-elements/weather/weather.element';
import {FontResizerElementController} from './../../builder-elements/font-resizer/font-resizer.element';
import {AddressElementController} from './../../builder-elements/address/address.element';


let BuilderElements = {
    'dropdown': DropdownElementController,
    'text': TextElementController,
    'offices': OfficesElementController,
    'image': ImageElementController,
    'iconbox': IconboxElementController,
    'icontext': IcontextElementController,
    'socials': SocialsElementController,
    'menu': MenuElementController,
    'button': ButtonElementController,
    'buttonext': ButtonextElementController,
    'cart': CartElementController,
    'signin': SigninElementController,
    'search': SearchElementController,
    'popup': PopupElementController,
    'filter': FilterElementController,
    'weather' : WeatherElementController,
    'font-resizer' : FontResizerElementController,
    'address': AddressElementController,
};


class BuilderControlController {
    constructor($mdDialog, $window) {
        this.$mdDialog = $mdDialog;
        this.$window = $window;
    };

    $onInit() {
        /*Sort elements for tablet/mobile*/

        this.elementsList = {};
        // this.getElementsList();

        let rowsSort = this.rowsSort = {
            'top': 1,
            'center': 2,
            'bottom': 3
        };
        let columnsSort = this.columnsSort = {
            'left': 1,
            'center': 2,
            'right' : 3
        };

        let builder_skeleton = this.data.value;
        if(builder_skeleton == '' || builder_skeleton == ' ') {
            builder_skeleton = {}
        }

        angular.forEach(rowsSort, function(name, row){
            if(angular.isUndefined(builder_skeleton[row])) {
                builder_skeleton[row] = {};
            }

            angular.forEach(columnsSort, function(name, column){
                if(angular.isUndefined(builder_skeleton[row][column])) {
                    builder_skeleton[row][column] = [];
                }
            })
        });

        this.data.value = builder_skeleton;
    }

    openBuilderElements($h, $v) {
        let $_this = this;
        var options = {
            templateUrl: ngAppPath + 'modals/builder/builder.modal.html',
            parent: angular.element(document.body),
            controller: BuilderElementsController,
            controllerAs: 'vm',
            clickOutsideToClose: true
        };
        this.$mdDialog.show(options)
            .then(function (element) {
                /*Save element in model*/
                let $value = $_this.data.value;

                /*if value empty, create Obj*/
                if ($value == '') {
                    $value = {};
                }

                /*If horizontal line is not created yet, create object (Top, Center, Bottom)*/
                if (angular.isUndefined($value[$h])) {
                    $value[$h] = {}
                }

                /*If vertical line is not created yet, create object (Left, Center, Right)*/
                if (angular.isUndefined($value[$h][$v])) {
                    $value[$h][$v] = [];
                }

                /*Add order and disabled meta in element*/
                element.order = {};
                let k = $value[$h][$v].length;
                let order = parseInt(`${$_this.rowsSort[$h]}${$_this.columnsSort[$v]}${k}`) * 10;
                element.order.tablet = element.order.mobile = order;

                let states = {
                    'default' : '',
                    'tablet' : '',
                    'mobile' : '',
                };
                element.disabled = states;

                /*Push element in Value (ex: Top Left Element or Bottom Center Element)*/
                $value[$h][$v].push(element);

                $_this.data.value = $value;

                $_this.openElement($h, $v, ($value[$h][$v].length) - 1, angular.copy(element));
                $_this.getElementsList();
            }, function () {
            });
    }

    /**
     *
     * @param $h Top Center Bottom
     * @param $v Left Center Right
     * @param k Key of element
     * @param element
     */
    openElement($h, $v, k, element) {
        let $_this = this;
        if (element) {
            let type = element.type;
            var options = {
                templateUrl: ngAppPath + `components/builder-elements/${type}/${type}.element.html`,
                parent: angular.element('body'),
                controller: BuilderElements[type],
                controllerAs: 'vm',
                locals: {
                    element: angular.copy(element)
                },
                fullscreen: true,
                bindToController: true,
                clickOutsideToClose: true,
                multiply: true
            };

            $_this.$mdDialog.show(options)
                .then(function (element_data) {
                    /*Save element data*/
                    $_this.data.value[$h][$v][k] = element_data;
                    $_this.getElementsList('tablet');
                    $_this.getElementsList('mobile');
                }, function () {})
        }
    }

    deleteElement($h, $v, $k) {
        let deleteEl = this.$window.confirm('Are you sure want to delete the element?');
        if (deleteEl) {
            this.data.value[$h][$v].splice($k, 1);
        }
    }

    duplicateElement($h, $v, k) {
        this.data.value[$h][$v].splice(k, 0, angular.copy(this.data.value[$h][$v][k]));
    }

    toggleElementState($h, $v, k, type, disabled) {
        disabled = (disabled == '' ? 'disabled' : '');
        this.data.value[$h][$v][k].disabled[type] = disabled;
    }

    getElementsList(type) {



        let elementsObj = this.data.value;
        let elementsList = [];

        angular.forEach(elementsObj, function(columns, $h){
            angular.forEach(columns, function(elements, $v){
                angular.forEach(elements, function(element, k){
                    element.position = [$h, $v, k];
                    elementsList.push(element);
                })
            })
        });

        elementsList.sort(function(a, b) {
            return a.order[type] - b.order[type];
        });

        if (angular.isDefined(this.elementsList[type]) && this.elementsList[type] === elementsList) {
            return;
        } else {
            this.elementsList[type] = [];
        }

        angular.forEach(elementsList, (v, k) => {
            this.elementsList[type].push(v);
        });

    }


    elementMoved($i, array) {
        array.splice($i, 1);
    }

    rowClass(row) {

        var classes = 'stm_to-builder__' + row;
        var elements = this.data.value[row];
        var length = 0;

        angular.forEach(elements, function(v, k){
            length += v.length;
        });

        if(length > 4) {
            classes += ' rowBig';
        }

        return classes;
    }

    setCurrentBreakpoint(name) {
        this.currentBreakpoint = name;
        this.getElementsList(name);
    }

    elementInserted(i) {

        let type = this.currentBreakpoint;
        let array = this.elementsList[type];

        let currentItem = array[this.draggingItem];
        let lastIndex = array.length - 1;
        let order = parseInt(array[lastIndex].order.tablet) + 1;
        if(!angular.isUndefined(array[i])) {
            order = parseInt(array[i].order.tablet) - 1;
        }

        let $h = currentItem.position[0];
        let $v = currentItem.position[1];
        let k = currentItem.position[2];

        currentItem.order[type]
            = this.data.value[$h][$v][k].order[type]
            = order;

        this.getElementsList(type);
    }

}

export const BuilderControlComponent = {
    templateUrl: ngAppPath + 'components/controls/builder/builder.control.html',
    controller: BuilderControlController,
    controllerAs: 'vm',
    bindings: {
        'data': "<",
    }
};