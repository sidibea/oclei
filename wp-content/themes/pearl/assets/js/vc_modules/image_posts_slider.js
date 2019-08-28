'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function ($) {
    var PearlImagesPostSlider = function () {
        function PearlImagesPostSlider(element) {
            _classCallCheck(this, PearlImagesPostSlider);

            this.slider = $(element);
            this.sliderWrapper = this.slider.find('.slider__wrapper');
            this.backdrop = this.slider.find('.slider__backdrop');
            this.thumbnail = this.slider.find('.slider__thumbnail');
            this.sliderParent = this.slider.parent();
            this.sliderPrevEl = this.slider.prev();
            this.closeButton = this.slider.find('.slider__close');
            this.carousel = this.slider.find('.slider__images');
            this.titlesContainer = this.slider.find('.slider__image_titles');
            this.titleContainer = $('<div class="slider__image_title h3"></div>');
            this.textsContainer = this.slider.find('.slider__image_texts');
            this.textContainer = $('<div class="slider__image_text"></div>');
            this.navContainer = '.slider__arrows';
            this.counterContainer = this.slider.find('.slider__counter');
            this.translations = window.pearl_image_posts_slider_translations;
            this.lightbox = this.slider.find('.slider__lb');
            this.lightboxMoved = false;
            this.currentImage = '';
            this.owlOptions = {
                items: 1,
                loop: true,
                dots: true,
                navContainer: this.navContainer,
                nav: true,
                navText: ['', ''],
                slideBy: 1
            };
            this.transition = 500;

            this.init();
        }

        _createClass(PearlImagesPostSlider, [{
            key: 'init',
            value: function init() {
                this.preEvents();
                this.carousel = this.carousel.owlCarousel(this.owlOptions);
                this.carouselData = this.carousel.data('owlCarousel');
                this.items = this.carouselData._items;
                this.lightbox.hide();
                this.postEvents();
            }
        }, {
            key: 'preEvents',
            value: function preEvents() {
                var _this2 = this;

                if (this.carousel) {
                    this.carousel.on('translated.owl.carousel', function (e) {
                        var image = _this2.getImageFromEvent(e);
                        _this2.currentImage = image;
                        var title = _this2.addContent(image);
                        _this2.addCounter(e);
                        _this2.setActiveThumbnail(e);
                    }).on('initialized.owl.carousel', function (e) {
                        var image = _this2.getImageFromEvent(e);
                        _this2.currentImage = image;
                        _this2.addContent(image);
                        _this2.addCounter(e);
                        _this2.setActiveThumbnail(e);
                    });
                }
            }
        }, {
            key: 'postEvents',
            value: function postEvents() {
                var _this3 = this;

                var _this = this;

                this.slider.find('.owl-item').click(function () {
                    if (!_this3.slider.hasClass('fullscreen') && window.innerWidth > 1024) {
                        _this3.openLightbox();
                    }
                });

                $(document).keyup(function (e) {
                    if (_this.slider.hasClass('fullscreen') && e.keyCode === 27) {
                        _this.closeLightbox();
                    }
                });
                this.backdrop.click(function () {
                    _this3.closeLightbox();
                });

                this.thumbnail.click(function () {
                    _this.carousel.trigger('to.owl.carousel', $(this).index());
                });

                this.closeButton.click(function () {
                    _this.closeLightbox();
                });
            }
        }, {
            key: 'setActiveThumbnail',
            value: function setActiveThumbnail(e) {
                var currentIndex = e.page.index;
                this.thumbnail.removeClass('active').eq(currentIndex).addClass('active');
            }
        }, {
            key: 'openLightbox',
            value: function openLightbox() {
                $('body').css({
                    'overflow': 'hidden'
                });
                this.slider = this.slider.appendTo('body').addClass('fullscreen');
                this.carouselData.onResize();
            }
        }, {
            key: 'closeLightbox',
            value: function closeLightbox() {
                if (this.sliderPrevEl.length > 0) {
                    this.slider.insertAfter(this.sliderPrevEl).removeClass('fullscreen');
                } else {
                    this.slider = this.slider.appendTo(this.sliderParent).removeClass('fullscreen');
                }
                $('body').css({
                    'overflow': 'visible'
                });
                this.carouselData.onResize();
            }
        }, {
            key: 'getImageTitle',
            value: function getImageTitle(image) {
                return image.data('title');
            }
        }, {
            key: 'getImageText',
            value: function getImageText(image) {
                return image.data('text');
            }
        }, {
            key: 'getImageFromEvent',
            value: function getImageFromEvent(e) {
                return $(e.target).find('.owl-item').eq(e.item.index).find('.slider_image');
            }
        }, {
            key: 'getCurrentImageNumber',
            value: function getCurrentImageNumber(e) {
                return e.page.index + 1;
            }
        }, {
            key: 'getTotalImagesCount',
            value: function getTotalImagesCount(e) {
                return e.page.count;
            }
        }, {
            key: 'addCounter',
            value: function addCounter(e) {
                var imageNumber = this.getCurrentImageNumber(e);
                var imagesTotal = this.getTotalImagesCount(e);
                var str = imageNumber + ' ' + this.translations.of + ' ' + imagesTotal;
                this.counterContainer.text(str);
                this.lightbox.find('.slider__counter').text(str);
            }
        }, {
            key: 'addContent',
            value: function addContent(image) {
                var title = this.getImageTitle(image);
                var text = this.getImageText(image);
                var titleContainer = this.titleContainer.clone();
                var textContainer = this.textContainer.clone();

                var oldTitle = this.titlesContainer.find('.slider__image_title');
                var oldText = this.textsContainer.find('.slider__image_text');

                oldText.remove();
                oldTitle.remove();
                textContainer.text(text).appendTo(this.textsContainer).hide().fadeIn(this.transition);
                titleContainer.text(title).attr('title', title).appendTo(this.titlesContainer).hide().fadeIn(this.transition);
            }
        }]);

        return PearlImagesPostSlider;
    }();

    $.fn.PearlImagePostsSlider = function () {
        this.each(function () {
            var slider = new PearlImagesPostSlider(this);
        });
    };

    $(document).ready(function () {
        $('.stm_image_posts_slider').PearlImagePostsSlider();
    });
})(jQuery);