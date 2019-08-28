<?php

function pearl_vc_content_meta_name() {
	return apply_filters('pearl_vc_content_meta_name', 'pearl_vc_generated_content');
}

add_action( 'save_post', 'pearl_save_post_content' );

function pearl_save_post_content( $post_id ) {
	if(is_admin()) {
		WPBMap::addAllMappedShortcodes();
		global $post;
		$post = get_post($post_id);
		$output = apply_filters('the_content', $post->post_content);
		$meta_name = pearl_vc_content_meta_name();
		update_post_meta($post_id, $meta_name, $output);
	}
}

//add_action('wp_enqueue_scripts', 'pearl_generate_vc_styles', 1000);

function pearl_generate_vc_styles() {
	global $wp_scripts, $wp_styles;
	//pearl_pa( $wp_scripts );
	pearl_pa( $wp_styles );
	pearl_pa( $wp_styles->queue );
	die();
}

add_filter('the_content', 'pearl_change_vc_content', 1);

function pearl_change_vc_content($content) {
	global $post;
	if(empty($post->ID)) return $content;

	$meta_name = pearl_vc_content_meta_name();
	$post_id = $post->ID;
	$generated_content = get_post_meta($post_id, $meta_name, true);

	$generated_content = '';

	if(!empty($generated_content)) {
		return $generated_content;
	} else {
		$pearl_include_path = get_template_directory() . '/includes/';
		$pearl_theme_include_path = $pearl_include_path . 'theme/';

		require_once($pearl_theme_include_path . '/vc/helpers.php');
		require_once($pearl_theme_include_path . '/vc/visual_composer.php');
		require_once($pearl_theme_include_path . '/vc/grid_builder.php');

		return $content;
	}
}

if (is_admin() and defined('WPB_VC_VERSION')) {
	require_once($pearl_theme_include_path . '/vc/helpers.php');
	require_once($pearl_theme_include_path . '/vc/visual_composer.php');
	require_once($pearl_theme_include_path . '/vc/grid_builder.php');
}