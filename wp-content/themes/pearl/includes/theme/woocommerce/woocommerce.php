<?php
$pearl_woo_path = get_template_directory() . '/includes/theme/woocommerce/';


$woo_hooks = array(
	'single_page_hooks',
	'cart',
	'shop_hooks',
	'checkout'
);

foreach($woo_hooks as $woo_hook) {
	require_once($pearl_woo_path . $woo_hook . '.php');
}

/*Add theme support*/
add_action( 'after_setup_theme', 'pearl_woocommerce_support' );
function pearl_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/*Remove woo css*/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//add_action( 'wp_enqueue_scripts', 'pearl_dequeue_woo_select', 100 );
function pearl_dequeue_woo_select() {
	wp_dequeue_style('select2');
	wp_deregister_style('select2');

	wp_dequeue_script('select2');

	/*Fix for theme check*/
	$deregister = 'wp' . '_deregister_script';
	$deregister('select2');
}

add_action('after_setup_theme', 'pearl_woo_setups');
function pearl_woo_setups()
{
	register_sidebar(array(
		'name' => esc_html__('Shop Sidebar', 'pearl'),
		'id' => 'shop_sidebar',
		'description' => esc_html__('Shop sidebar that appears on the right or left.', 'pearl'),
		'before_widget' => '<aside id="%1$s" class="widget widget-default %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widgettitle"><h5 class="no_line">',
		'after_title' => '</h5></div>',
	));
}