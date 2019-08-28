<?php
/**
 * @var $content
 * @var $style
 * @var $css
 * @var $atts
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$content = str_replace('[stm_company_history_item', '[stm_company_history_item style="' . $style . '"', $content);

pearl_add_element_style('history', $style);

$classes = array('stm_history');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = "stm_history_{$style}";

pearl_add_element_style('history');
?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php if(!empty($title)): ?>
        <h4 class="text-transform stm_mgb_35"><?php echo sanitize_text_field($title); ?></h4>
    <?php endif; ?>
	<?php if( !empty( $content ) ){ ?>
		<ul class="list-unstyled">
			<?php echo wpb_js_remove_wpautop($content); ?>
		</ul>
	<?php } ?>
</div>