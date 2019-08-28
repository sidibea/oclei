<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$atts['vars'] = $atts;

$classes = array('stm_products_categories stm_loop stm_products_categories_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
pearl_add_element_style('products_categories', $style);

$image_size = (!empty($image_size)) ? $image_size : '540x255';

$id = get_the_ID();
?>


<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php pearl_load_vc_element('products_categories', $atts, $style); ?>
</div>