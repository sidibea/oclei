<?php
$id = get_the_ID();
$product_tab_content_5_1 = get_post_meta($id, 'product_tab_content_5_1', true);
$product_tab_content_5_2 = get_post_meta($id, 'product_tab_content_5_2', true);
?>

<?php if (!empty($product_tab_content_5_1)): ?>
    <div class="mobile_tab">
        <a href="#products__tab_5" data-toggle="tab" class="mobile_tab"><span><?php esc_html_e('Enquiry', 'pearl'); ?></span></a>
    </div>
    <div class="tab-pane" id="products__tab_5">
        <div class="products_enquiry">
            <?php echo do_shortcode($product_tab_content_5_2); ?>
        </div>
    </div>
<?php endif; ?>