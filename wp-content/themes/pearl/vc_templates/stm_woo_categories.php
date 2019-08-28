<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

pearl_add_element_style('woo_categories', $style);

$taxonomy = 'product_cat';

$term = get_term($category, $taxonomy);

if ($term):
	$slug = $term->slug;
	$name = $term->name;


$thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
$term_img = wp_get_attachment_url(  $thumb_id );
?>
<div class="stm_woo_category_link_box">
    <div class="stm_woo_category_link_box_title vc_separator">
        <span class="vc_sep_holder vc_sep_holder_first"></span>
        <h4><?php echo sanitize_text_field($name); ?></h4>
        <span class="vc_sep_holder"></span>
    </div>
    <div class="stm_woo_category_link_box_thumbnail">
        <div class="stm_woo_category_link_box_thumbnail_frame"></div>
        <?php if (!empty ($thumb_id)) : ?>
            <img src="<?php echo $term_img ?>" alt="<?php echo sanitize_text_field($name); ?>"/>
        <?php else: ?>
            <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?dpr=1&auto=format&fit=crop&w=960&h=960&q=10&cs=tinysrgb"
                 alt="<?php echo sanitize_text_field($name); ?>"/>
        <?php endif; ?>
    </div>
    <div class="stm_woo_category_link">
        <a href="<?php echo get_category_link($category); ?>" title="<?php the_title(); ?>" class="wtc mbc sbc_h">
            <?php if (!empty ($button_text)) : ?>
                <?php echo $button_text; ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
            <?php else: ?>
                <?php esc_html_e('Shop now', 'pearl'); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
            <?php endif; ?>
        </a>
    </div>
</div>

<?php endif;