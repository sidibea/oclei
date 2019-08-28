<?php
/*SINGLE PAGE HOOKS*/
$stm_shop_layout = pearl_get_option('stm_shop_layout', 'business');

/*Move Product Title*/
if($stm_shop_layout !== 'store') {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);
}

/*Move sale flash*/
if($stm_shop_layout == 'store') {
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 4);
} else {
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 30);
}

/*Related products as 3 per row*/
add_filter( 'woocommerce_output_related_products_args', 'pearl_related_products_args' );
function pearl_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 1;
	return apply_filters('pearl_related_products_args', $args);
}

/*Move price*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);

add_filter('woocommerce_single_product_image_gallery_classes', 'pearl_woocommerce_single_product_image_gallery_classes');
function pearl_woocommerce_single_product_image_gallery_classes($classes) {
	$classes[] = 'stm_lightgallery';
	return $classes;
}

add_filter('woocommerce_single_product_image_thumbnail_html', 'pearl_woocommerce_single_product_image_thumbnail_html');
function pearl_woocommerce_single_product_image_thumbnail_html($html) {
	$html = str_replace('href="', 'class="stm_lightgallery__selector" href="', $html);
	return $html;
}

add_filter('woocommerce_product_description_heading', 'pearl_woocommerce_product_description_heading');
function pearl_woocommerce_product_description_heading() {
	return false;
}

add_filter('woocommerce_review_gravatar_size', 'pearl_woocommerce_review_gravatar_size');
function pearl_woocommerce_review_gravatar_size() {
	return '174';
}

add_filter('woocommerce_product_review_comment_form_args', 'pearl_woocommerce_product_review_comment_form_args');
function pearl_woocommerce_product_review_comment_form_args($args) {
	$commenter = wp_get_current_commenter();

	$args['author'] = '<div class="form-group">
	<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required />
	</div>';
	return $args;
}