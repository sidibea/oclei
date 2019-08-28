<?php
$id = get_the_ID();

$product_tab_content_3_1 = get_post_meta($id, 'product_tab_content_3_1', true);
$product_tab_content_3_2 = get_post_meta($id, 'product_tab_content_3_2', true);
$product_tab_content_3_3 = get_post_meta($id, 'product_tab_content_3_3', true);
$product_tab_content_3_4 = get_post_meta($id, 'product_tab_content_3_4', true);
$product_tab_content_3_5 = get_post_meta($id, 'product_tab_content_3_5', true);

?>

<?php if (!empty($product_tab_content_3_1)): ?>
    <div class="mobile_tab">
        <a href="#products__tab_3" data-toggle="tab" class="mobile_tab"><span><?php esc_html_e('Certificates', 'pearl'); ?></span></a>
    </div>
    <div class="tab-pane" id="products__tab_3">
        <div class="products_certificate_top">
            <h3><?php echo esc_attr($product_tab_content_3_2); ?></h3>
            <div class="products_certificate_top_description">
                <?php echo esc_attr($product_tab_content_3_3); ?>
            </div>
        </div>
        <ul class="products_certificate stm_lightgallery">
            <?php foreach ($product_tab_content_3_4 as $product_certificate_image): ?>
                <li>
                    <?php if (!empty($product_certificate_image['label']) and !empty($product_certificate_image['name'])): ?>
                        <div class="products_certificate_box">
                            <div class="products_certificate_title"><?php echo esc_html_e($product_certificate_image['label']); ?></div>
                            <?php $full_image = pearl_get_image_url($product_certificate_image['name']); ?>
                            <a href="<?php echo esc_url($full_image); ?>" class="item_thumbnail_popup stm_lightgallery__selector" data-sub-html='<a class="wtc" href="<?php the_permalink() ?>"><?php echo esc_html_e($product_certificate_image['label']); ?></a>' title="<?php echo esc_html_e($product_certificate_image['label']); ?>">
                                <span class="products_certificate_img"><?php echo html_entity_decode(pearl_get_VC_img(intval($product_certificate_image['name']), 'full')); ?></span>
                            </a>
                            <div class="products_certificate_description"><?php echo esc_html_e($product_certificate_image['description']); ?></div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>