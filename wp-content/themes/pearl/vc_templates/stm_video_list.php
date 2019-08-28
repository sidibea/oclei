<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

/**
 * @var $number
 */



$classes = array('stm_video_list');
$classes[] = 'stm_video_list_' . $style;
$classes[] = 'stm_video_list__masonry';
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('video_list', $style);?>




<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<?php pearl_load_vc_element('video', $atts, $style); ?>
</div>