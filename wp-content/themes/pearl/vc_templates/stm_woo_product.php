<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('woo_product', $style);

?>
<div class="woo_product_<?php echo esc_attr($style); ?> <?php echo esc_attr($css); ?> woo_product">
    <?php echo do_shortcode('[product id="'. $product_id .'"]')?>
</div>