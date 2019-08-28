<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_iconlist');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );

$icon_classes = array(
    $icon, "icon_{$iconsize}px", "__icon"
);

if (!empty($icon_color)) {
    $icon_classes[] = $icon_color;
}

pearl_add_element_style('iconlist');

$margins = (!empty(intval($margins))) ? intval($margins) : '9';

$style = '';
if(!empty($line_height)) {
	$style = "style='line-height: {$line_height}px'";
}
?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php echo str_replace(
        array(
            '<li>',
            '</li>'
        ),
        array(
            "<li class='stm_mgb_{$margins}' {$style}><i class='" . esc_attr(implode(' ', $icon_classes)) . "'></i><span>",
            "</span></li>"
        ),
        wpb_js_remove_wpautop($content, true)
    ); ?>
</div>