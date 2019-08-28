(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SliderOperations = exports.SliderOperations = function () {
    function SliderOperations() {
        _classCallCheck(this, SliderOperations);

        this.$ = jQuery;
    }

    _createClass(SliderOperations, [{
        key: 'createNew',
        value: function createNew() {

            this.$.ajax({
                url: ajaxurl,
                data: {
                    action: 'stm_slider_ajax',
                    create: 'slider'
                },
                success: function success(res) {
                    console.log(res);
                    if (res.status === 200) {
                        window.location = window.location + '&action=edit&slider_id=' + res.data;
                    }
                }

            });
        }
    }, {
        key: 'delete',
        value: function _delete($id) {
            this.$.ajax({
                url: ajaxurl,
                data: {
                    action: 'stm_slider_ajax',
                    delete: $id
                },
                success: function success(res) {
                    console.log(res);
                    if (res.status === 200) {
                        window.location.reload();
                    }
                }

            });
        }
    }]);

    return SliderOperations;
}();

},{}],2:[function(require,module,exports){
'use strict';

var _classSlider = require('./class.slider.operations');

(function ($) {
    _classSlider.SliderOperations.prototype.baseUrl = stm_slider_page_url;

    var sliderOperations = new _classSlider.SliderOperations();

    $(document).ready(function () {
        "use strict";

        $('.stm_add_new_slider').click(function (e) {
            "use strict";

            e.preventDefault();
            sliderOperations.createNew();
        });

        $('.stm_delete_slider').click(function (e) {
            e.preventDefault();

            var id = $(this).data('slider-id');
            var allow = false;

            allow = confirm('Are you want to delete this slider?');

            if (!allow) {
                return;
            }
            location.href = $(this).attr('href');

            // sliderOperations.delete(id);
        });
    });
})(jQuery);

},{"./class.slider.operations":1}]},{},[2]);
