<?php
/**
 * var $atts
 */
$atts = vc_map_get_attributes($this->getShortcode(), $atts);

$style = (!empty($atts['style'])) ? $atts['style'] : 'style_1';

pearl_add_element_style('projects_cards', $style);

$atts['vars'] = $atts;

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($atts['css'], ' ')); ?>


<div class="stm_projects_cards stm_projects_cards_<?php echo esc_attr($style . ' ' . $css_class); ?>">
	<?php pearl_load_vc_element('projects_cards', $atts, $style . '/' . $style); ?>
</div>
