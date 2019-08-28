<?php
wp_enqueue_script('imagesloaded');
wp_enqueue_script('isotope.js');
wp_enqueue_script('lightgallery.js');
wp_enqueue_style('lightgallery');

$number = (empty(intval($number))) ? pearl_posts_per_page() : $number;

$args = array(
	'post_type'      => 'stm_video',
	'posts_per_page' => $number,
	'post_status'    => 'publish'
);

$q = new WP_Query($args);

if ($q->have_posts()):
	$found_posts = $q->found_posts;
	ob_start();
	pearl_load_vc_element('video', array(), 'filter-js');
	$custom_js = str_replace(array('<script type="text/javascript">', '</script>'), '', ob_get_clean());
	wp_add_inline_script('pearl-theme-scripts', $custom_js);

	$taxonomy = pearl_get_post_type_taxonomy('stm_video');
	?>


	<!--Categories-->
	<div class="stm_flex stm_flex_last stm_flex_center stm_video_list__top">
		<?php $categories = get_terms('video_category');
		if (!empty($categories) and !is_wp_error($categories)): ?>
			<ul class="stm_video_list__filter heading_font js_active_switcher">
				<?php $i = 0;
				foreach ($categories as $category):
					$i++;
					$active = ($i === 1) ? 'active' : '';
					?>

					<li class="text-uppercase">
						<a href="#"
						   class="no_deco ttc mtc_h js_active_switcher__a <?php echo esc_attr($active); ?>"
						   data-category=".<?php echo esc_attr($taxonomy . '-' . $category->slug); ?>">
							<?php echo sanitize_text_field($category->name); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php get_template_part('partials/content/post/single/_share'); ?>

	</div>

	<!--Content-->
	<div class="vc_container-fluid-force stm_video_list__content tbc wtc">
		<div class="container">
			<?php while ($q->have_posts()): $q->the_post(); ?>
				<?php
				$id = get_the_ID();
				$img_size = '1150x485';
				$url = pearl_generate_youtube(get_post_meta($id, 'video_url', true));
				$label = get_post_meta($id, 'video_label', true);
				?>
				<div <?php post_class('stm_video_list__single'); ?>>
					<h4 class="wtc">
						<?php the_title(); ?>
						<?php if (!empty($label)): ?><span class="mtc"> / <?php echo sanitize_text_field($label); ?></span><?php endif; ?>
					</h4>
					<div class="inner tbc">
						<?php if (!empty($url)): ?>
							<a href="<?php echo esc_url($url); ?>" class="play-video stm_lightgallery__iframe mbc_b"
							   data-iframe="true">
							</a>
							<div class="stm_video_list_overlay"></div>
						<?php endif; ?>
						<?php echo html_entity_decode(pearl_get_VC_post_img_safe($id, $img_size, 'full')); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<?php if ($found_posts > $number): ?>
			<!--Load more-->
			<a href="#"
			   class="btn btn_primary btn_outline btn_load"
			   data-number="<?php echo intval($number) ?>"
			   data-style="<?php echo esc_js($style) ?>"
			   data-path="video"
			   data-offset="<?php echo intval($number) ?>">
				<span><?php esc_html_e('Load more', 'pearl'); ?></span>
			</a>
		<?php endif; ?>
	</div>

	</div>
<?php endif; ?>


