<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$output = $title = $el_class = $sortby = $exclude = $css = '';
extract($atts);

if (empty($atts['style'])) $atts['style'] = 'style_1';

pearl_add_element_style('pages_grid', $style);


$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$classes = array('stm_pages_grid');
$classes[] = 'stm_pages_grid_' . $style;
$classes[] = $css_class;
$classes[] = $el_class;

if (empty($img_size)) {
	$img_size = '350x260';
}

if (empty($sortby)) {
	$sortby = 'post_title';
}

$args = array(
	'sort_column' => $sortby,
	'include'     => $include,
	'post_type'   => 'page',
	'post_status' => 'publish'
);

$pages = get_pages($args);

if (!empty($pages)) {
	?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

		<?php
		/**
		 * @var $page WP_Post
		 */
		foreach ($pages as $page) {
			$image = pearl_get_VC_post_img_safe($page->ID, $img_size, 'medium', false, false);
			?>
            <div class="stm_pages_grid__single">
                <div class="image">
                    <a href="<?php the_permalink($page->ID) ?>" title="<?php echo $page->post_title; ?>"
                       class="read-more stc mtc_h">
						<?php echo wp_kses_post($image); ?>
                    </a>
                </div>
                <div class="title">
                    <h6>
						<?php echo $page->post_title; ?>
                    </h6>
                </div>
                <div class="excerpt">
					<?php echo get_the_excerpt($page->ID); ?>
                </div>
                <a href="<?php the_permalink($page->ID) ?>" title="<?php echo $page->post_title; ?>"
                   class="read-more stc mtc_h">
					<?php echo esc_html__('Join ministry', 'Pearl'); ?>
                </a>
            </div>
			<?php
		}
		?>
    </div>
	<?php
}

