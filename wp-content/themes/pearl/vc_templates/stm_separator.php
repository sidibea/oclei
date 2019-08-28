<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('separator', $style);

$style = empty($style) ? 'style_1' : $style;

$classes = array('stm_separator');
$classes[] = $color;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($sep_css, ' '));

$styles = array();
$styles[] = (!empty($custom_color)) ? "background-color: {$custom_color}" : '';
$styles[] = 'max-width: 100% !important';

if (!empty($sep_width)) {
    if (strpos($sep_width, '%') !== false) {
        $sep_width = intval($sep_width) . '%';
    } else {
        $sep_width = intval($sep_width) . 'px';
    }
    $styles[] = "width: {$sep_width}";
}

if (!empty($sep_height)) {
    if (strpos($sep_height, '%') !== false) {
        $sep_height = intval($sep_height) . '%';
    } else {
        $sep_height = intval($sep_height) . 'px';
    }

    $styles[] = "height: {$sep_height} ";
}

if (!empty($align)) {
    switch ($align) {
        case 'center' :
            $styles[] = "margin: 0 auto";
            break;
        case 'right' :
            $styles[] = "margin-left: auto";
            break;
    }
}
?>
<div class="stm_separator_wrapper stm_separator_<?php echo esc_attr($style); ?> <?php echo esc_attr($css); ?>">
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>"
         style="<?php echo esc_attr(implode(';', array_filter($styles))); ?>"></div>
</div>