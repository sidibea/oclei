<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$style = 'style_1';

$classes = array('stm_stories_list stm_markup__stm_stories');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_stories_list_' . $style;

pearl_add_element_style('stories_list', $style);

$posts_per_page = !empty($posts_per_page) ? $posts_per_page : 9;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'stm_stories',
    'posts_per_page' => intval($posts_per_page),
    'post_status' => 'publish',
);

if(pearl_check_string($show_pagination)) {
    $args['paged'] = $paged;
}

$q = new WP_Query($args);

if ($q->have_posts()):
    $id = 'stm_story__carousel_' . pearl_random(); ?>
    <div class="<?php echo implode(' ', $classes); ?>">
        <?php while($q->have_posts()): $q->the_post();
            pearl_load_vc_element('stories', $atts, 'grid_' . $style);
        endwhile; ?>
    </div>

    <?php
	if(pearl_check_string($show_pagination)) {
		echo pearl_pagination(
			array(
				'type'    => 'list',
				'format'  => '?paged=%#%',
				'current' => $paged,
				'total'   => $q->max_num_pages,
			)
		);
	}
    ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>