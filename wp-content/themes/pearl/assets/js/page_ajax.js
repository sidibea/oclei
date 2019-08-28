'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function ($) {
    "use strict";

    $(document).ready(function () {
        var options = {};
        new Stm_Page_Load(options);

        $('a').on('click', function (e) {
            var current_href = window.location.href.replace(/\//g, '');
            var href = $(this).attr('href').replace(/\//g, '');
            if (current_href === href) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
})(jQuery);

var Stm_Page_Load = function () {
    function Stm_Page_Load(options) {
        _classCallCheck(this, Stm_Page_Load);

        this.options = options;
        this.oldDoc = this.newDoc = '';

        this.$ = jQuery;

        this.defaultOptions = {
            wrapperId: 'wrapper',
            containerClass: 'site-content',
            ignore: 'stm_lightgallery__selector'
        };

        this.options = Object.assign(this.options, this.defaultOptions);

        this.init();
    }

    _createClass(Stm_Page_Load, [{
        key: 'init',
        value: function init() {
            var $ = this.$;
            if (!$('.' + this.options.containerClass).length) return;
            Barba.Pjax.Dom.wrapperId = this.options.wrapperId;
            Barba.Pjax.Dom.containerClass = this.options.containerClass;
            Barba.Pjax.ignoreClassLink = this.options.ignore;
            Barba.Pjax.ignoreClassLink2 = 'stm_demo_sidebar__layout';

            this.ignoreWpAdminBar();
            Barba.Pjax.start();
            this.getDocs();
            this.newPageReady();
            this.initStateChanged();
            this.transitionCompleted();
        }
    }, {
        key: 'getDocs',
        value: function getDocs() {
            var __this = this;
            var originalFn = Barba.Pjax.Dom.parseResponse;
            Barba.Pjax.Dom.parseResponse = function (response) {
                __this.oldDoc = window.document;
                var parser = new DOMParser();
                __this.newDoc = parser.parseFromString(response, "text/html");

                __this.customJS();
                __this.customCss();
                __this.loadCustomJS();
                __this.bodyClasses();
                __this.updateWpAdminBar();
                __this.navMenu();
                return originalFn.apply(Barba.Pjax.Dom, arguments);
            };
        }
    }, {
        key: 'navMenu',
        value: function navMenu() {
            var $ = this.$;
            var newMenu = $(this.newDoc).find('.stm-navigation');
            if (newMenu.length) {
                $('body .stm-navigation').html(newMenu.html());
            }
        }
    }, {
        key: 'ignoreWpAdminBar',
        value: function ignoreWpAdminBar() {
            var adminBar = this.$('body #wpadminbar');
            if (adminBar.length) {
                this.$('body #wpadminbar').addClass('no-barba');
            }
        }
    }, {
        key: 'updateWpAdminBar',
        value: function updateWpAdminBar() {
            var $ = this.$;
            var newAdmin = $(this.newDoc).find('#wpadminbar');
            if (newAdmin.length) {
                $('body #wpadminbar').html(newAdmin.html()).addClass('no-barba');
            }
        }
    }, {
        key: 'loadInline',
        value: function loadInline() {
            var $ = this.$;
            $('script[type="text/javascript"]').each(function () {
                var text = $(this).text();
                if (text == '') return;
                if (text.substring(7, 12) == 'CDATA') {
                    eval(text.substring(16, text.length - 10));
                } else {
                    eval(text);
                }
            });
        }
    }, {
        key: 'customJS',
        value: function customJS() {
            var __this = this;
            var $ = this.$;
            var oldScript = $(this.oldDoc).find('script[src]');
            var newScript = $(this.newDoc).find('script[src]');
            var loadScript = [];

            var oldScriptsUrls = [];
            var newScriptsUrls = [];

            oldScript.each(function (index, element) {
                var attr = __this.removeVersion($(element).attr('src'));
                oldScriptsUrls.push(attr);
            });

            newScript.each(function (index, element) {
                var attr = __this.removeVersion($(element).attr('src'));
                newScriptsUrls.push(attr);
            });

            loadScript = $(newScriptsUrls).not(oldScriptsUrls).toArray();
            if (loadScript.length) {
                for (var i = 0; i < loadScript.length; i++) {
                    var script = '<script type="text/javascript" src="' + loadScript[i] + '"></script>';
                    $('body').append(script);
                }

                __this.loadInline();
            }

            var newSrcScript = $(this.newDoc).find('script[data-src]');
            newSrcScript.each(function (index, element) {
                var attrSrc = __this.removeVersion($(element).attr('data-src'));
                var srcScript = '<script type="text/javascript" src="' + attrSrc + '"></script>';
                $('body').append(srcScript);
            });
        }
    }, {
        key: 'customCss',
        value: function customCss() {
            var __this = this;
            var $ = this.$;
            var oldStyle = $(this.oldDoc).find('link[rel="stylesheet"]');
            var newStyle = $(this.newDoc).find('link[rel="stylesheet"]');
            var loadStyle = [];

            var oldStyleUrls = [];
            var newStyleUrls = [];

            oldStyle.each(function (index, element) {
                var attr = __this.removeVersion($(element).attr('href'));
                oldStyleUrls.push(attr);
            });

            newStyle.each(function (index, element) {
                var attr = __this.removeVersion($(element).attr('href'));
                newStyleUrls.push(attr);
            });

            loadStyle = $(newStyleUrls).not(oldStyleUrls).toArray();

            if (loadStyle.length) {
                for (var i = 0; i < loadStyle.length; i++) {
                    var style = '<link rel="stylesheet" href="' + loadStyle[i] + '" type="text/css" media="all"/>';
                    $('body').append(style);
                }
            }

            $(this.oldDoc).find('style[type="text/css"]').remove();
            $(this.newDoc).find('style[type="text/css"]').appendTo('head');
        }
    }, {
        key: 'newPageReady',
        value: function newPageReady() {
            var __this = this;
            var $ = __this.$;
            Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container) {
                __this.loadInline();
            });
        }
    }, {
        key: 'initStateChanged',
        value: function initStateChanged() {
            var $ = this.$;
            Barba.Dispatcher.on('initStateChange', function () {
                $('body').addClass('is-loading');
                if (typeof ga === 'function') {
                    ga('send', 'pageview', location.pathname);
                }
            });
        }
    }, {
        key: 'transitionCompleted',
        value: function transitionCompleted() {
            var __this = this;
            var $ = this.$;
            Barba.Dispatcher.on('transitionCompleted', function () {
                $('body').removeClass('is-loading');
                __this.loadCustomJS();
            });
        }
    }, {
        key: 'removeVersion',
        value: function removeVersion(url, parameter) {
            if (typeof parameter == 'undefined') parameter = 'ver';
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {

                var prefix = encodeURIComponent(parameter) + '=';
                var parts = urlparts[1].split(/[&;]/g);

                for (var i = parts.length; i-- > 0;) {
                    if (parts[i].lastIndexOf(prefix, 0) !== -1) {
                        parts.splice(i, 1);
                    }
                }

                url = urlparts[0] + (parts.length > 0 ? '?' + parts.join('&') : "");
                return url;
            } else {
                return url;
            }
        }
    }, {
        key: 'bodyClasses',
        value: function bodyClasses() {
            var $ = this.$;
            var classes = $(this.newDoc).find('body').attr('class');
            $('body').attr('class', classes + ' is-loading');
        }
    }, {
        key: 'loadCustomJS',
        value: function loadCustomJS() {
            initialize();
            if (typeof google !== 'undefined') initGoogleScripts();
            if (typeof pearl_stretch_megamenu_child !== 'undefined') pearl_stretch_megamenu_child();
        }
    }]);

    return Stm_Page_Load;
}();