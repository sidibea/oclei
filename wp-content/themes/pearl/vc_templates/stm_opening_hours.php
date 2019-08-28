<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$style = 'style_1';

$classes = array('stm_opening_hours_table', 'stm_opening_hours_table_' . $style);
$classes[] = $css_class;

pearl_add_element_style('open_hours', $style);

?>

<?php if ( ! empty( $content ) ): ?>
	<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
<?php endif; ?>