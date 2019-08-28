<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$style = 'style_1';

$classes = array('stm_contact');
$classes[] = 'stm_categories_' . $style;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
pearl_add_element_style('categories', $style);

$args = array(
    'number' => $categories_number,
    'hide_empty' => false,
);

$categories = get_categories($args);

if(!is_wp_error($categories) && !empty($categories)): ?>
    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <?php foreach($categories as $category):
            $term_id = $category->term_id;
            $image_id = get_term_meta($term_id, 'pearl_category_image', true); ?>
            <a href="<?php echo esc_url(get_term_link($category)) ?>"
               class="stm_categories_single tbc">
                <div class="mtc"><?php echo esc_attr($category->name); ?></div>
                <?php echo pearl_get_VC_attachment_img_safe($image_id, $image_size); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif;