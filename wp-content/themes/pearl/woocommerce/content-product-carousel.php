<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$id = get_the_ID();

$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');

?>
<div class="owl-item" <?php post_class('stm_lightgallery'); ?>>
    <div class="product">
        <?php get_template_part('woocommerce/layouts/' . $stm_shop_layout . '/content-product'); ?>
    </div>
</div>
