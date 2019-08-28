<?php
add_action('admin_enqueue_scripts', 'pearl_admin_to_styles');

function pearl_admin_to_styles($hook)
{
	/*Enqueue styles and scripts only for theme options*/
	$allowed_pages = array(
		'pearl_page_pearl-theme-options',
		'pearl-child-theme_page_pearl-theme-options'
	);

	if (!in_array($hook, $allowed_pages)) {
		return;
	}

	$theme_info = pearl_get_assets_path();

	wp_enqueue_style('pearl-admin-styles-reset', $theme_info['to_css'] . 'reset.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('stm_theme_options-vendors', $theme_info['to_vendor'] . 'vendor.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('pearl-admin-styles', $theme_info['to_css'] . 'styles.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('pearl-admin-styles-global', $theme_info['admin_css'] . 'styles.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('pearl-builder-styles', $theme_info['to_css'] . 'builder.css', null, $theme_info['v'], 'all');
	wp_enqueue_style('fontawesome', $theme_info['vendors'] . 'font-awesome.min.css', null, $theme_info['v']);
//	wp_enqueue_style('fontIconPicker', $theme_info['to_css'] . 'jquery.fonticonpicker.min.css', null, $theme_info['v']);


	wp_enqueue_script('stm_theme_options_vendors', $theme_info['to_vendor'] . 'vendor.js', null, $theme_info['v'], 'all');
	wp_enqueue_script('pearl_theme_options_app', $theme_info['to_js'] . 'app.min.js', null, $theme_info['v'], 'all');
//	wp_enqueue_script('fontIconPicker', $theme_info['to_js'] . 'jquery.fonticonpicker.min.js', null, $theme_info['v'], 'all');

	if (defined('WPB_VC_VERSION')) {
		wp_enqueue_script('wpb_composer_front_js', plugins_url() . '/js_composer/assets/js/dist/js_composer_front.min.js', array('jquery'), WPB_VC_VERSION, true);
		wp_enqueue_style('stm_to-js_composer_front', plugins_url() . '/js_composer/assets/css/js_composer_tta.min.css', array(), WPB_VC_VERSION);
	}


	/*Custom css*/
	$custom_css = '';
	$custom_css .= pearl_header_elements_styles();
	$custom_css .= pearl_header_element_custom_styles();

	ob_start();
	get_template_part('partials/skin/skin_template');
	$custom_styles = ob_get_clean();

	$custom_css .= preg_replace('/\s+/', ' ', $custom_styles);

	wp_add_inline_style('pearl-admin-styles', apply_filters('pearl_custom_inline_styles', $custom_css));
}