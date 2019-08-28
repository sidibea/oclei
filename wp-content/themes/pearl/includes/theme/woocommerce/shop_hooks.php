<?php
/*Remove actions*/
add_filter('woocommerce_show_page_title', 'pearl_remove_page_title', 100);
function pearl_remove_page_title() {
	return false;
}

$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');

/*Remove closing link shop archive*/
remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

/*Change orderby position*/
if($stm_shop_layout == 'store') {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 5);
}