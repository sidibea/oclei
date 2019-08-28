<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
			var loadOnScroll = false;
			var $container = $('.stm_projects_cards_style_4 .inner');
			var $button = $('.stm_projects_cards_style_4 .btn');
			var isotopeOptions = {
				itemSelector: '.stm_projects_card',
				layoutMode: 'packery'
			};

			$container.isotope(isotopeOptions);

			$('.stm_projects_cards_style_4 .stm_projects_cards__filter a').on('click', function (e) {
				e.preventDefault();
				var category = $(this).data('category');

				if (category == '*') {
					$button.show();
				} else {
					$button.hide();
				}

				$container.isotope({
					filter: category,
				}).isotope('layout');
			});

			$('.stm_projects_cards_style_4').on('click', '.btn', function(e){
				if($(this).hasClass('loading')) {
					return;
				}
				loadOnScroll = true;
				$(this).addClass('infinite');
				e.preventDefault();
				var offset = $(this).attr('data-offset');
				var number = $(this).attr('data-number');
				var total = $(this).attr('data-total');
				$.ajax({
					url: stm_ajaxurl,
					dataType: 'json',
					context: this,
					data: {
						'style' : 'style_4',
						'offset' : offset,
						'number' : number,
						'total' : total,
						'action': 'pearl_load_portfolio'
					},
					beforeSend: function () {
						$(this).addClass('loading');
					},
					complete: function (data) {
						var dt = data.responseJSON;
						if(dt.content.length) {
							var $cont = $(this).closest('.stm_projects_cards_style_4').find('.inner');
							var $items = $(dt.content);

							$cont.append($items).isotope('appended', $items, false);
						}

						$(this).attr('data-offset', dt.offset);

						if(dt.offset > total) {
							$(this).remove();
						}

						$(this).removeClass('loading');
					}
				});
			});

			var startcounting;
			$(window).on('scroll', function(){
				var $btn = $('.stm_projects_cards_style_4 .btn');
				if(loadOnScroll && $btn.length) {
					var scrollBottom = $(window).scrollTop() + $(window).height();
					var btnPositon = $btn.offset().top;
					if(scrollBottom > btnPositon) {
						clearTimeout(startcounting);
						startcounting = setTimeout(function() {
							$btn.click();
						}, 300);
					}
				}
			})

		});
	})(jQuery)
</script>