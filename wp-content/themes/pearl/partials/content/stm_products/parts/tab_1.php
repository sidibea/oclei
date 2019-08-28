<?php
$id = get_the_ID();

$product_tab_content_1_1 = get_post_meta($id, 'product_tab_content_1_1', true );
$product_tab_content_1_2 = get_post_meta($id, 'product_tab_content_1_2', true);
$product_tab_content_1_3 = get_post_meta($id, 'product_tab_content_1_3', true);
$product_tab_content_1_4 = get_post_meta($id, 'product_tab_content_1_4', true);
if (empty($product_tab_content_1_4)) {
    $product_tab_content_1_4 = '<h5>' . esc_html__('Technical data', 'pearl') . '</h5>';
}

?>

<?php if(!empty($product_tab_content_1_1 == 'true')): ?>
<div class="mobile_tab">
    <a  href="#products__tab_1" data-toggle="tab"><span><?php esc_html_e('Product Details', 'pearl'); ?></span></a>
</div>
<div class="tab-pane active" id="products__tab_1">
    <div class="products_details">
        <div class="row">
        <?php if(!empty($product_tab_content_1_2)): ?>
            <div class="products_details_description">
                <?php echo wp_kses_post($product_tab_content_1_2); ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($product_tab_content_1_3)): ?>
            <div class="products_details_data">
                <?php echo (wp_kses_post($product_tab_content_1_4)); ?>
                <ul class="products__technical_data">
                    <?php foreach($product_tab_content_1_3 as $value) : ?>
                        <?php if(!empty($value['label']) and !empty($value['name'])) : ?>
                            <li>
                                <div class="data-first"><?php echo sanitize_text_field($value['label']); ?></div>
                                <div class="data-second"><?php echo sanitize_text_field($value['name']); ?></div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>