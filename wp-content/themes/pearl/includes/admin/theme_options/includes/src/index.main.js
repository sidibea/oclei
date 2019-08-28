function checkNested(obj /*, level1, level2, ... levelN*/) {
    var args = Array.prototype.slice.call(arguments, 1);

    for (var i = 0; i < args.length; i++) {
        if (!obj || !obj.hasOwnProperty(args[i])) {
            return false;
        }
        obj = obj[args[i]];
    }
    return true;
}


var toApp = angular.module('theme_options', [
    'app.components',
    'app.directives',
    'app.services',
    'app.config',
    'app.filters',
])
    .run(function ($rootScope) {
        $rootScope.getOption = function (option) {
            let res = '';

            if (angular.isDefined($rootScope.theme_options)) {


                angular.forEach($rootScope.theme_options, function (h_tab, h_tab_key) {
                    angular.forEach(h_tab.options, function (v_tab, v_tab_key) {
                        angular.forEach(v_tab.options, function (v, k) {
                            if (option === k) {
                                res = v.data.value;
                            }
                        })
                    })
                });
            }

            return res;
        }
    });

import {appRun} from './run/run';

import {siteBreakpoints} from './constants';

toApp.run(appRun)
    .constant('siteBreakpoints', siteBreakpoints);

angular.module('app.components', [
    'ngMaterial',
    'ui.bootstrap',
    'mdColorPicker',
    'dndLists',
    'infinite-scroll',
    'colorpicker.module',
    'ui.sortable'
]);


angular.module('app.filters', []);

angular.module('app.directives', []);

angular.module('app.services', []);

import {AppRootComponent} from './components/app-root/app-root.component';
import {TextControlComponent} from './components/controls/default/text.control';
import {TextareaControlComponent} from './components/controls/textarea/textarea.control';
import {SliderControlComponent} from './components/controls/slider/slider.control';
import {RadioControlComponent} from './components/controls/radio/radio.control';
import {SelectControlComponent} from './components/controls/select/select.control';
import {CheckboxControlComponent} from './components/controls/checkbox/checkbox.control';
import {SwitchControlComponent} from './components/controls/switch/switch.control';
import {ColorpickerControlComponent} from './components/controls/colorpicker/colorpicker.control';
import {ImageControlComponent} from './components/controls/image/image.control';
import {DividerControlComponent} from './components/controls/divider/divider.control';
import {SocialsControlComponent} from './components/controls/socials/socials.control';
import {IconpickerControlComponent} from './components/controls/iconpicker/iconpicker.control';
import {FontControlComponent} from './components/controls/font/font.control';
import {FontCommonControlComponent} from './components/controls/fontcommon/fontcommon.control';
import {BuilderControlComponent} from './components/controls/builder/builder.control';
import {PosttypeControlComponent} from './components/controls/posttype/posttype.control';

angular.module('app.components')
    .component('appRoot', AppRootComponent)
    .component('textControl', TextControlComponent)
    .component('textareaControl', TextareaControlComponent)
    .component('sliderControl', SliderControlComponent)
    .component('radioControl', RadioControlComponent)
    .component('selectControl', SelectControlComponent)
    .component('checkboxControl', CheckboxControlComponent)
    .component('switchControl', SwitchControlComponent)
    .component('imageControl', ImageControlComponent)
    .component('dividerControl', DividerControlComponent)
    .component('socialsControl', SocialsControlComponent)
    .component('iconpickerControl', IconpickerControlComponent)
    .component('fontControl', FontControlComponent)
    .component('fontcommonControl', FontCommonControlComponent)
    .component('builderControl', BuilderControlComponent)
    .component('colorpickerControl', ColorpickerControlComponent)
    .component('posttypeControl', PosttypeControlComponent);


import {trustHtmlFilter} from './fitlers/trustHtml';

angular.module('app.filters')
    .filter('trustHtml', trustHtmlFilter);


import {WpMediaService} from './services/wpMedia.service';
import {DialogService} from './services/dialog.service';
import {PreviewGenerator} from './services/previewGenerator';
import {HistoryService} from './services/history.service';

angular.module('app.services')
    .service('wpMedia', WpMediaService)
    .service('PreviewGenerator', PreviewGenerator)
    .service('DialogService', DialogService)
    .service('History', HistoryService);

import {controlGenerator} from './directives/control-generator/control-generator';
import {elementControl} from './directives/element-control/element-control.directive';
import {iconsList} from './directives/icons-list/icons-list.directive';
import {elementMargins} from './directives/element-margins/element-margins.directive';
import {colorSelector} from './directives/color-selector/color-selector.directive';
import {hider} from './directives/hider/hider.directive';
import {fontcolorpicker} from './directives/fontcolorpicker/fontcolorpicker.directive';
import {materialForm} from './directives/materialForm/materialForm'

angular.module('app.directives')
    .directive('controlGenerator', controlGenerator)
    .directive('elementControl', elementControl)
    .directive('iconsList', iconsList)
    .directive('elementMargins', elementMargins)
    .directive('colorSelector', colorSelector)
    .directive('fontcolorpicker', fontcolorpicker)
    .directive('materialForm', materialForm)
    .directive('hider', hider);


angular.module('app.config', ['ngMaterial'])
    .config(function ($mdThemingProvider) {

        $mdThemingProvider.definePalette('amazingPaletteName', {
            '50': '0073aa',
            '100': '0073aa',
            '200': '0073aa',
            '300': '0073aa',
            '400': '0073aa',
            '500': '0073aa',
            '600': '0073aa',
            '700': '0073aa',
            '800': '0073aa',
            '900': '0073aa',
            'A100': '0073aa',
            'A200': '0073aa',
            'A400': '0073aa',
            'A700': '0073aa',
        });

        $mdThemingProvider.theme('default')
            .accentPalette('amazingPaletteName', {
                'default': '50'
            })
            .primaryPalette('amazingPaletteName', {
                'default': '50'
            })

    });