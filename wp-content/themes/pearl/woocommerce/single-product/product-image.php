<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

$thumbnails_view_vertical = pearl_get_option('thumbnails_view_vertical');

$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');

$three_hundred_sixty   = get_post_meta( get_the_ID(), 'three_hundred_sixty', true );

?>

<?php
    if($three_hundred_sixty == 'true') {
        get_template_part('woocommerce/single-product/product-image/product-image-360');
	} else {
        if($thumbnails_view_vertical == 'true') {
            get_template_part('woocommerce/single-product/product-image/product-image-vertical');
        } else {
            get_template_part('woocommerce/single-product/product-image/product-image-default');
        }
    }
?>