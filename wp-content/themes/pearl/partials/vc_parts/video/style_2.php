<?php

wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_style('owl-carousel2');

wp_enqueue_script('lightgallery.js');
wp_enqueue_style('lightgallery');


$number = (empty(intval($number))) ? pearl_posts_per_page() : $number;


$args = array(
	'post_type'      => 'stm_video',
	'posts_per_page' => $number,
	'post_status'    => 'publish'
);

$q = new WP_Query($args);

if ($q->have_posts()) : ?>
	<div class="stm_video_list__wrapper">
		<div class="stm_video_list__title">
		<span class="h1">
		<?php echo esc_html($title); ?>
		</span>
		</div>
		<div class="stm_video_list__carousel">

			<?php
			while ($q->have_posts()) : $q->the_post();
				$id = get_the_ID();
				$img_size = empty($img_size) ? 'full' : $img_size;
				$url = pearl_generate_youtube(get_post_meta($id, 'video_url', true));
				$label = get_post_meta($id, 'video_label', true);
				?>

				<div <?php post_class('stm_video_list__single'); ?>>
					<?php if (!empty($url)): ?>
						<a href="<?php echo esc_url($url); ?>" class="play-video stm_lightgallery__iframe mbdc_b_h mbdc_a_h"
						   data-iframe="true"></a>
					<?php endif; ?>
					<?php echo html_entity_decode(pearl_get_VC_post_img_safe($id, $img_size, 'full', false, false)); ?>

					<?php if (!empty($label)) : ?>
					<div data-label="<?php echo esc_html($label); ?>"></div>
					<?php endif; ?>
				</div>


			<?php endwhile; ?>
		</div>
		<div class="stm_video_list__label"></div>
	</div>

<?php endif; ?>

<script>
	(function ($) {



		$(document).ready(function () {
			var owlOptions = {
				'items': 1,
				'loop': true,
				'dots': true,
			};

			var carousel = $('.stm_video_list__carousel');

			var labelHolder = $('.stm_video_list__label');
			carousel.owlCarousel(owlOptions);
			carousel.on('translate.owl.carousel', function (e) {
				labelHolder.css({opacity: 0});
			});
			labelcontrol();


			carousel.on('translated.owl.carousel', function (e) {
				labelcontrol();
			});

			function labelcontrol(label, elem) {
				var label = $('.stm_video_list__carousel').find('.owl-item.active [data-label]').data('label');
				labelHolder.html(label).css({opacity: 1});
			}

		})
	})(jQuery);
</script>


