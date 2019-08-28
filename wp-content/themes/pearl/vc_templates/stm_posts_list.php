<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$is_ajax = false;

if (empty($offset)) {
    $offset = 0;
}

if (!empty($action) && $action == 'pearl_load_posts_list') {
	$offset = intval($offset);
	$is_ajax = true;
} else {
	$atts = vc_map_get_attributes($this->getShortcode(), $atts);
	extract($atts);
	$num = (!empty(intval($num))) ? intval($num) : 6;

	$offset = ($paged - 1) * $num;
	$unique_id = uniqid('button_');

	$classes = array();
	$classes[] = 'stm_posts_list stm_posts_list_' . $style;
	$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
	$classes[] = $unique_id;
	pearl_add_element_style('posts_list', $style);

}

$num = (!empty(intval($num))) ? intval($num) : 6;

$pagination = pearl_check_string($pagination);

if (!$pagination) $paged = 1;

$args = array(
	'post_type'           => sanitize_title($post_type),
	'posts_per_page'      => $num,
	'offset'              => $offset,
	'paged'               => $paged,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'tax_query'           => array()
);

if (!empty($orderby)) {
    $args['orderby'] = $orderby;
}

if (!empty($category)) {
	$args['tax_query'][] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => array(intval($category))
	);
}

if (!empty($post_format) && $post_format !== 'all') {
    $args['tax_query'][] = array(
		'taxonomy' => 'post_format',
		'field'    => 'slug',
		'terms'    => array($post_format)
    );
}



if (!empty($posts_offset)) {
    $args['offset'] = intval($posts_offset);
    $args['paged'] = false;
}

if (is_single()) {
	$args['post__not_in'] = array(get_the_ID());
}


$current_id = get_the_ID();

$q = new WP_Query($args);

if ($q->have_posts()): ?>

	<?php if (!$is_ajax): ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
	<?php endif; ?>

	<?php if (!empty($title)): ?>
        <div class="h4"><?php echo sanitize_text_field($title); ?></div>
	<?php endif; ?>
	<?php while ($q->have_posts()): $q->the_post();
		pearl_load_vc_element('posts_list', $atts, $style);
	endwhile; ?>

	<?php if (!$is_ajax): ?>
        </div>
	<?php endif; ?>

	<?php
	$pagination_style = (empty($pagination_style)) ? 'default' : $pagination_style;
	$total = $q->found_posts;

	if ($pagination == 'enable') {
		if ($pagination_style !== 'ajax') {
			echo pearl_pagination(
				array(
					'type'    => 'list',
					'format'  => '?paged=%#%',
					'current' => $paged,
					'total'   => $total,
				)
			);
		} else { ?>
			<?php if ($total > $num and !$is_ajax):
				$offset = $num + $offset;
				$atts['offset'] = $offset;
				$atts['total'] = $total;
				$atts['classes'] = implode(', ', $classes);
				?>
				<?php get_template_part('partials/vc_parts/posts_list/js/load_more'); ?>
                <div class="text-center">
                    <a href="#"
                       data-offset="<?php echo intval($num); ?>"
                       data-total="<?php echo intval($total); ?>"
                       data-num="<?php echo intval($num); ?>"
                       data-container=".<?php echo esc_attr($unique_id); ?>"
                       data-vars='<?php echo json_encode($atts); ?>'
                       class="btn btn_post_list_load btn_loading mbdc_h mbc_h ttc_h">
                        <span>
                            <?php esc_html_e('Load more stories', 'pearl'); ?>
                        </span>
                        <span class="preloader"></span>
                    </a>
                </div>
			<?php endif; ?>
		<?php }
	}
	wp_reset_postdata(); ?>
<?php endif; ?>
