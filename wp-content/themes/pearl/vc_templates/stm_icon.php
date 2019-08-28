<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$stm_custom_css = $stm_custom_css_after = array();

$classes = array('stm_icon');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = "text-{$icon_align}";

$unique_class = uniqid('stm_icon_');

$classes[] = $unique_class;

if ($icon_styled_bg === 'enable') {
    $classes[] = 'stm_icon_styled_bg';
}

pearl_add_element_style('icon');

$icon_classes = array($icon, $icon_color);
$icon_styles = array();
$icon_styles[] = (!empty($height)) ? "font-size: {$height}px" : '';
$icon_styles[] = (!empty($icon_custom_color)) ? "color: {$icon_custom_color}" : '';

if (!empty($icon_gradient) && $icon_gradient === 'enable') {
    $classes[] = 'stm_icon_gradient';
    $icon_gradient_first_color = !empty($icon_gradient_first_color) ? $icon_gradient_first_color : '#000';
    $icon_gradient_second_color = !empty($icon_gradient_second_color) ? $icon_gradient_second_color : '#000';

    $stm_custom_css[] = "background: -webkit-linear-gradient(45deg, {$icon_gradient_first_color} 0%, {$icon_gradient_second_color} 100%)";
}

if(!empty($icon_styled_bg) && $icon_styled_bg == 'icon_round_bg' && !empty($icon_round_bg) && !empty($height)) {
    $classes[] = 'stm_icon_round_bg';

    if (empty($circle_height)) {
		$square = $height + 20;
    } else {
        $square = $circle_height;
    }

    $stm_custom_css_after[] = 'background-color: ' . $icon_round_bg;
    $stm_custom_css_after[] = 'border-radius: 50%';
    $stm_custom_css_after[] = 'width: ' . $square . 'px';
    $stm_custom_css_after[] = 'height: ' . $square . 'px';

    $stm_custom_css_after = ".{$unique_class} > i:after {
        " . implode(';', $stm_custom_css_after) . "
    }";

    $stm_custom_css_after .= ".{$unique_class} > i {
        width: {$square}px;
        height: {$square}px;
    }";

    wp_add_inline_style('pearl-row_style_1', $stm_custom_css_after);
}

if(!empty($icon_custom_color_hover)) {
    $stm_custom = ".{$unique_class} > i:hover {
        color: {$icon_custom_color_hover} !important;
    }";

    wp_add_inline_style('pearl-row_style_1', $stm_custom);
}

if (!empty($stm_custom_css)) {

    $stm_custom_css = ".{$unique_class} > i {
        " . implode(';', $stm_custom_css) . "
    }";

    wp_add_inline_style('pearl-row_style_1', $stm_custom_css);
}

?>

<?php if(!empty($link)): ?>
    <a class="no_deco" href="<?php echo esc_url($link); ?>">
<?php endif; ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <i style="<?php echo esc_attr(implode(';', array_filter($icon_styles))); ?>"
           class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i>
    </div>

<?php if(!empty($link)): ?>
</a>
<?php endif; ?>