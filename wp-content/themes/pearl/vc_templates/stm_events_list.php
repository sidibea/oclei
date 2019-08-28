<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$post_type = 'stm_events';
$view = 'list';

$uniq = uniqid('stm_events_list');

$classes = array('stm_events_list');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_events_list_' . $style;
$classes[] = (!empty($inverted)) ? 'inverted' : 'not-inverted';

pearl_add_element_style('events', $style);

$posts_per_page = (!empty(intval($posts_per_page))) ? $posts_per_page : pearl_posts_per_page();

$pagination = pearl_check_string($pagination);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (!$pagination) $paged = 1;

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
	'post_status'    => array('publish', 'future'),
	'orderby'        => 'meta_value_num',
	'meta_key'       => 'date_start',
	'order'          => 'ASC',
	'meta_query'     => array(
		'relation' => 'OR',
	),
);


if (pearl_check_string($show_past)) {
	$args['meta_query'][] = array(
		'key'     => 'date_start',
		'value'   => time(),
		'compare' => '<=',
	);
}

if (pearl_check_string($show_upcoming)) {
	$args['meta_query'][] = array(
		'key'     => 'date_start',
		'value'   => time(),
		'compare' => '>=',
	);
}

$q = new WP_Query($args);

$tpl = 'partials/content/' . $post_type . '/' . $style;



if ($q->have_posts()): ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<div class="row <?php echo esc_attr($uniq); ?>">
			<?php while ($q->have_posts()): $q->the_post(); ?>
				<?php get_template_part($tpl); ?>
			<?php endwhile; ?>
		</div>
	</div>
	<?php if ($q->found_posts > $posts_per_page): ?>
		<?php if (pearl_check_string($load_more)): ?>
			<div class="text-center">
				<a href="#"
				   data-element=".<?php echo esc_js($uniq); ?>"
				   data-page="1"
				   data-per_page="<?php echo esc_js($posts_per_page); ?>"
				   data-style="<?php echo esc_js($style); ?>"
				   data-view="<?php echo esc_js($view); ?>"
				   data-past="<?php echo esc_js($show_past); ?>"
				   data-upcoming="<?php echo esc_js($show_upcoming); ?>"
				   data-post_type="<?php echo esc_js($post_type); ?>"
				   class="btn btn_outline btn_primary btn_loading stm_load_posts <?php echo esc_attr((!empty($inverted))) ? 'btn_inverted' : 'btn-not_inverted'; ?>">
					<span><?php esc_html_e('Load more', 'pearl'); ?></span>
					<span class="preloader"></span>
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
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