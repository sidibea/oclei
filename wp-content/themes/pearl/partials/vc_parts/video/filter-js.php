<script type="text/javascript">
	(function ($) {
		var id = ".stm_video_list__masonry";
		var $id = $(id + ' .stm_video_list__content .container');
		var tab = id + ' .stm_video_list__filter li a';
		var $tab = $(tab);
		var single_item = $(id + ' .stm_video_list__single');
		var button = id + ' .btn_load';
		var isotopeOptions = {};
		var removeButton = false;

		$(window).load(function(){
			/*click on first to load images only for this category*/
			$('.stm_video_list_style_1 .stm_video_list__filter li .active').click();
		});


		$(document).ready(function () {

			init_isotope();

			/*Filter isotope on click*/
			$tab.on('click', function (e) {
				e.preventDefault();
				var category = $(this).data('category');

				if (category == '*') {
					$(button).show();
				} else {
					$(button).hide();
				}

				$id.isotope({
					filter: category,
				}).isotope('layout');

			});

			/*AJAX*/
			$('body').on('click', button, function (e) {
				e.preventDefault();

				var offset = $(this).attr('data-offset');
				var number = $(this).attr('data-number');
				var path = $(this).attr('data-path');
				var style = $(this).attr('data-style');

				$.ajax({
					url: stm_ajaxurl,
					dataType: 'json',
					context: this,
					data: {
						'offset': offset,
						'number': number,
						'style': style,
						'path': path,
						'post_type': 'stm_video',
						'action': 'pearl_load_post_type_gallery'
					},
					beforeSend: function () {
						$(this).addClass('loading');
					},
					complete: function (data) {
						var dt = data.responseJSON;
						var $items = $(dt.content);

						$id.append($items).isotope('appended', $items, false);

						init_isotope();

						if (dt.offset) {
							$(this).attr('data-offset', dt.offset);
						} else {
							removeButton = true;
						}
					}
				});
			});
		});

		function init_isotope() {
			$id.imagesLoaded({}, function () {
				$id.find(single_item).removeClass('loading');
				$id.removeClass('stm_projects_grid__loading');
				$id.isotope(isotopeOptions);
				$(button).removeClass('loading');

				if (removeButton) $(button).slideUp('fast', function () {
					$(this).remove()
				});

				stm_light_gallery(true);
			});
		}

	})(jQuery);
</script>