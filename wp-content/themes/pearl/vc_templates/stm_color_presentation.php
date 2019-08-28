<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$style = 'style_1';

$classes = array('stm_color_presentation', 'stm_color_presentation_' . $style);
$classes[] = $css_class;

pearl_add_element_style('color_presentation', $style);
?>

<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>">
    <?php if(!empty($color)): ?>
        <div class="stm_color_presentation__color"
             style="background-color:<?php echo sanitize_text_field($color); ?>">
         </div>
    <?php endif; ?>

    <?php if(!empty($text_1)): ?>
        <div class="stm_color_presentation__text stm_color_presentation__text_1">
            <?php echo sanitize_text_field($text_1); ?>
        </div>
    <?php endif; ?>

	<?php if(!empty($text_2)): ?>
        <div class="stm_color_presentation__text stm_color_presentation__text_2">
			<?php echo sanitize_text_field($text_2); ?>
        </div>
	<?php endif; ?>
</div>