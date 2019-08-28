<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$post_type = 'stm_media_events';
$view = 'list';

$unique_class = uniqid('stm_media_events');

$classes = array('stm_media_events');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_media_events_' . $style;
$classes[] = (!empty($inverted)) ? 'inverted' : 'not-inverted';
$classes[] = $unique_class;

pearl_add_element_style('media_events', $style);

$posts_per_page = (!empty(intval($posts_per_page))) ? $posts_per_page : pearl_posts_per_page();

$pagination = pearl_check_string($pagination);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (!$pagination) $paged = 1;

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
);

$q = new WP_Query($args);

$img_size = !empty($img_size) ? $img_size : '350x310';

$tpl = 'media_events';

if ($q->have_posts()): ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php while ($q->have_posts()): $q->the_post(); ?>
			<?php pearl_load_vc_element($tpl, $atts, $style); ?>
		<?php endwhile; ?>
    </div>
	<?php


	if ($pagination) {
		echo pearl_pagination(
			array(
				'type'    => 'list',
				'format'  => '?paged=%#%',
				'current' => $paged,
				'total'   => $q->max_num_pages,
			)
		);
	}


	wp_reset_postdata();
endif; ?>