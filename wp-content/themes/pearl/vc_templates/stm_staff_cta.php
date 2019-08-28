<?php

if (!empty($atts)) {

	extract($atts);

	$vc_atts = vc_map_get_attributes($this->getShortcode(), $atts);


	/**
	 * @var $style string
	 * @var $layout string
	 * @var $image int image id
	 * @var $col int col-md-{$col}
	 */


	$classes = array('stm_staff_cta clearfix js_trigger');
	$classes[] = 'stm_staff_cta_' . $atts['layout'] . '_' . $atts['style'];
	$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($vc_atts['css'], ' '));
	$classes[] = $this->getCSSAnimation($vc_atts['css_animation']);

	$classes[] = $style;
	$link = vc_build_link($link);
	?>


	<div class="col-md-<?php echo intval($col) ?> col-sm-6 col-sxs-4">
		<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
			<div class="stm_staff_cta__title h4">
				<?php echo sanitize_text_field($text) ?>
			</div>

			<div class="stm_staff_cta__link">
				<a href="<?php echo esc_attr($link['url']) ?>"
				   class="no_deco ttc_h"
				   title="<?php echo esc_attr($link['title']) ?>"
					<?php echo !empty($link['target']) ? "target='{$link['target']}' " : '' ?>
					<?php echo !empty($link['rel']) ? "rel='{$link['rel']}' " : '' ?>
				>
					<?php echo wp_kses_post($link['title']) ?>
				</a>
			</div>
		</div>
	</div>


	<?php


}

?>