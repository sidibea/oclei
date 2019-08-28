<script type="text/javascript">
	(function ($) {

	    if(typeof imagesLoaded == 'function') {
            $('.stm_projects_cards_style_1').imagesLoaded(function () {
                stm_owl_load();
            });
        } else {
            $(window).load(function(){
                stm_owl_load();
            });
        }

		function stm_owl_load(){
            var carousel;
            var buttonHidden = false;
            var $carousel = $('.stm_projects_cards_style_1 .inner');
            var $btn = $('.stm_projects_cards_style_1 .btn');
            var loading = false;
            var owlRtl = false;
            if ($('body').hasClass('rtl')) {
                owlRtl = true;
            }

            preloader_position();

            var fixOwl = function () {
                var $stage = $('.stm_projects_cards_style_1 .owl-stage'),
                    stageW = $stage.width(),
                    $el = $('.stm_projects_cards_style_1').find('.owl-item'),
                    elW = 0;
                $el.each(function () {
                    var elWidth = parseFloat($(this).width());
                    var elMargins = parseFloat(($(this).css("margin-right").slice(0, -2)));
                    elW += elWidth + elMargins;
                });
                if (elW > stageW) {
                    $stage.width(elW);
                }
            };

            carousel = $carousel.owlCarousel({
                rtl: owlRtl,
                margin: 10,
                autoWidth: true,
                items: 4,
                onInitialized: fixOwl,
                onRefreshed: fixOwl,
                responsive: {
                    0: {
                        items: 1,
                    },
                    550:{
                        items: 2
                    },
                    768:{
                        items: 2
                    },
                    1100:{
                        items: 3
                    },
                    1400:{
                        items: 4
                    }
                }
            }).on('changed.owl.carousel', function (e) {
                if(!buttonHidden) {
                    $('.stm_projects_cards__hint').slideUp();
                    buttonHidden = true;
                }

                var count = parseFloat(e.item.count);
                var currentSlide = (parseFloat(e.item.index) + 1);

                fixOwl();
                carousel.trigger('refresh.owl.carousel');

                if(count - currentSlide > 2 && !loading) {
                    var offset = $btn.attr('data-offset');
                    var number = $btn.attr('data-number');
                    var total = $btn.attr('data-total');
                    $.ajax({
                        url: stm_ajaxurl,
                        dataType: 'json',
                        context: this,
                        data: {
                            'style' : 'style_1',
                            'offset' : offset,
                            'number' : number,
                            'total' : total,
                            'action': 'pearl_load_portfolio'
                        },
                        beforeSend: function () {
                            $(this).addClass('loading');
                            loading = true;
                            $('.stm_projects_cards__preloader').addClass('active');
                        },
                        complete: function (data) {
                            $('.stm_projects_cards__preloader').removeClass('active');
                            loading = false;
                            var dt = data.responseJSON;
                            if(dt.content.length) {
                                var items = dt.content;
                                items = items.split('stm_splitter');
                                items.pop();

                                items.forEach(function(item){
                                    carousel.trigger('add.owl.carousel', [item]).trigger('refresh.owl.carousel');
                                });

                                carousel.trigger('refresh.owl.carousel');
                            }

                            $btn.attr('data-offset', dt.offset);

                            if(dt.offset > total) {
                                $btn.remove();
                                loading = true;
                            }

                            $(this).removeClass('loading');
                        }
                    });
                }
            });

            function preloader_position() {
                var wW = window.innerWidth;
                var cW = $carousel.width();

                var rightPos = ( (wW - cW) / 2 ) / 2;

                $('.stm_projects_cards__preloader').css('right', '-' + rightPos + 'px');

            }
        }
	})(jQuery)
</script>