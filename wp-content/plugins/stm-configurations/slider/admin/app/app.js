(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var AppRootController = function () {
    function AppRootController($location, StmSliderService, WpMediaService, $timeout, $scope, $filter, toastr, StmSliderTransitions, $q) {
        'ngInject';

        var _this = this;

        _classCallCheck(this, AppRootController);

        this.$location = $location;
        this.$stm = StmSliderService;
        this.$wpmedia = WpMediaService;
        this.$timeout = $timeout;
        this.$scope = $scope;
        this.$filter = $filter;
        this.toastr = toastr;
        this.slidesForRemove = [];
        this.sliderSavingState = false;
        this.transitions = StmSliderTransitions.getTransitions();
        this.$q = $q;

        this.timeout_posts = '';
        this.posts = [];
        this.selected_posts = [];

        this.overlayColor = 'rgb(255, 255, 255)';

        this.colorpickerDefaults = {
            openOnInput: true,
            hsl: false,
            history: false,
            materialPalette: false,
            clearButton: false,
            preview: false
        };

        this.iconSearch = '';
        this.stm_slider = {};
        this.stm_sliderMeta = {
            heightUnit: 'px',
            height: 700,
            widthUnit: 'percent',
            width: 100,
            autoplayDuration: 3000,
            overlayColor: 'rgb(255, 255, 255)',
            source: 'custom',
            posts_count: 4,
            post_slides: []
        };
        this.slideDefaults = {
            duration: 3000,
            data: {
                image: {
                    url: '',
                    loaded: false
                }
            },
            overlay: false,
            pattern: false,
            contentAlign: 'left',
            titleOptions: {
                align: 'center'
            },
            contentOptions: {
                align: 'center'
            },
            button: {
                align: 'center'
            },
            buttonOptions: {},
            touched: false,
            enable: true
        };
        this.sliderSettingsLoaded = false;
        this.bgPickerOptions = {
            pos: 'top right',
            inline: true
        };
        this.beforeSlideMove = [];
        this.afterSlideMove = [];
        this.icons = stm_icons;

        var $this = this;

        this.slidesSortableOptions = {
            items: '.stm-slider__slide_tab-heading',
            start: function start(e, ui) {

                var logEntry = _this.slides.map(function (i) {
                    return i.order;
                });
            },
            update: function update(e, ui) {

                var logEntry = _this.slides.map(function (i) {
                    return i.order;
                });
            },
            stop: function stop(e, ui) {
                var logEntry = _this.slides.map(function (i) {
                    return i.order;
                });
                _this.beforeSlideMove = ui.item.sortable.index;
                _this.afterSlideMove = ui.item.sortable.dropindex;

                if (ui.item.sortable.index < _this.currentSlide && _this.currentSlide < ui.item.sortable.dropindex) {
                    _this.currentSlide = _this.currentSlide - 1;
                } else if (ui.item.sortable.index > _this.currentSlide && _this.currentSlide > ui.item.sortable.dropindex) {
                    _this.currentSlide = _this.currentSlide + 1;
                } else if (_this.currentSlide === ui.item.sortable.index) {
                    if (typeof ui.item.sortable.dropindex !== 'undefined') {
                        _this.currentSlide = ui.item.sortable.dropindex;
                    }
                } else if (_this.currentSlide === ui.item.sortable.dropindex) {

                    if (_this.currentSlide === _this.slides.length - 1) {
                        _this.currentSlide = _this.currentSlide - 1;
                    } else if (_this.currentSlide === 0) {
                        _this.currentSlide = _this.currentSlide + 1;
                    } else {
                        _this.currentSlide = ui.item.sortable.index;
                    }
                }

                $scope.$emit('slideMoved', [e, ui]);
            }
        };
        this.preview = {
            style: {
                height: 300
            },
            loaded: false
        };
    }

    _createClass(AppRootController, [{
        key: '$onInit',
        value: function $onInit() {
            var _this2 = this;

            this.stm_slider.ID = this.getQueryParam('slider_id') ? this.getQueryParam('slider_id') : null;
            this.getSlider();
            this.currentSlide = 0;
            this.$scope.$on('ui-sortable:moved', function (e, ui) {
                _this2.updateSlidesOrder();
            });
            this.$scope.$watchGroup(['vm.stm_sliderMeta.height', 'vm.stm_sliderMeta.width', 'vm.stm_sliderMeta.widthUnit'], function (val, oldVal) {
                if (val[0] !== oldVal[0]) {
                    _this2.preview.style.height = val[0];
                }

                if (val[1] !== oldVal[1]) {
                    var unit = val[2] === 'percent' ? '%' : 'px';
                    _this2.preview.style.width = '' + val[1] + unit;
                }
            });
        }
    }, {
        key: 'getSlider',
        value: function getSlider() {
            var _this3 = this;

            var update = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

            this.$stm.getSlider(this.stm_slider.ID).then(function (res) {
                _this3.stm_slider = res.data;
                if (!angular.isObject(res.data)) {
                    console.log(res.data);
                    _this3.toastr.error('Error occured');
                    return;
                }
                _this3.$stm.getSliderMeta(_this3.stm_slider.ID).then(function (res) {
                    if (!angular.isObject(res.data)) {
                        res.data = {};
                    }
                    _this3.stm_sliderMeta = angular.merge(_this3.stm_sliderMeta, res.data);
                    _this3.getSlides(update);
                    _this3.sliderSettingsLoaded = true;
                });
            });
        }
    }, {
        key: 'getSlides',
        value: function getSlides() {
            var _this4 = this;

            var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

            this.$stm.getSlides(this.stm_slider.ID).then(function (res) {
                if (!angular.isObject(res.data)) {
                    console.log(res.data);
                    _this4.toastr.error('Error occured');
                    return;
                }

                if (res.data.length < 1) {
                    res.data = {};
                }

                _this4.slides = [];

                if (!angular.equals(res.data, {})) {
                    angular.forEach(res.data, function (v, k) {
                        var slide = {};
                        var defaults = angular.copy(_this4.slideDefaults);

                        v = angular.merge(defaults, v);
                        _this4.slides.push(v);
                    });
                }

                _this4.getPreviews(_this4.slides);

                _this4.filterSLides();

                if (message) {
                    _this4.sliderSavingState = false;
                    _this4.toastr.success('Slider Saved', '', {
                        positionClass: 'toast-center-center'
                    });
                }
            });
        }
    }, {
        key: 'getPreviews',
        value: function getPreviews(slides) {
            var _this5 = this;

            angular.forEach(slides, function (v, k) {
                if (angular.isDefined(v.imageId)) {
                    _this5.$stm.getSlidePreview(v.imageId, v.id).then(function (res) {
                        if (angular.isDefined(v.data.image.url)) {
                            v.data.image.url = res.data;
                            v.data.image.loaded = true;
                            _this5.preview.loaded = true;
                        }
                    });
                } else {
                    v.data.image.loaded = true;
                }

                if (angular.isDefined(v.patternId)) {
                    _this5.$wpmedia.getImageById(v.patternId).then(function (res) {
                        if (angular.isDefined(res.url)) {
                            v.data.image.patternUrl = res.url;
                            _this5.preview.loaded = true;
                        }
                    });
                }
            });
        }
    }, {
        key: 'saveSlider',
        value: function saveSlider() {
            var _this6 = this;

            this.sliderSavingState = true;
            this.$stm.save(this.stm_slider).then(function (res) {
                _this6.$stm.saveSliderMeta(_this6.stm_slider.ID, _this6.stm_sliderMeta).then(function (res) {
                    _this6.saveSlides();
                });
            });
        }
    }, {
        key: 'saveSlides',
        value: function saveSlides() {
            var _this7 = this;

            var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

            this.$stm.saveSlide(this.stm_slider.ID, this.slides).then(function (res) {
                _this7.sliderSavingState = false;

                if (message) {
                    _this7.toastr.success('Slider Saved', '', {
                        positionClass: 'toast-center-center'
                    });
                }
            });
        }
    }, {
        key: 'cloneSlide',
        value: function cloneSlide(index) {
            var _this8 = this;

            var newSlide = Object.assign({}, this.slides[index]);

            newSlide.order = this.slides.length + 1;
            var newIndex = this.slides.push(newSlide) - 1;

            this.$stm.addSlide(this.stm_slider.ID, newSlide).then(function (res) {
                _this8.slides[newIndex].id = res.data;
            });
        }
    }, {
        key: 'deleteSlide',
        value: function deleteSlide(id, index) {
            var confirmed = confirm('Are you sure?');

            if (confirmed == true) {
                if (angular.isDefined(id)) {
                    this.slidesForRemove.push(id);
                }
                this.slides.splice(index, 1);
            }

            this.$stm.deleteSlide(id);

            this.updateSlidesOrder();
            this.saveSlides(false);
        }
    }, {
        key: 'filterSLides',
        value: function filterSLides() {
            if (angular.equals(this.slides, {})) {
                return;
            }
            this.slides = this.$filter('orderBy')(this.slides, 'data.order');
        }
    }, {
        key: 'getQueryParam',
        value: function getQueryParam(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return pair[1];
                }
            }
            return false;
        }
    }, {
        key: 'addSlide',
        value: function addSlide() {
            var _this9 = this;

            var order = this.slides.length + 1;
            var newSlide = angular.copy(this.slideDefaults);
            newSlide.order = order;
            newSlide.data = {
                image: {
                    url: '',
                    loaded: true
                }
            };

            var newSlideIndex = this.slides.push(newSlide) - 1;

            this.$stm.addSlide(this.stm_slider.ID, newSlide).then(function (res) {
                _this9.slides[newSlideIndex].id = res.data;
            });

            this.$timeout(function () {
                if (angular.isUndefined(_this9.currentSlide)) {
                    _this9.currentSlide = 0;
                } else {
                    _this9.currentSlide = _this9.slides.length - 1;
                }
            }, 100);

            return newSlideIndex;
        }
    }, {
        key: 'addSlideBackground',
        value: function addSlideBackground(slide) {
            var vm = this;
            this.$wpmedia.selectImage().then(function (res) {
                slide.imageId = res.id;
                slide.data.image.url = res.url;
            });
        }
    }, {
        key: 'deleteSlideBackground',
        value: function deleteSlideBackground(slide) {
            delete slide.data.image.url;
            delete slide.imageId;
        }
    }, {
        key: 'addSlidePattern',
        value: function addSlidePattern(index) {
            var _this10 = this;

            this.$wpmedia.selectImage().then(function (res) {
                _this10.slides[index].patternId = res.id;
                _this10.slides[index].data.image.patternUrl = res.url;
            });
        }
    }, {
        key: 'moveSlide',
        value: function moveSlide(from, to) {
            this.slides.splice(to, 0, this.slides.splice(from, 1)[0]);
        }
    }, {
        key: 'updateSlidesOrder',
        value: function updateSlidesOrder() {
            var _this11 = this;

            angular.forEach(this.slides, function (v, k) {
                _this11.slides[k].order = k + 1;
            });
        }
    }, {
        key: 'filterIcons',
        value: function filterIcons(set) {
            this.filteredIcons = this.$filter('filter')(this.icons[set], this.iconSearch);
        }
    }, {
        key: 'getPosts',
        value: function getPosts(keyword) {
            var $this = this;
            return $this.$stm.getPosts(keyword).then(function (res) {
                var response = res.data;
                $this.posts = response;

                return response;
            });
        }
    }, {
        key: 'postSelected',
        value: function postSelected($item) {
            this.stm_sliderMeta.post_slides.push($item);
            this.slide_post = '';
        }
    }, {
        key: 'removePost',
        value: function removePost(key) {
            this.stm_sliderMeta.post_slides.splice(key, 1);
        }
    }]);

    return AppRootController;
}();

var appRootComponent = exports.appRootComponent = {
    templateUrl: 'app-root/app-root.component.html',
    controller: AppRootController,
    controllerAs: 'vm'
};

},{}],2:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var wpRequest = function wpRequest() {
    "use strict";

    var interceptor = {
        'request': function request(config) {
            if (angular.isDefined(config.wp) && config.wp === true) {

                if (angular.isUndefined(config.params)) {
                    config.params = {};
                }

                config.params.action = 'stm_slider_ajax';
                config.headers = {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Accept': 'application/json'
                };
            }
            return config;
        }
    };

    return interceptor;
};

var wpRequestConfig = exports.wpRequestConfig = function wpRequestConfig($httpProvider) {
    $httpProvider.interceptors.push(wpRequest);
};

},{}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var contentAlignDirective = exports.contentAlignDirective = function contentAlignDirective() {
    "use strict";

    var scope = {
        model: '='
    };

    var link = function link(scope, elem, attrs) {
        scope.aligns = ['left', 'center', 'right'];
    };

    return {
        restrict: 'E',
        scope: scope,
        link: link,
        templateUrl: 'content-align/content-align.directive.html'
    };
};

},{}],4:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var IconPickerController = function () {
    function IconPickerController($scope, $element, $attrs, stmIcons, $filter) {
        _classCallCheck(this, IconPickerController);

        this.iconName = '';
        this.iconSearch = '';
        this.setName = 'FontAwesome';
        this.icons = [];
        this.iconSets = stmIcons;
        this.currentSet = this.iconSets[this.setName];
        this.iconsSetsNames = [];
        this.showList = false;
        this.scope = $scope;
        this.filter = $filter;

        this.filteredIcons = this.currentSet;
        this.limit = 150;

        var vm = this;

        angular.forEach(stmIcons, function (value, key) {
            vm.iconsSetsNames.push(key);

            angular.forEach(value, function (icon) {
                vm.icons.push(icon);
            });
        });

        $scope.$watch('vm.iconSearch', function (val) {
            vm.getFilteredIcons();
        });

        $('body').click(function () {
            $scope.$apply(function () {
                vm.showList = false;
            });
        });

        $element.bind('click', function (e) {
            e.stopPropagation();
        });
    }

    _createClass(IconPickerController, [{
        key: 'updateLimit',
        value: function updateLimit() {
            this.limit += 50;
        }
    }, {
        key: 'changeSetName',
        value: function changeSetName(setName) {
            console.log(setName);
            this.currentSet = this.iconSets[setName];
            this.iconSearch = '';
            this.getFilteredIcons();
        }
    }, {
        key: 'selectIcon',
        value: function selectIcon(icon) {
            this.list.close(icon);
            this.isOpen = false;
        }
    }, {
        key: 'setCurrentIconSet',
        value: function setCurrentIconSet(set_name, iconSearch) {
            this.limit = 150;
            this.currentSet = this.iconSets[set_name];
            this.setName = set_name;

            this.getFilteredIcons(iconSearch);
        }
    }, {
        key: 'getFilteredIcons',
        value: function getFilteredIcons() {
            if (this.iconSearch === 0) {
                this.limit = 150;
                this.filteredIcons = this.currentSet;
            }
            this.filteredIcons = this.filter('filter')(this.currentSet, this.iconSearch);
        }
    }, {
        key: 'selectIcon',
        value: function selectIcon(icon) {
            this.scope.icon = icon;
            this.showList = false;
        }
    }]);

    return IconPickerController;
}();

;

var iconPickerDirective = exports.iconPickerDirective = function iconPickerDirective($filter, stmIcons) {
    "use strict";

    var link = function link(scope, elem, attrs) {




    };

    return {
        link: link,
        scope: {
            icon: '='
        },
        restrict: 'E',
        templateUrl: 'icon-picker/icon-picker.directive.html',
        controller: IconPickerController,
        controllerAs: 'vm'
    };
};

},{}],5:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var scaleValueDirective = exports.scaleValueDirective = function scaleValueDirective($timeout) {
    var scope = {
        slideWidth: '@',
        model: '='
    };

    var link = function link(scope, elem, attrs) {

        elem.bind('load', function () {
            $timeout(function () {
                var image = angular.element(elem);
                var parent = image.parent();
                var initialWidth = image[0].width;
                var parentWidth = parent.outerWidth();

                var scale = 100;
                if (initialWidth > parentWidth) {
                    scale = parseInt(parentWidth / initialWidth * 100);
                }

                scope.scale = scale;
                parent.append('<div class="scale">' + scale + '</div>');
            }, 50);
        });
    };

    return {
        restrict: 'A',
        scope: scope,
        link: link,
        template: '<div>{{scale}}</div>'
    };
};

},{}],6:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SlideContentController = function () {
    function SlideContentController($scope, $element, $attrs, googleFonts, $rootScope, $timeout) {
        _classCallCheck(this, SlideContentController);

        this.scope = $scope;
        this.rootScope = $rootScope;
        this.$t = $timeout;
        this.fonts = googleFonts;
        this.fontSizes = [];

        if (angular.isUndefined($attrs.linkUrl)) {
            this.linkUrl = false;
        } else {
            if (angular.isUndefined($scope.linkUrl)) {
                this.scope.linkUrl = '#';
            }
        }

        $element.bind('click', function (e) {
            e.stopPropagation();
            $('slide-element').not($(this)).removeClass('active');
            $(this).addClass('active');
        });

        $('.stm_slide__preview').click(function () {
            $($element).removeClass('active');
        });
        this.showInput = false;
        this.makeFonts();

        if (angular.isUndefined(this.scope.modelOptions.align)) {
            this.scope.modelOptions.align = this.scope.modelOptions.contentAlign;
        }
        var vm = this;

        this.scope.$watch('vm.scope.$parent.slide.contentAlign', function (val, oldVal) {
            if (val !== oldVal) {
                vm.scope.modelOptions.align = val;
            }
        });

        this.adjustTa();
        this.taCols = 35;
        if (angular.isDefined(this.scope.model) && this.scope.model.length) {
            if (this.scope.model.length < 35) {
                this.taCols = this.scope.model.length + 1;
            } else {
                this.taCols = 35;
            }
        } else {
            this.taCols = this.scope.placeholder.length;
        }
    }

    _createClass(SlideContentController, [{
        key: 'makeFonts',
        value: function makeFonts() {

            var fontNames = {};
            angular.forEach(this.fonts, function (v, k) {
                fontNames[k] = k;
            });
            this.fontNames = fontNames;

            for (var i = 8; i <= 120; i++) {
                this.fontSizes[i] = i + 'px';
            }
            this.fontSizes[0] = 'Default';
        }
    }, {
        key: 'adjustTa',
        value: function adjustTa() {
            var _this = this;

            this.$t(function () {
                _this.rootScope.$broadcast('autoheight-adjust');
            }, 310);
        }
    }]);

    return SlideContentController;
}();

var slideContentDirective = exports.slideContentDirective = function slideContentDirective() {
    var scope = {
        type: '@',
        model: '=',
        modelOptions: '=?',
        placeholder: '=',
        linkUrl: '=?'
    };

    var link = function link(scope, elem, attrs) {};

    return {
        restrict: 'E',
        scope: scope,
        controller: SlideContentController,
        controllerAs: 'vm',
        templateUrl: 'slide-content/slide-content.directive.html'
    };
};

},{}],7:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var stmDropdownDirective = exports.stmDropdownDirective = function stmDropdownDirective($filter) {
    "use strict";

    var scope = {
        options: '=',
        model: '=',
        callback: '&',
        filter: '=?',
        empty: '=?'
    };

    var link = function link(scope, elem, attrs) {
        var options = [];
        scope.modelSelected = true;
        if (angular.isUndefined(scope.filter)) {
            scope.filter = false;
        }



        scope.updateLabel = function () {
            if (scope.empty) {
                scope.label = 'None';
            } else {
                if (angular.isDefined(scope.model) && scope.model !== 'false') {
                    scope.label = scope.options[scope.model];
                    console.log(scope.options[scope.model]);
                } else {
                    if (angular.isDefined(scope.options)) {
                        scope.label = scope.options[Object.keys(scope.options)[0]];
                    }
                }
            }
        };

        elem.click(function (e) {
            e.stopPropagation();
        });
        $('body').on('click', function () {
            scope.$apply(function () {
                scope.showList = false;
            });
        });
        scope.showList = false;

        scope.selectOption = function (key, value) {
            scope.model = key;
            scope.label = value;
            scope.showList = false;
            scope.modelSelected = true;
            scope.callback();
        };

        scope.$watch('options', function (v, k) {
            scope.filteredOptions = scope.options;
            scope.updateLabel();
        });

        if (scope.filter) {
            scope.$watch('label', function (val) {
                if (scope.modelSelected) {
                    scope.filteredOptions = scope.options;
                } else {
                    scope.filteredOptions = $filter('objectFilter')(scope.options, val);
                }
            });
        } else {
            scope.filteredOptions = scope.options;
        }



    };

    return {
        restrict: 'E',
        scope: scope,
        link: link,
        templateUrl: 'stm-dropdown/stm-dropdown.directive.html'
    };
};

},{}],8:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var switcherDirective = exports.switcherDirective = function switcherDirective() {
    "use strict";

    var link = function link(scope, element, attrs) {
        if (angular.isString(scope.model)) {
            scope.model = scope.model === 'true';
        }
    };

    var scope = {
        model: '='
    };

    return {
        restrict: 'E',
        link: link,
        scope: scope,
        templateUrl: 'switcher/switcher.directive.html',
        transclude: true
    };
};

},{}],9:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
function getLineHeight(node) {
    var computedStyle = window.getComputedStyle(node);
    var lineHeightStyle = computedStyle.lineHeight;
    if (lineHeightStyle === 'normal') return +computedStyle.fontSize.slice(0, -2);else return +lineHeightStyle.slice(0, -2);
}

function px2val(str) {
    return +str.slice(0, -2);
}

var taAutosizeDirective = exports.taAutosizeDirective = function taAutosizeDirective($sniffer) {
    'use strict';

    return {
        require: 'ngModel',
        restrict: 'A, C',
        link: function link(scope, element, attr, ctrl) {
            var node = element[0];
            var lineHeight = getLineHeight(node);
            var useClone = 'useClone' in attr;
            var clone;

            if (useClone) {
                clone = document.createElement('textarea');
                var computedStyle = getComputedStyle(node);

                clone.style.border = '1px solid black';
                clone.style.borderWidth = computedStyle.borderTopWidth;
                clone.style.borderWidth = computedStyle.borderBottomWidth;
                clone.style.borderWidth = computedStyle.borderLeftWidth;
                clone.style.borderWidth = computedStyle.borderRightWidth;
                clone.style.width = node.clientWidth + px2val(clone.style.borderLeftWidth) + px2val(clone.style.borderRightWidth) + 'px';
                clone.style.height = '1px';
                clone.style.paddingTop = computedStyle.paddingTop;
                clone.style.paddingBottom = computedStyle.paddingBottom;
                clone.style.paddingLeft = computedStyle.paddingLeft;
                clone.style.paddingRight = computedStyle.paddingRight;
                clone.style.position = 'absolute';
                clone.style.top = '0px';
                clone.style.left = '-1000px';

                clone.style.fontFamily = computedStyle.fontFamily;
                clone.style.fontSize = computedStyle.fontSize;
                clone.style.boxSizing = computedStyle.boxSizing;
                clone.style.overflow = 'hidden';

                document.body.appendChild(clone);

                scope.$on('$destroy', function () {
                    document.body.removeChild(clone);
                });
            }

            element.on('input', adjust);
            element.on('change', adjust);

            if (ctrl) {
                scope.$watch(function () {
                    return ctrl.$viewValue;
                }, adjust);
            }

            scope.$watch(function () {
                return node.offsetHeight || node.offsetWidth;
            }, function (newVal, oldVal) {
                if (newVal && !oldVal) adjust();
            });

            adjust();

            scope.$on('autoheight-adjust', function () {
                adjust();
            });

            function adjust() {
                if (useClone) {
                    if (clone.value !== node.value) {
                        clone.value = node.value;
                        node.style.height = clone.scrollHeight + px2val(clone.style.borderTopWidth) + px2val(clone.style.borderBottomWidth) + 'px';
                    }
                } else {
                    if (isNaN(lineHeight)) lineHeight = getLineHeight(node);
                    if (!(node.offsetHeight || node.offsetWidth)) return;
                    if (node.scrollHeight <= node.clientHeight) node.style.height = '0px';
                    var h = node.scrollHeight + 
                    node.offsetHeight - 
                    node.clientHeight; 
                    var isIE = $sniffer.msie || $sniffer.vendorPrefix && $sniffer.vendorPrefix.toLowerCase() === 'ms';
                    node.style.height = Math.max(h, lineHeight) + (isIE ? 1 : 0) + 
                    'px';
                }
            }
        }
    };
};

},{}],10:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var textSettingsPanelDirective = exports.textSettingsPanelDirective = function textSettingsPanelDirective($rootScope) {
    var scope = {
        model: '=',
        link: '=?'
    };

    var link = function link(scope, elem, attrs) {


        angular.forEach(['fw', 'fi', 'fu'], function (v) {
            if (typeof scope.modelOptions[v] === 'string') {
                scope.modelOptions[v] = scope.modelOptions[v] === 'true';
            }
        });

        scope.colorpickerDefaults = {
            openOnInput: true,
            hsl: false,
            history: false,
            materialPalette: false,
            clearButton: false,
            preview: true
        };
    };

    return {
        restrict: 'E',
        link: link,
        templateUrl: 'text-settings-panel/text-settings-panel.directive.html'
    };
};

},{}],11:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
var transitionsDirective = exports.transitionsDirective = function transitionsDirective() {
    var scope = {
        model: '='
    };

    var link = function link($scope) {
        "use strict";

        $scope.transitions = {

            "attention_seekers": ["bounce", "flash", "pulse", "rubberBand", "shake", "headShake", "swing", "tada", "wobble", "jello"],

            "bouncing_entrances": ["bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp"],

            "bouncing_exits": ["bounceOut", "bounceOutDown", "bounceOutLeft", "bounceOutRight", "bounceOutUp"],

            "fading_entrances": ["fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig"],

            "fading_exits": ["fadeOut", "fadeOutDown", "fadeOutDownBig", "fadeOutLeft", "fadeOutLeftBig", "fadeOutRight", "fadeOutRightBig", "fadeOutUp", "fadeOutUpBig"],

            "flippers": ["flip", "flipInX", "flipInY", "flipOutX", "flipOutY"],

            "lightspeed": ["lightSpeedIn", "lightSpeedOut"],

            "rotating_entrances": ["rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight"],

            "rotating_exits": ["rotateOut", "rotateOutDownLeft", "rotateOutDownRight", "rotateOutUpLeft", "rotateOutUpRight"],

            "specials": ["hinge", "rollIn", "rollOut"],

            "zooming_entrances": ["zoomIn", "zoomInDown", "zoomInLeft", "zoomInRight", "zoomInUp"],

            "zooming_exits": ["zoomOut", "zoomOutDown", "zoomOutLeft", "zoomOutRight", "zoomOutUp"],

            "sliding_entrances": ["slideInDown", "slideInLeft", "slideInRight", "slideInUp"],

            "sliding_exits": ["slideOutDown", "slideOutLeft", "slideOutRight", "slideOutUp"]
        };
    };

    return {
        restrict: 'E',
        link: link,
        scope: scope,
        templateUrl: 'transitions/transitions.directive.html'
    };
};

},{}],12:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});
var transitions = exports.transitions = function transitions() {
    var transitions = {
        'default': 'Default',
        'bounce': 'Bounce',
        'flash': 'Flash',
        'pulse': 'Pulse',
        'rubberBand': 'Rubber Band',
        'shake': 'Shake',
        'headShake': 'Head Shake',
        'swing': 'Swing',
        'tada': 'Tada',
        'wobble': 'Wobble',
        'jello': 'Jello',
        'bounceIn': 'Bounce In',
        'bounceInDown': 'Bounce In Down',
        'bounceInLeft': 'Bounce In Left',
        'bounceInRight': 'Bounce In Right',
        'bounceInUp': 'Bounce In Up',
        'bounceOut': 'Bounce Out',
        'bounceOutDown': 'Bounce Out Down',
        'bounceOutLeft': 'Bounce Out Left',
        'bounceOutRight': 'Bounce Out Right',
        'bounceOutUp': 'Bounce Out Up',
        'fadeIn': 'Fade In',
        'fadeInDown': 'Fade In Down',
        'fadeInDownBig': 'Fade In Down Big',
        'fadeInLeft': 'Fade In Left',
        'fadeInLeftBig': 'Fade In Left Big',
        'fadeInRight': 'Fade In Right',
        'fadeInRightBig': 'Fade In Right Big',
        'fadeInUp': 'Fade In Up',
        'fadeInUpBig': 'Fade In Up Big',
        'flip': 'Flip',
        'flipInX': 'Flip In X',
        'flipInY': 'Flip In Y',
        'flipOutX': 'Flip Out X',
        'flipOutY': 'Flip Out Y',
        'lightSpeedIn': 'Light Speed In',
        'lightSpeedOut': 'light Speed Out',
        'rotateIn': 'Rotate In',
        'rotateInDownLeft': 'Rotate In Down Left',
        'rotateInDownRight': 'Rotate In Down Right',
        'rotateInUpLeft': 'Rotate In Up Left',
        'rotateInUpRight': 'Rotate In Up Right',
        'rotateOut': 'Rotate Out',
        'rotateOutDownLeft': 'Rotate Out Down Left',
        'rotateOutDownRight': 'Rotate Out Down Right',
        'rotateOutUpLeft': 'Rotate Out Up Left',
        'rotateOutUpRight': 'Rotate Out Up Right',
        'hinge': 'Hinge',
        'rollIn': 'Roll In',
        'rollOut': 'Roll Out',
        'zoomIn': 'Zoom In',
        'zoomInDown': 'Zoom In Down',
        'zoomInLeft': 'Zoom In Left',
        'zoomInRight': 'Zoom In Right',
        'zoomInUp': 'Zoom In Up',
        'zoomOut': 'Zoom Out',
        'zoomOutDown': 'Zoom Out Down',
        'zoomOutLeft': 'Zoom Out Left',
        'zoomOutRight': 'Zoom Out Right',
        'zoomOutUp': 'Zoom Out Up',
        'slideInDown': 'Slide In Down',
        'slideInLeft': 'Slide In Left',
        'slideInRight': 'Slide In Right',
        'slideInUp': 'Slide In Up',
        'slideOutDown': 'Slide Out Down',
        'slideOutLeft': 'Slide Out Left',
        'slideOutRight': 'Slide Out Right',
        'slideOutUp': 'Slide Out Up'
    };
    return {
        getTransitionsTypes: function getTransitionsTypes() {
            'use strict';

            var types = {};
            angular.forEach(transitions, function (v, k) {
                var type = k.replace('_', ' ');
                types[k] = type;
            });

            return types;
        },
        getTransitions: function getTransitions() {
            'use strict';

            return transitions;
        }
    };
};

},{}],13:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
var objectFilter = exports.objectFilter = function objectFilter() {
    return function (items, search) {
        var res = {};
        angular.forEach(items, function (value, key) {
            if (search !== value) {
                if (value.indexOf(search) !== -1 || value.toLowerCase().indexOf(search) !== -1) {
                    res[key] = value;
                }
            }
        });

        if (res.length < 0) {
            res = items;
        }

        return res;
    };
};

},{}],14:[function(require,module,exports){
'use strict';

var _httpInterceptors = require('./config/http-interceptors.config');

var _appRoot = require('./components/app-root/app-root.component');

var _switcher = require('./directives/switcher/switcher.directive');

var _transitions = require('./directives/transitions/transitions.directive');

var _stmDropdown = require('./directives/stm-dropdown/stm-dropdown.directive');

var _contentAlign = require('./directives/content-align/content-align.directive');

var _slideContent = require('./directives/slide-content/slide-content.directive');

var _scaleValue = require('./directives/scale-value/scale-value.directive');

var _taAutosize = require('./directives/ta-autosize/ta-autosize.directive');

var _textSettingsPanel = require('./directives/text-settings-panel/text-settings-panel.directive');

var _iconPicker = require('./directives/icon-picker/icon-picker.directive');

var _stmSlider = require('./services/stm-slider.service');

var _wpMedia = require('./services/wp-media.service');

var _transitions2 = require('./factories/transitions.factory');

var _objectFilter = require('./filters/objectFilter.filter');

var app = angular.module('app', ['app.templates', 'ui.bootstrap', 'pascalprecht.translate', 'colorpicker.module', 'ui.sortable', 'toastr', 'ngMaterial', 'mdColorPicker']);

app.constant('appPath', '' + stm_slider_vars.appPath).constant('stmIcons', stm_icons).constant('googleFonts', JSON.parse(stm_google_fonts));

app.config(function ($translateProvider, appPath) {
    "use strict";

    $translateProvider.useStaticFilesLoader({
        prefix: appPath + '/translates/',
        suffix: '.json'
    });
    $translateProvider.preferredLanguage('en');
}).config(_httpInterceptors.wpRequestConfig);

app.component('appRoot', _appRoot.appRootComponent);



app.directive('switcher', _switcher.switcherDirective).directive('transitions', _transitions.transitionsDirective).directive('contentAlign', _contentAlign.contentAlignDirective).directive('slideElement', _slideContent.slideContentDirective).directive('scaleValue', _scaleValue.scaleValueDirective).directive('taAutosize', _taAutosize.taAutosizeDirective).directive('textSettingsPanel', _textSettingsPanel.textSettingsPanelDirective).directive('iconPicker', _iconPicker.iconPickerDirective).directive('stmDropdown', _stmDropdown.stmDropdownDirective);

app.service('StmSliderService', _stmSlider.StmSliderService).service('WpMediaService', _wpMedia.WpMediaService);

app.factory('StmSliderTransitions', _transitions2.transitions);

app.filter('objectFilter', _objectFilter.objectFilter);

angular.module('app.templates', []); 

},{"./components/app-root/app-root.component":1,"./config/http-interceptors.config":2,"./directives/content-align/content-align.directive":3,"./directives/icon-picker/icon-picker.directive":4,"./directives/scale-value/scale-value.directive":5,"./directives/slide-content/slide-content.directive":6,"./directives/stm-dropdown/stm-dropdown.directive":7,"./directives/switcher/switcher.directive":8,"./directives/ta-autosize/ta-autosize.directive":9,"./directives/text-settings-panel/text-settings-panel.directive":10,"./directives/transitions/transitions.directive":11,"./factories/transitions.factory":12,"./filters/objectFilter.filter":13,"./services/stm-slider.service":15,"./services/wp-media.service":16}],15:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var StmSliderService = exports.StmSliderService = function () {
    function StmSliderService($http, $window, $httpParamSerializerJQLike) {
        'ngInject';

        _classCallCheck(this, StmSliderService);

        this.$http = $http;
        this.$window = $window;
        this.$JQlikeSerialize = $httpParamSerializerJQLike;
    }

    _createClass(StmSliderService, [{
        key: 'save',
        value: function save(data) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    sliderObj: data,
                    slider: 'save'
                }
            });
        }
    }, {
        key: 'getSlider',
        value: function getSlider(id) {
            return this.$http({
                url: ajaxurl,
                wp: true,
                params: {
                    slider: 'get',
                    sliderId: id
                }
            });
        }
    }, {
        key: 'saveSliderMeta',
        value: function saveSliderMeta(id, data) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    slider: 'save_meta',
                    sliderId: id,
                    sliderMeta: data
                }
            });
        }
    }, {
        key: 'getSliderMeta',
        value: function getSliderMeta(id) {
            return this.$http({
                url: ajaxurl,
                wp: true,
                params: {
                    slider: 'get_meta',
                    sliderId: id
                }
            });
        }
    }, {
        key: 'getSlidePreview',
        value: function getSlidePreview(imageId, postId) {
            return this.$http({
                url: ajaxurl,
                wp: true,
                params: {
                    slider: 'slide_preview',
                    imageId: imageId,
                    postId: postId
                }
            });
        }
    }, {
        key: 'addSlide',
        value: function addSlide(sliderId, slideArray) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    slider: 'add_slide',
                    sliderId: sliderId,
                    slide: slideArray
                }
            });
        }
    }, {
        key: 'saveSlide',
        value: function saveSlide(sliderId, slides) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    slider: 'save_slides',
                    sliderId: sliderId,
                    slides: slides
                }
            });
        }
    }, {
        key: 'deleteSlide',
        value: function deleteSlide(slideId) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    slider: 'delete_slide',
                    slideId: slideId
                }
            });
        }
    }, {
        key: 'deleteSlides',
        value: function deleteSlides(slides) {
            return this.$http({
                url: ajaxurl,
                method: 'POST',
                wp: true,
                data: {
                    slider: 'delete_slides',
                    slides: slides
                }
            });
        }
    }, {
        key: 'getSlides',
        value: function getSlides(id) {
            return this.$http({
                url: ajaxurl,
                wp: true,
                params: {
                    slider: 'get_slides',
                    sliderId: id
                }
            });
        }
    }, {
        key: 'getPosts',
        value: function getPosts(keyword) {
            return this.$http({
                url: ajaxurl,
                wp: true,
                params: {
                    slider: 'get_slide_posts',
                    keyword: keyword
                }
            });
        }
    }]);

    return StmSliderService;
}();

;

},{}],16:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var WpMediaService = exports.WpMediaService = function () {
    function WpMediaService($window, $q) {
        _classCallCheck(this, WpMediaService);

        this.$window = $window;
        this.frame = {};
        this.$q = $q;
    }

    _createClass(WpMediaService, [{
        key: "openModal",
        value: function openModal() {
            this.frame = this.$window.wp.media({
                title: "Select image",
                library: { type: "" },
                button: {
                    text: "Select"
                },
                multiple: false
            }).open();
        }
    }, {
        key: "selectImage",
        value: function selectImage() {
            var size = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'full';

            this.openModal();
            var vm = this;
            var deffered = this.$q.defer();

            this.frame.on('select', function () {
                var frameObj = vm.frame.state().get("selection").first().toJSON();

                var url = frameObj.url;
                if (!angular.isUndefined(frameObj.sizes)) {
                    url = frameObj.sizes[size].url;
                }
                var res = {
                    'id': frameObj.id,
                    'url': url
                };
                deffered.resolve(res);
            });

            return deffered.promise;
        }
    }, {
        key: "getImageById",
        value: function getImageById(id) {
            return this.$window.wp.media.attachment(id).fetch();
        }
    }]);

    return WpMediaService;
}();

},{}]},{},[14]);

angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('app-root/app-root.component.html',
        "<div ng-if=\"vm.sliderSettingsLoaded\">\n    <div id=\"titlediv\">\n        <h1 class=\"wp-heading-inline\">Edit slider</h1>\n        <div id=\"titlewrap\">\n            <input placeholder=\"Add slider name\" type=\"text\" ng-model=\"vm.stm_slider.post_title\" size=\"30\" id=\"title\">\n        </div>\n    </div>\n    <uib-tabset class=\"main-tabs\">\n        <uib-tab index=\"0\" select=\"vm.mainTab = 1\">\n            <uib-tab-heading>\n                <i class=\"fa fa-gear\"></i>{{ 'SETTINGS' | translate}}\n            </uib-tab-heading>\n            <div class=\"stm-slider-settings__body\">\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Slider Source' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input id=\"source_posts\" value=\"posts\" type=\"radio\" ng-model=\"vm.stm_sliderMeta.source\"\n                                       name=\"slider_source\">\n                                <label for=\"source_posts\" ng-bind=\"'Posts' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\">\n                                <input id=\"source_custom\" value=\"custom\" type=\"radio\"\n                                       ng-model=\"vm.stm_sliderMeta.source\" name=\"slider_source\">\n                                <label for=\"source_custom\" ng-bind=\"'Custom' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\" ng-if=\"vm.stm_sliderMeta.source === 'posts'\">\n                                <input id=\"posts_count\" type=\"text\" ng-model=\"vm.stm_sliderMeta.posts_count\"\n                                       name=\"posts_count\">\n                                <label for=\"posts_count\" ng-bind=\"'Posts count' | translate\"></label>\n                            </div>\n                        </div>\n\n                        <div ng-if=\"vm.stm_sliderMeta.source == 'posts'\">\n                            <div class=\"form-group\">\n                                <div class=\"form-control\">\n                                    <input type=\"text\"\n                                           ng-model=\"vm.slide_post\"\n                                           placeholder=\"Type to select posts\"\n                                           uib-typeahead=\"post as post.name for post in vm.getPosts($viewValue)\"\n                                           typeahead-wait-ms=\"300\"\n                                           typeahead-on-select=\"vm.postSelected($item, $model, $label)\"\n                                           typeahead-min-length=\"0\">\n                                </div>\n                            </div>\n                            <div>\n                                <ul class=\"stm_slider_posts_builder\">\n                                    <li ng-repeat=\"(key, post) in vm.stm_sliderMeta.post_slides\">\n                                        {{post.name}}\n                                        <i ng-click=\"vm.removePost(key)\" class=\"fa fa-close\"></i>\n                                    </li>\n                                </ul>\n                            </div>\n                        </div>\n\n                    </div>\n                </div>\n\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Slider Width' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input id=\"width_px\" value=\"px\" type=\"radio\" ng-model=\"vm.stm_sliderMeta.widthUnit\"\n                                       name=\"widthUnit\">\n                                <label for=\"width_px\" ng-bind=\"'In Pixels (px)' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\">\n                                <input id=\"width_percent\" value=\"percent\" type=\"radio\"\n                                       ng-model=\"vm.stm_sliderMeta.widthUnit\" name=\"widthUnit\">\n                                <label for=\"width_percent\" ng-bind=\"'In Percentage (%)' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\">\n                                <input type=\"text\"\n                                       size=\"{{vm.stm_sliderMeta.width ? vm.stm_sliderMeta.width.length + 1 : 1}}\"\n                                       ng-model=\"vm.stm_sliderMeta.width\">\n                                <label ng-bind=\"vm.stm_sliderMeta.widthUnit === 'px' ? 'px' : '%' | translate\"></label>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Additional settings' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <switcher model=\"vm.stm_sliderMeta.overflow_elements\"></switcher>\n                                <label ng-bind=\"'Show overflowed items' | translate\"></label>\n                            </div>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input id=\"items_in_row\"\n                                       type=\"text\"\n                                       ng-model=\"vm.stm_sliderMeta.items_in_row\"\n                                       name=\"posts_count\">\n                                <label for=\"posts_count\" ng-bind=\"'Items per row' | translate\"></label>\n                            </div>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input id=\"image_size\"\n                                       type=\"text\"\n                                       ng-model=\"vm.stm_sliderMeta.image_size\"\n                                       name=\"posts_count\">\n                                <label for=\"posts_count\" ng-bind=\"'Image size (Example 370x400)' | translate\"></label>\n                            </div>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input id=\"item_margins\" type=\"text\" ng-model=\"vm.stm_sliderMeta.item_margins\"\n                                       name=\"posts_count\">\n                                <label for=\"posts_count\" ng-bind=\"'Item margins' | translate\"></label>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Slider Height' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <input type=\"text\"\n                                       size=\"{{vm.stm_sliderMeta.height ? vm.stm_sliderMeta.height.length + 1 : 1}}\"\n                                       ng-model=\"vm.stm_sliderMeta.height\">\n                                <label>px</label>\n                            </div>\n                        </div>\n\n\n                    </div>\n\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Enable Navigation' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <switcher model=\"vm.stm_sliderMeta.navigation\"></switcher>\n                                <!--<label ng-bind=\"'Hide on Phone' | translate\"></label>-->\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Hide On Mobile' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <switcher model=\"vm.stm_sliderMeta.hideOnMobile\"></switcher>\n                                <label ng-bind=\"'Hide on Phone' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\">\n                                <switcher model=\"vm.stm_sliderMeta.hideOnTablet\"></switcher>\n                                <label ng-bind=\"'Hide on Tablet' | translate\"></label>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Animation' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <stm-dropdown class=\"stm-slider__animation\" options=\"vm.transitions\"\n                                              model=\"vm.stm_sliderMeta.transition\"></stm-dropdown>\n                            </div>\n                            <div class=\"form-control\">\n                                <div class=\"animation-example\">\n                                    <div class=\"example\"\n                                         ng-class=\"vm.stm_sliderMeta.transition ? 'animated ' + vm.stm_sliderMeta.transition : ''\">\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"stm-slider-setting__container\">\n                    <div class=\"stm-slider-setting\">\n                        <div class=\"stm-slider-setting__heading\">\n                            <span ng-bind=\"'Autoplay' | translate\"></span>\n                        </div>\n                        <div class=\"stm-slider-setting__controls\">\n                            <div class=\"form-control\">\n                                <switcher model=\"vm.stm_sliderMeta.autoplay\"></switcher>\n                                <label ng-bind=\"'Enable autoplay' | translate\"></label>\n                            </div>\n                            <div class=\"form-control\" ng-if=\"vm.stm_sliderMeta.autoplay\">\n                                <label for=\"autoplay_duration\" ng-bind=\"'Autoplay Duration' | translate\"></label>\n                                <input id=\"autoplay_duration\"\n                                       size=\"{{vm.stm_sliderMeta.autoplayDuration ? vm.stm_sliderMeta.autoplayDuration.length + 1 : 1}}\"\n                                       type=\"text\" ng-model=\"vm.stm_sliderMeta.autoplayDuration\">\n                                <label ng-bind=\"'ms' | translate\"></label>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n            </div>\n        </uib-tab>\n        <uib-tab index=\"1\" class=\"stm-slider__slides-tab\" select=\"vm.mainTab = 2\"\n                 ng-show=\"vm.stm_sliderMeta.source === 'custom' \">\n            <uib-tab-heading>\n                <i></i>{{ 'SLIDES' | translate }}\n            </uib-tab-heading>\n            <div ui-sortable=\"vm.slidesSortableOptions\" ng-model=\"vm.slides\">\n\n                <uib-tabset type=\"pills\" active=\"vm.currentSlide\" class=\"stm_slides__tabs\">\n\n\n                    <uib-tab ng-repeat=\"slide in vm.slides track by $index\"\n                             select=\"vm.slideTab = $index\"\n                             class=\"stm-slider__slide_tab-heading\"\n                             index=\"$index\">\n                        <uib-tab-heading>\n                            <div class=\"stm_slide__thumb\" style=\"background-image: url({{slide.data.image.url}})\"\n                                 ng-class=\"slide.data.image.url ? '' : 'no_image'\">\n                                <span class=\"spinner is-active\" ng-if=\"!slide.data.image.loaded\"></span>\n                                <div class=\"stm_slide__thumb_control\" ng-if=\"slide.data.image.loaded\">\n                                    <button class=\"stm_slide__copy\"\n                                            ng-click=\"vm.cloneSlide($index)\">\n                                        <i class=\"fa fa-copy\"></i>\n                                    </button>\n                                    <button class=\"stm_slide__delete\"\n                                            ng-click=\"vm.deleteSlide(slide.id, $index)\">\n                                        <i class=\"fa fa-trash-o\"></i>\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"stm_slide__thumb_heading\">\n                                <span class=\"stm_slide__index\" ng-bind=\"$index + 1 + ' Slide'\"></span>\n                            </div>\n                        </uib-tab-heading>\n\n\n                        <div class=\"stm_slide__settings\">\n                            <div class=\"stm_slide__head\">\n                                <div class=\"title\">\n                                    {{slide.order}} Slide\n                                </div>\n\n                                <div class=\"slide-enable\">\n                                    <label ng-bind=\"'Enable Slide' | translate\"></label>\n                                    <switcher model=\"slide.enable\"></switcher>\n                                </div>\n                            </div>\n                            <div class=\"stm_slide__sidebar\">\n                                <div class=\"stm_slide__control-box\">\n                                    <div class=\"stm_slide__bg stm_slide__control\">\n                                        <span class=\"title\" ng-bind=\"'BG image' | translate\"></span>\n                                        <div class=\"stm_slide__bg-thumb\"\n                                             style=\"background-image: url({{slide.data.image.url}})\"\n                                             ng-if=\"slide.data.image.url\">\n                                            <div class=\"bg-thumb__control\" ng-if=\"slide.data.image.url\">\n                                                <button class=\"stm_slide__copy\"\n                                                        ng-click=\"vm.addSlideBackground(slide)\">\n                                                    <i class=\"fa fa-pencil\"></i>\n                                                </button>\n                                                <button class=\"stm_slide__delete\"\n                                                        ng-click=\"vm.deleteSlideBackground(slide)\">\n                                                    <i class=\"fa fa-trash-o\"></i>\n                                                </button>\n                                            </div>\n                                        </div>\n                                        <button class=\"stm_add-slide-bg\" ng-if=\"!slide.data.image.url\"\n                                                ng-click=\"vm.addSlideBackground(slide)\">\n                                            <i class=\"fa fa-plus\"></i>\n                                            <span ng-bind=\"'Add image' | translate\"></span>\n                                        </button>\n                                    </div>\n\n                                    <div class=\"stm_slide__control stm_slide__overlay\">\n                                        <div class=\"heading\">\n                                            <span class=\"title\" ng-bind=\"'Overlay' | translate\"></span>\n                                            <switcher model=\"slide.overlay\"></switcher>\n                                        </div>\n\n                                        <div class=\"stm_slide__overlay-example\">\n                                            <div class=\"transparency_pattern\"></div>\n                                            <div class=\"stm_slide__overlay-color\"\n                                                 style=\"background-color: {{slide.overlayColor}}\"></div>\n                                            <div md-color-picker=\"vm.colorpickerDefaults\" md-color-clear-button=\"false\"\n                                                 md-color-preview=\"false\" ng-model=\"slide.overlayColor\"></div>\n                                        </div>\n                                    </div>\n\n                                    <div class=\"stm_slide__control stm_slide__pattern\">\n                                        <div class=\"heading\">\n                                            <span class=\"title\" ng-bind=\"'Pattern' | translate\"></span>\n                                            <switcher model=\"slide.pattern\"></switcher>\n                                        </div>\n\n                                        <div class=\"transparency_pattern\"\n                                             ng-click=\"vm.addSlidePattern($index)\"\n                                             ng-class=\"slide.data.image.patternUrl ? 'has_pattern' : ''\"\n                                             style=\"{{slide.data.image.patternUrl ? 'background-image: url('+ slide.data.image.patternUrl  +') !important' : ''}}\"></div>\n                                    </div>\n\n                                    <div class=\"stm_slide__control stm_slide__duration\" ng-if=\"1 === 2\">\n                                        <span class=\"title\" ng-bind=\"'Duration (ms)' | translate\"></span>\n                                        <input type=\"text\" ng-model=\"slide.duration\">\n                                        <div class=\"info\">\n                                            <i class=\"fa fa-info-circle\"></i> <span\n                                                ng-bind=\"'1 sec = 1000 ms' | translate\"></span>\n                                        </div>\n\n                                    </div>\n\n                                </div>\n                                <div class=\"stm_slide__control-box\" ng-if=\"vm.stm_sliderMeta.navigation\">\n                                    <h3>Navigation</h3>\n                                    <div class=\"stm_slide__control stm_slide__nav-title\">\n                                        <div class=\"title\" ng-bind=\"'Title' | translate\"></div>\n                                        <input type=\"text\" ng-model=\"slide.thumbnailHeading\">\n                                    </div>\n                                    <div class=\"stm_slide__control stm_slide__nav-title\">\n                                        <div class=\"title\" ng-bind=\"'Content' | translate\"></div>\n                                        <textarea ng-model=\"slide.thumbnailContent\"></textarea>\n                                    </div>\n                                    <div class=\"stm_slide__control stm_slide__nav-title\">\n                                        <icon-picker icon=\"slide.thumbnailIcon\">\n\n                                        </icon-picker>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"stm_slide__main\">\n                                <div class=\"stm_slide__control-box\">\n                                    <div class=\"stm_slide__content-align\">\n                                        <div class=\"title\" ng-bind=\"'Content align' | translate\"></div>\n                                        <content-align model=\"slide.contentAlign\"></content-align>\n                                    </div>\n                                </div>\n\n                                <div class=\"stm_slide__control-box\">\n                                    <div class=\"stm_slide__preview tbc\"\n                                         ng-class=\"slide.data.image.url ? '' : 'no_image'\"\n                                         ng-style=\"vm.preview.style\">\n                                        <div ng-if=\"slide.data.image.url\" class=\"stm_slide__bgi\"\n                                             style=\"background-image: url({{slide.data.image.url}})\">\n                                            <!--<img scale-value ng-src=\"{{slide.data.image.url}}\">-->\n                                        </div>\n\n                                        <div class=\"stm_slide__preview_pattern\"\n                                             ng-if=\"slide.pattern && slide.data.image.patternUrl\"\n                                             style=\"background-image: url({{slide.data.image.patternUrl}})\">\n\n                                        </div>\n\n                                        <div class=\"stm_slide__preview_overlay\"\n                                             style=\"background-color: {{slide.overlayColor}}\" ng-if=\"slide.overlay\">\n\n                                        </div>\n\n                                        <div class=\"stm_slide__preview_content content-{{slide.contentAlign}}\">\n                                            <div class=\"stm_slide__preview_content-block\">\n                                                <slide-element model=\"slide.title\" model-options=\"slide.titleOptions\"\n                                                               placeholder=\"'Add title'\"\n                                                               style=\"font-size: 40px\">\n                                                </slide-element>\n\n                                                <slide-element model=\"slide.content\"\n                                                               model-options=\"slide.contentOptions\"\n                                                               placeholder=\"'Add sub-title'\"\n                                                               style=\"font-size: 24px\">\n\n                                                </slide-element>\n\n                                                <slide-element model=\"slide.button.label\"\n                                                               model-options=\"slide.buttonOptions\"\n                                                               link-url=\"slide.button.link\" placeholder=\"'Add button'\">\n\n                                                </slide-element>\n                                            </div>\n\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n\n\n                        <table class=\"stm_slides-table\">\n                            <tbody>\n                            <tr>\n                                <td>\n                                    <div class=\"settings-block\">\n                                        <h3 ng-bind=\"'SLIDE_BG' | translate\"></h3>\n                                        <div class=\"stm_slide__thumbnail\">\n                                            <img ng-if=\"slide.data.image.url\" height=\"50\"\n                                                 ng-src=\"{{slide.data.image.url}}\">\n                                            <div class=\"stm_slide__thumbnail-overlay\"\n                                                 ng-if=\"slide.data.image.url\">\n                                                <button class=\"btn btn-sm btn-danger\"\n                                                        ng-click=\"slide.data.image.url = ''\">Delete\n                                                </button>\n                                            </div>\n                                            <button class=\"stm_add-slide\" ng-if=\"!slide.data.image.url\"\n                                                    ng-click=\"vm.addSlideBackground(slide)\">\n                                                <i class=\"fa fa-plus\"></i>\n                                                <span ng-bind=\"'Add slide' | translate\"></span>\n                                            </button>\n                                        </div>\n                                    </div>\n                                    <div class=\"stm_slide__control\">\n                                        <div class=\"settings-block\">\n                                            <h3 ng-bind=\"'DURATION' | translate\"></h3>\n                                            <input type=\"text\" ng-model=\"slide.duration\"> <span\n                                                class=\"text-muted\">ms</span>\n                                        </div>\n                                        <div class=\"settings-block\">\n                                            <h3 ng-bind=\"'MISC' | translate\"></h3>\n                                            <label>\n                                                #ID\n                                                <input class=\"form-control\" type=\"text\" ng-model=\"slide.cssId\">\n                                            </label>\n                                            <switcher model=\"slide.hidden\">Hidden</switcher>\n                                        </div>\n                                        <div class=\"settings-block\">\n                                            <h3 ng-bind=\"'OVERLAY' | translate\"></h3>\n                                            <switcher model=\"slide.overlay\">{{'ENABLE_OVERLAY' | translate}}\n                                            </switcher>\n                                            <input ng-if=\"slide.overlay\" ng-model=\"slide.overlayColor\"\n                                                   type=\"text\" colorpicker=\"rgba\">\n                                        </div>\n                                        <div class=\"settings-block\" ng-if=\"vm.stm_sliderMeta.navigation\">\n                                            <h3 ng-bind=\"'NAVIGATION_SETTINGS' | translate\"></h3>\n                                            <label>\n                                                <span ng-bind=\"'THUMB_HEADING' | translate\"></span>\n                                                <textarea rows=\"3\" ng-model=\"slide.thumbnailHeading\"></textarea>\n                                            </label>\n                                            <label>\n                                                <span ng-bind=\"'THUMB_CONTENT' | translate\"></span>\n                                                <textarea rows=\"3\" ng-model=\"slide.thumbnailContent\"></textarea>\n                                            </label>\n\n                                            <div class=\"iconpicker\">\n                                                <label>\n                                                    <span ng-bind=\"'THUMB_ICON' | translate\"></span>\n                                                    <span uib-dropdown-toggle=\"\" class=\"iconpicker__trigger\"\n                                                          ng-click=\"vm.showIconpicker = true\"\n                                                          ng-class=\"slide.thumbnailIcon || 'fa fa-plus'\">\n\n                                                    </span>\n                                                </label>\n                                                <uib-tabset class=\"iconset\" ng-show=\"vm.showIconpicker\">\n                                                    <uib-tab ng-repeat=\"(name, set) in ::vm.icons track by name\">\n                                                        <uib-tab-heading>\n                                                            <div class=\"setname\">{{name}}</div>\n                                                        </uib-tab-heading>\n                                                        <div class=\"icon-search2\">\n                                                            <input type=\"text\" ng-model=\"vm.iconSearch\"\n                                                                   ng-model-options=\"{debounce: 300}\"\n                                                                   ng-change=\"vm.filterIcons(name)\">\n                                                        </div>\n                                                        <div class=\"icon-wrap\"\n                                                             ng-repeat=\"icon in vm.filteredIcons track by icon\">\n                                                            <span ng-class=\"icon\"\n                                                                  ng-click=\"slide.thumbnailIcon = icon; vm.showIconpicker = false\"></span>\n                                                        </div>\n                                                        <span ng-if=\"!vm.filteredIcons\">Icons not found</span>\n                                                    </uib-tab>\n                                                </uib-tabset>\n                                            </div>\n                                        </div>\n                                    </div>\n                                </td>\n                                <td>\n                                    <h3>Preview</h3>\n                                    <div class=\"stm_slide__image\">\n                                        <img class=\"img-responsive\" ng-src=\"{{slide.data.image.url}}\">\n                                    </div>\n                                </td>\n                            </tr>\n                            <tr>\n                                <td colspan=\"2\" class=\"stm_slide__content\">\n                                    <h3>Slider content</h3>\n                                    <div class=\"stm_slide__title stm_slide__content-control\">\n                                        <label>\n                                            Title\n                                            <textarea type=\"text\" ng-model=\"slide.title\" rows=\"10\"></textarea>\n                                        </label>\n                                    </div>\n\n                                    <div class=\"stm_slide__text stm_slide__content-control\">\n                                        <label>\n                                            Content\n                                            <textarea type=\"text\" ng-model=\"slide.content\" rows=\"10\"></textarea>\n                                        </label>\n                                    </div>\n\n                                    <div class=\"stm_slide__text stm_slide__content-control\">\n                                        <label>\n                                            Button text\n                                            <input type=\"text\" ng-model=\"slide.button.label\">\n                                        </label>\n                                        <label>\n                                            Button link\n                                            <input type=\"text\" ng-model=\"slide.button.link\">\n                                        </label>\n\n                                        <label>\n                                            Content align\n                                            <select ng-model=\"slide.contentAlign\">\n                                                <option value=\"left\">Left</option>\n                                                <option value=\"center\">Center</option>\n                                                <option value=\"right\">Right</option>\n                                            </select>\n                                        </label>\n                                    </div>\n                                </td>\n                            </tr>\n                            </tbody>\n                        </table>\n                    </uib-tab>\n                    <button class=\"stm_add-slide\" ng-if=\"!slide.data.image.url\"\n                            ng-click=\"vm.addSlide()\">\n                        <i class=\"fa fa-plus\"></i>\n                        <span ng-bind=\"'Add slide' | translate\"></span>\n                    </button>\n                </uib-tabset>\n            </div>\n        </uib-tab>\n    </uib-tabset>\n\n\n    <div class=\"stm_save__slider\">\n        <button class=\"stm_slider-save\" ng-click=\"vm.saveSlider()\">\n            Save slider\n        </button>\n        <span ng-if=\"vm.sliderSavingState\" class=\"spinner is-active\"></span>\n    </div>\n\n</div>\n\n\n");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('content-align/content-align.directive.html',
        "<div class=\"stm_content_align\">\n    <div class=\"stm_align__button-wrapper stm_align_{{align}}\"\n         ng-class=\"$parent.model === align ? 'active' : ''\"\n         ng-repeat=\"align in aligns track by $index\">\n        <div class=\"stm_align__button\" ng-click=\"$parent.model = align\">\n            <div class=\"icon-wrapper\">\n                <span></span><span></span><span></span>\n            </div>\n        </div>\n        <div class=\"label\" ng-bind=\"align | translate\"></div>\n    </div>\n</div>\n");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('icon-picker/icon-picker.directive.html',
        "<div class=\"stm_iconpicker__icon_picker\">\n    <div>\n        <div class=\"stm_iconpicker__open-icons\" ng-click=\"vm.showList = !vm.showList\">\n            <i ng-class=\"(vm.scope.icon) ? vm.scope.icon : 'fa fa-plus'\" class=\"select-icon\"></i>\n            Select Icon\n        </div>\n    </div>\n    <div class=\"stm_iconpicker__list\" ng-show=\"vm.showList\">\n        <uib-tabset>\n            <uib-tab ng-repeat=\"setName in vm.iconsSetsNames\" select=\"vm.changeSetName(setName)\">\n                <div class=\"stm_iconpicker__search\">\n                    <label ng-bind=\"'Search' | translate\"></label>\n                    <input type=\"text\" ng-model=\"vm.iconSearch\" ng-model-options=\"{debounce: 200}\">\n                </div>\n                <uib-tab-heading>\n                    <span ng-bind=\"setName\"></span>\n                </uib-tab-heading>\n                <div class=\"stm_iconpicker__icons\">\n                    <div class=\"stm_iconpicker__icon\" ng-repeat=\"icon in vm.filteredIcons track by $index\" ng-click=\"vm.selectIcon(icon)\">\n                        <i ng-class=\"icon\"></i>\n                    </div>\n                </div>\n            </uib-tab>\n        </uib-tabset>\n    </div>\n</div>\n");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('slide-content/slide-content.directive.html',
        "<div class=\"stm_slide__element\" ng-class=\"vm.scope.modelOptions.align ? 'align-' + vm.scope.modelOptions.align : ''\">\n    <text-settings-panel></text-settings-panel>\n\n    <style ng-if=\"vm.scope.modelOptions.ff\">\n        @import url('https://fonts.googleapis.com/css?family={{modelOptions.ff.replace(\" \", \"+\")}}:400,700');\n    </style>\n\n    <style>\n        #slide-content-{{::$id}} {\n            {{vm.scope.modelOptions.fsz && vm.scope.modelOptions.fsz !== 'Default' ? 'font-size:' + vm.scope.modelOptions.fsz + 'px;' : ''}}\n            font-weight: {{vm.scope.modelOptions.fw ? 'bold' : 'normal'}};\n            {{vm.scope.modelOptions.ff && vm.scope.modelOptions.ff !== 'Default' ? 'font-family:' + vm.scope.modelOptions.ff + ';' : ''}}\n            text-decoration: {{vm.scope.modelOptions.fu ? 'underline' : 'none'}};\n            font-style: {{vm.scope.modelOptions.fi ? 'italic' : 'normal'}};\n            color: {{vm.scope.modelOptions.color ? vm.scope.modelOptions.color : '#fff'}};\n        }\n    </style>\n\n    <textarea ng-model=\"vm.scope.model\"\n              id=\"slide-content-{{::$id}}\"\n              ta-autosize\n              placeholder=\"{{vm.scope.placeholder}}\"\n              rows=\"1\"\n              ng-class=\"vm.scope.model.length > 0 ? 'has_content' : ''\">\n    </textarea>\n</div>");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('stm-dropdown/stm-dropdown.directive.html',
        "<div class=\"stm-dropdown\" ng-class=\"showList ? 'opened' : ''\" >\n    <div class=\"stm-dropdown__value\" ng-click=\"showList = !showList\">\n        <input ng-keydown=\"modelSelected = false\" type=\"text\" ng-model=\"label\" ng-disabled=\"!filter\" ng-model-options=\"{debounce: 200}\">\n    </div>\n    <div class=\"stm-dropdown__list\" ng-show=\"showList\">\n        <div class=\"stm-dropdown__option\" ng-repeat=\"(key, value) in filteredOptions track by $index\" ng-click=\"selectOption(key, value)\" ng-if=\"value\">\n            {{value}}\n        </div>\n    </div>\n</div>");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('switcher/switcher.directive.html',
        "<span ng-transclude></span>\n<input id=\"switcher-{{$id}}\" type=\"checkbox\" ng-model=\"model\">\n<label for=\"switcher-{{$id}}\"></label>");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('text-settings-panel/text-settings-panel.directive.html',
        "<div class=\"stm_text-settings-panel\">\n    <div class=\"font-select panel-unit\">\n        <stm-dropdown options=\"vm.fontNames\" filter=\"true\" model=\"vm.scope.modelOptions.ff\"></stm-dropdown>\n    </div>\n    <div class=\"font-size panel-unit\">\n        <stm-dropdown options=\"vm.fontSizes\" filter=\"true\" model=\"vm.scope.modelOptions.fsz\"\n                      callback=\"vm.adjustTa()\"></stm-dropdown>\n    </div>\n    <div class=\"font-style panel-unit\">\n        <div class=\"font-weight font-style__unit\">\n            <input id=\"fw-{{::$id}}\" type=\"checkbox\" ng-model=\"vm.scope.modelOptions.fw\">\n            <label for=\"fw-{{::$id}}\">B</label>\n        </div>\n        <div class=\"font-italic font-style__unit\">\n            <input id=\"fsi-{{::$id}}\" type=\"checkbox\" ng-model=\"vm.scope.modelOptions.fi\">\n            <label for=\"fsi-{{::$id}}\">I</label>\n        </div>\n        <div class=\"font-underline font-style__unit\">\n            <input id=\"fsu-{{::$id}}\" type=\"checkbox\" ng-model=\"vm.scope.modelOptions.fu\">\n            <label for=\"fsu-{{::$id}}\">U</label>\n        </div>\n    </div>\n    <div class=\"text-color panel-unit\">\n        <div md-color-picker=\"colorpickerDefaults\" md-color-clear-button=\"false\" ng-model=\"vm.scope.modelOptions.color\"></div>\n        <span class=\"clear-color\" ng-click=\"vm.scope.modelOptions.color = ''\">\n            <i class=\"fa fa-close\"></i>\n        </span>\n    </div>\n\n    <div class=\"text-align panel-unit\">\n        <input id=\"text-align-left-{{::$id}}\" type=\"radio\" name=\"text-align\" class=\"left\" value=\"left\" ng-model=\"vm.scope.modelOptions.align\">\n        <label for=\"text-align-left-{{::$id}}\">\n            <span></span><span></span><span></span>\n        </label>\n\n        <input id=\"text-align-center-{{::$id}}\" type=\"radio\" name=\"text-align\" class=\"center\" value=\"center\" ng-model=\"vm.scope.modelOptions.align\">\n        <label for=\"text-align-center-{{::$id}}\">\n            <span></span><span></span><span></span>\n        </label>\n\n        <input id=\"text-align-right-{{::$id}}\" type=\"radio\" name=\"text-align\" class=\"right\" value=\"right\" ng-model=\"vm.scope.modelOptions.align\">\n        <label for=\"text-align-right-{{::$id}}\">\n            <span></span><span></span><span></span>\n        </label>\n    </div>\n    <div class=\"link panel-unit\" ng-if=\"vm.scope.linkUrl.length >= 0\">\n        <i class=\"fa fa-link\" ng-click=\"vm.showLinkInput = !vm.showLinkInput\"></i>\n        <div class=\"link__input\" ng-show=\"vm.showLinkInput\">\n            <input type=\"text\" ng-model=\"vm.scope.linkUrl\">\n            <div class=\"confirm\" ng-click=\"vm.showLinkInput = false\">\n                <i class=\"fa fa-check\"></i>\n            </div>\n        </div>\n    </div>\n</div>");
}]);
angular.module('app.templates').run(['$templateCache', function($templateCache) {
    $templateCache.put('transitions/transitions.directive.html',
        "\n{{model}}\n<label>\n    <span>Select transition type</span>\n    <select class=\"form-control\" ng-model=\"transitionType\">\n        <option value=\"{{type}}\"  ng-repeat=\"(type, list) in transitions track by $index\">{{type}}</option>\n    </select>\n</label>\n\n<label ng-if=\"transitionType\">\n    <span>Select transition</span>\n    <select class=\"form-control\" ng-model=\"model\">\n        <option value=\"{{anim}}\" ng-repeat=\"anim in transitions[transitionType] track by $index\">{{anim}}</option>\n    </select>\n</label>");
}]);