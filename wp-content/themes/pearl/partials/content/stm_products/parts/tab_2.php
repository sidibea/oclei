<?php
$id = get_the_ID();

$product_tab_content_2_1 = get_post_meta($id, 'product_tab_content_2_1', true);
$product_tab_content_2_2 = get_post_meta($id, 'product_tab_content_2_2', true);
$product_tab_content_2_3 = get_post_meta($id, 'product_tab_content_2_3', true);

?>
<?php if (!empty($product_tab_content_2_1) and $product_tab_content_2_3): ?>
    <div class="mobile_tab">
        <a href="#products__tab_2" data-toggle="tab" class="mobile_tab"><span><?php esc_html_e('Images gallery', 'pearl'); ?></span></a>
    </div>
    <div class="tab-pane" id="products__tab_2">
        <h5><?php echo esc_attr($product_tab_content_2_2); ?></h5>
        <ul class="products_gallery stm_lightgallery">
            <?php foreach ($product_tab_content_2_3 as $product_gallery_image): ?>
                <li>
                    <?php if (!empty($product_gallery_image['label']) || !empty($product_gallery_image['name'])): ?>
                        <?php $full_image = pearl_get_image_url($product_gallery_image['name']); ?>
                        <a href="<?php echo esc_url($full_image); ?>" class="item_thumbnail_popup stm_lightgallery__selector" data-sub-html='<a class="wtc" href="<?php the_permalink() ?>"><?php echo esc_html_e($product_gallery_image['label']); ?></a>' title="<?php echo esc_html_e($product_gallery_image['label']); ?>">
                            <span><?php echo html_entity_decode(pearl_get_VC_img(intval($product_gallery_image['name']), '348x208')); ?></span>
                            <?php echo esc_html_e($product_gallery_image['label']); ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>