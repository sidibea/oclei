<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_taxonomy');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );

pearl_add_element_style('taxonomy');

$styles = array();

if(!empty($color)) {
  $styles['color'] = $color;
}

if(!empty($background_color)) {
    $styles['background-color'] = $background_color;
    $classes[] = 'has_bg';
}

$classes[] = (!empty($align)) ? 'text-' . $align : '';

$styles = pearl_array_to_style_string($styles, true);

$terms = pearl_get_terms_array(get_the_ID(), $taxonomy, 'name');
if(!empty($terms)):
    $text_color = (!empty($styles)) ? 'style="'.$styles.'"' : '';
    ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <h6 class="ttc text-transform" <?php echo sanitize_text_field($text_color); ?>>
            <?php echo implode(', ', $terms); ?>
        </h6>
    </div>
<?php endif; ?>