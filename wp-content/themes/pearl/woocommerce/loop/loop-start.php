<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
$filter_column_viewed = pearl_get_cookie('stm_filter_column_viewed');

$shop_items = pearl_get_option('shop_items', 3);

$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');

?>

<ul class="products stm_products stm_products_<?php echo intval($shop_items); ?> <?php if ( $stm_shop_layout == 'store' and is_shop() || is_product_category() ) {echo $filter_column_viewed;} ?>">
