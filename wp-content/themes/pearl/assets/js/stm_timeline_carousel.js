'use strict';

(function ($) {
    "use strict";

    $(document).ready(function () {
        var style = 'style_3';
        var el = $('.stm_posts-timeline_' + style);
        var container = {
            images: el.find('.stm_posts-timeline__images').find('.images__carousel'),
            content: el.find('.stm_posts-timeline__content')
        };

        el.each(function () {
            var data = $(this).data();
            var posts = false;

            var owlArgs = {
                dots: false,
                items: 1,
                nav: true,
                responsive: {
                    1024: {
                        items: 3
                    }
                }
            };

            if (data.posts !== 'undefined') {
                posts = data.posts;
            }

            if (!posts) {
                return;
            }
            posts.forEach(function (data) {
                var imageWrapper = $('<div></div>');
                var yearWrapper = $('<div class="content__year heading_font stc"></div>');
                var image = $(data.image);
                var year = data.year;

                yearWrapper.html(year);
                imageWrapper.addClass(data.class.join(' '));
                imageWrapper.append(image).append(yearWrapper);
                container.images.append(imageWrapper);
            });

            var carouselData = {};
            if (window.innerWidth > 1024) {
                container.images.append($('<div></div>')).prepend($('<div></div>'));
            }

            container.images.on('initialized.owl.carousel', function (e) {
                updateInfo(e);
                arrowsControl(e);
                container.images.find('.owl-item').eq(e.item.index + 1).addClass('current');
            });

            container.images.owlCarousel(owlArgs);
            carouselData = container.images.data('owlCarousel');

            container.images.on('translate.owl.carousel', function (e) {
                updateInfo(e);
                updateOverlay(e);
                arrowsControl(e);
            });

            function updateInfo(e) {
                var index = e.item.index;
                var currentPost = posts[index];

                var info = {
                    title: currentPost.title,
                    content: currentPost.excerpt
                };
                container.content.html('');

                for (var infoKey in info) {
                    var infoEl = $('<div></div>');
                    var htmlClass = 'content__' + infoKey;

                    var classes = {
                        title: 'heading_font',
                        content: ''
                    };
                    htmlClass += ' ' + classes[infoKey];

                    infoEl.addClass(htmlClass);
                    infoEl.html(info[infoKey]);
                    container.content.append(infoEl);
                }
            }
            function updateOverlay(e) {
                var slides = carouselData._items;
                var currentIndex = e.item.index + 1;
                var currentSlide = $(slides[currentIndex]);

                currentSlide.addClass('current');

                container.images.find('.owl-item').not(currentSlide).each(function () {
                    $(this).removeClass('current');
                });
            }
            function arrowsControl(e) {
                var leftArrow = container.images.find('.owl-prev');
                var rightArrow = container.images.find('.owl-next');
                if (e.item.index === 0) {
                    leftArrow.hide();
                } else {
                    if (leftArrow.is(':visible')) {
                        leftArrow.show();
                    }
                }

                if (e.item.index === e.item.count - 3) {
                    rightArrow.hide();
                } else {
                    if (rightArrow.is(':visible')) {
                        rightArrow.show();
                    }
                }
            }
        });
    });
})(jQuery);