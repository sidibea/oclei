class AppRootController {
    constructor($http, $compile, $window, $mdToast, $httpParamSerializerJQLike, $scope, $timeout, $rootScope, wpMedia, History) {
        this.$compile = $compile;
        this.$http = $http;
        this.ajaxurl = $window.ajaxurl;
        this.$mdToast = $mdToast;
        this.jQlikeSerialize = $httpParamSerializerJQLike
        this.$scope = $scope;
        this.$rootScope = $rootScope;
        this.$rootScope.theme_options = [];
        this.$timeout = $timeout;
        this.wpMedia = wpMedia;
        this.$history = History;



        // $rootScope.$watch('theme_options', function (newValue, oldValue) {
        //     $rootScope.$broadcast('theme_options_changed', newValue, oldValue)
        // }, true);
    };

    $onInit() {
        let $_this = this;
        this.undo = false;
        this.$rootScope.theme_options = ngDefaultOptions;
        this.$rootScope.theme_options_backups = [];
        this.activeTab = 0;
        this.activeSubTab = 0;

        this.$rootScope.$watch('theme_options.page.options.error_page.options.error_page_bg.data.value', function (val, oldVal) {
            $_this.errorBageBg = $_this.wpMedia.getImageById(val).then((data) => {
                $_this.errorBageBg = data.url;
                $_this.$scope.$digest();
            });
        });

        this.$history.watch('theme_options');


        // this.activeSubTab = 0;

    }

    watchForUndo() {
        this.$rootScope.$on('theme_options_changed', (e, newValue, oldValue) => {
            // let a = JSON.stringify(newValue).replace(/"/g, '');
            // let b = JSON.stringify(oldValue).replace(/"/g, '');


        })
    }


    getOption(option) {

        let res = '';

        angular.forEach(this.$rootScope.theme_options, function (h_tab, h_tab_key) {
            angular.forEach(h_tab.options, function (v_tab, v_tab_key) {
                angular.forEach(v_tab.options, function (v, k) {
                    if (option === k) {
                        res = v.data.value;
                    }
                })
            })
        });

        return res;
    }

    getGoogleFontUrl(fontfamily) {

        if (angular.isUndefined(fontfamily)) {
            fontfamily = 'sans-serif';
        }
        let link = encodeURI(`https://fonts.googleapis.com/css?family=${fontfamily}:300,400,500,700,900`);
        return link;
    }

    undoAction() {
        // let backups = this.$rootScope.theme_options_backups;
        //
        // if (backups.length) {
        //     let last_backup = backups.pop();
        //     this.undo = true;
        //     this.$rootScope.theme_options = last_backup;
        // }
        this.$history.undo();
    }

    saveSettings() {


        let theme_options_values = {};

        angular.forEach(this.$rootScope.theme_options, (h_tab_options, h_tab) => {

            if (angular.isUndefined(theme_options_values[h_tab])) {
                theme_options_values[h_tab] = {};
                theme_options_values[h_tab]['options'] = {};
            }

            angular.forEach(h_tab_options.options, (v_tab_options, v_tab) => {

                if (angular.isUndefined(theme_options_values[h_tab]['options'][v_tab])) {
                    theme_options_values[h_tab]['options'][v_tab] = {};
                    theme_options_values[h_tab]['options'][v_tab]['options'] = {};
                }

                angular.forEach(v_tab_options.options, (element, element_key) => {
                    theme_options_values[h_tab]['options'][v_tab]['options'][element_key] = {};
                    theme_options_values[h_tab]['options'][v_tab]['options'][element_key]['data'] = {};
                    theme_options_values[h_tab]['options'][v_tab]['options'][element_key]['data']['value'] = element.data.value;
                })
            })
        });

        this.$http({
            url: this.ajaxurl,
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            params: {
                action: 'pearl_save_settings'
            },
            data: this.jQlikeSerialize(theme_options_values)
        }).then((res) => {
            this.$mdToast.show(
                this.$mdToast.simple()
                    .textContent(res.data['message'])
                    .position('bottom right')
                    .parent('.stm_to-actions')
                    .hideDelay(3000)
            );

            this.$http({
                url: this.ajaxurl,
                method: 'POST',
                params: {
                    action: 'pearl_update_custom_styles_admin'
                },
            }).then((res) => {
                console.log('Styles Updated');
            });

        });
    }

    hideControl(dependency_name, show_value, m_key, s_key, equality) {
        var r = false;
        var value = '';
        var equal = true;
        var sub = false;

        if (typeof equality !== 'undefined') {
            equal = false;
        }

        if (typeof dependency_name !== 'undefined' && angular.isDefined(this.$rootScope.theme_options[m_key]['options'][s_key]['options'][dependency_name])) {
            if (
                angular.isDefined(this.$rootScope.theme_options[m_key]['options'][s_key]['options'][dependency_name]['data']) &&
                angular.isDefined(this.$rootScope.theme_options[m_key]['options'][s_key]['options'][dependency_name]['data']['value'])
            ) {
                value = this.$rootScope.theme_options[m_key]['options'][s_key]['options'][dependency_name]['data']['value'];
            }
        }

        /*Check for value*/
        if (typeof show_value !== 'undefined') {
            if (equal && value !== show_value || !equal && value === show_value) r = true;
        }
        /*Check for checkbox*/
        if (value !== '' && typeof show_value === 'undefined') r = !value;

        return r;
    }

    activateSubTab(index, tab) {
        if (tab === 'parent') {
            this.$timeout(function () {
                let tab = angular.element('.tab-content .tab-pane').eq(index).find('li').eq(0).find('a');
                tab.trigger('click');
            }, 200);
        }
        this.activeSubTab = index;
    }

    hexToRgb(hex) {
        var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
        hex = hex.replace(shorthandRegex, function (m, r, g, b) {
            return r + r + g + g + b + b;
        });

        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);

        result = result ? `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` : null;

        return result;
    }

}

export const AppRootComponent = {
    templateUrl: ngAppPath + 'components/app-root/app-root.component.html',
    controller: AppRootController,
    controllerAs: 'vm',
    bindings: {}
};