<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$classes = array('stm_spacer');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$height = ($height !== '') ? $height : 0;
$height_tablet_landscape = (empty($height_tablet_landscape)) ? $height : $height_tablet_landscape;
$height_tablet = ($height_tablet !== '') ? $height_tablet : $height;
$height_mobile = ($height_mobile !== '') ? $height_mobile : $height_tablet;
?>
<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="visible-lg visible-md" style="<?php echo esc_attr("height: {$height}px;") ?>"></div>
    <div class="visible-sm_landscape" style="<?php echo esc_attr("height: {$height_tablet_landscape}px;") ?>"></div>
    <div class="visible-sm" style="<?php echo esc_attr("height: {$height_tablet}px;") ?>"></div>
    <div class="visible-xs" style="<?php echo esc_attr("height: {$height_mobile}px;") ?>"></div>
</div>