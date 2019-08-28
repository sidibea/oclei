<?php
add_action('load-themes.php', 'pearl_after_switch_theme');
add_action('after_switch_theme', 'pearl_after_switch_theme');
function pearl_after_switch_theme($data)
{
	$theme = wp_get_theme();
	$theme_version = $theme->get('Version');

	update_option('stm_theme_version', $theme_version);

	/*Save Theme Options*/
	$theme_options = get_option('stm_theme_options');
	if(!$theme_options) {
		$options = pearl_default_theme_options();
		update_option('stm_theme_options', $options);
	}

	pearl_update_custom_styles();
}

add_action('switch_theme', 'pearl_switch_theme');
function pearl_switch_theme()
{
	delete_option('stm_theme_version');
}

function pearl_default_theme_options() {
	$json = '{"post_layout":"1","post_sidebar":"default","post_sidebar_archive_mobile":"hidden","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"true","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#3c98ff","secondary_color":"#3c98ff","third_color":"#293742","copyright":"Welcome to Pearl","copyright_co":"true","copyright_socials":"true","copyright_year":"true","footer_bottom_bg":"","right_text":"Multipurpose theme","footer_socials":"","footer_bg":"#000000","footer_bg_image":"1873","footer_color":"#fff","footer_cols":"2","accordions_style":"style_2","buttons_global_style":"style_3","currency_symbol":"$","currency_symbol_position":"left","forms_global_style":"style_3","boxed":"false","boxed_bg":"","enable_ajax":"false","site_padding":"0","site_width":"1140","ga":"","google_api_key":"AIzaSyC9Jykpqu1A4BOgt9VaHBFwx0huaNrhscc","logo":"2490","pagination_style":"style_3","paypal_currency_code":"USD","paypal_email":"timur@stylemix.net","paypal_mode":"sandbox","preloader":"true","preloader_color":"#3c98ff","sidebars_global_style":"style_1","tabs_style":"style_2","page_title_box":"false","page_title_box_align":"center","page_title_box_bg_color":"rgba(0, 0, 0, 0.65)","page_title_box_bg_image":"1716","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_2","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h1","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","tour_style":"style_1","bottom_bar_bg":"","bottom_bar_bottom":"15","bottom_bar_color":"#297ee8","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"15","header_builder":{"center":{"left":[{"$$hashKey":"object:1133","data":{"url":"","uselogo":"true","width":"230"},"disabled":{"default":"","mobile":"","tablet":"disabled"},"label":"Image","margins":{"default":{"top":""}},"order":{"mobile":"1200","tablet":"2196"},"position":["center","left","0"],"type":"image","value":"6"}],"right":[{"$$hashKey":"object:1206","data":{"id":"primary","line":"line_bottom","style":"default"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","0"],"type":"menu"},{"$$hashKey":"object:237","disabled":{"default":"","mobile":"","tablet":""},"label":"Cart","order":{"mobile":"2310","tablet":"2310"},"position":["center","right","1"],"type":"cart"}]}},"center_header_fullwidth":"false","header_bg":"1898","header_bg_fill":"full","header_bottom":"52","header_color":"rgba(41, 55, 66, 0.8)","header_text_color":"#ffffff","header_text_color_hover":"#3c98ff","header_top":"52","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"},{"social":"fa fa-vk","url":"vk.com"},{"social":"fa fa-instagram","url":"insta.gg"}],"main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"25","top_bar_color":"#222222","top_bar_link_color_hover":"#0077ff","top_bar_text_color":"#ffffff","top_bar_top":"25","page_bc":"true","page_bc_fullwidth":"false","show_page_title":"true","coming_soon_style":"style_1","error_page_bg":"2658","error_page_style":"style_4","albums":{"enabled":"true"},"divider_mus_1":"","stm_albums_sidebar_single":"default","stm_albums_sidebar_single_mobile":"hidden","stm_albums_sidebar_single_position":"left","divider_donations_1":"","divider_donations_2":"","divider_donations_3":"","donations":{"enabled":"true"},"stm_donations_amount_1":"10","stm_donations_amount_2":"10","stm_donations_amount_3":"10","stm_donations_layout":"left","stm_donations_sidebar":"default","stm_donations_sidebar_position":"left","stm_donations_sidebar_single":"default","stm_donations_sidebar_single_mobile":"hidden","stm_donations_sidebar_single_position":"left","stm_donations_view":"list","divider_events_1":"","divider_events_2":"","events":{"enabled":"true","has_archive":"false"},"stm_events_layout":"1","stm_events_sidebar":"default","stm_events_sidebar_position":"left","stm_events_sidebar_single":"2234","stm_events_sidebar_single_mobile":"hidden","stm_events_sidebar_single_position":"right","stm_events_view":"list","divider_projects_1":"","divider_projects_2":"","projects":{"enabled":"true","has_archive":"false","name":"Case","plural":"Cases","slug":"cases"},"stm_projects_sidebar":"default","stm_projects_sidebar_position":"left","stm_projects_sidebar_single":"2393","stm_projects_sidebar_single_mobile":"hidden","stm_projects_sidebar_single_position":"right","stm_projects_view":"grid","divider_services_1":"","divider_services_2":"","services":{"enabled":"true","has_archive":"false"},"stm_services_layout":"left","stm_services_sidebar":"2114","stm_services_sidebar_position":"right","stm_services_sidebar_single":"2291","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","stm_stories_layout":"left","stm_stories_sidebar_single":"default","stm_stories_sidebar_single_mobile":"hidden","stm_stories_sidebar_single_position":"left","stories":{"enabled":"true"},"testimonials":{"enabled":"true"},"divider_vac_1":"","stm_vacancies_button":"true","stm_vacancies_button_text":"Contact Us","stm_vacancies_button_url":"\/contact","stm_vacancies_details":"true","stm_vacancies_layout_single":"3","stm_vacancies_share":"true","stm_vacancies_sidebar_single":"false","stm_vacancies_sidebar_single_mobile":"hidden","stm_vacancies_sidebar_single_position":"left","vacancies":{"enabled":"true"},"divider_vid_1":"","stm_videos_sidebar_single":"default","stm_videos_sidebar_single_mobile":"hidden","stm_videos_sidebar_single_position":"left","videos":{"enabled":"true"},"shop_items":"3","product_sidebar":"2691","product_sidebar_position":"right","blockquote_style":"style_3","body_font":{"color":"#222222","fw":"400","ln":"24","ls":"","mgb":"","name":"Open Sans","size":"14"},"h1_settings":{"color":"","fw":"700","ln":"","ls":"1","mgb":"35","name":"","size":"40"},"h2_settings":{"color":"","fw":"700","ln":"","ls":"0.5","mgb":"35","name":"Exo","size":"35"},"h3_settings":{"color":"","fw":"700","ln":"","ls":"0.3","mgb":"30","name":"","size":"20"},"h4_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"25","name":"","size":"16"},"h5_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"20","name":"","size":"15"},"h6_settings":{"color":"","fw":"700","ln":"","ls":"","mgb":"15","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#3c98ff","name":"Exo","subset":""},"link_color":"#3c98ff","link_hover_color":"#3c98ff","list_style":"style_1","p_line_height":"25","p_margin_bottom":"25"}';
	return json_decode($json, true);
}

add_action('init', 'pearl_remove_woo_redirect', 10);

function pearl_remove_woo_redirect() {
	delete_transient( '_wc_activation_redirect' );
	if(get_option('stm_custom_styles_v', 1) === 1) {
		pearl_update_custom_styles();
	}
}

add_action('pearl_importer_done', 'pearl_reset_styles_after_action');
add_action('woocommerce_installed', 'pearl_reset_styles_after_action');

function pearl_reset_styles_after_action() {
	pearl_update_custom_styles();

	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	$fxml = get_temp_dir() . get_option('stm_layout') . '.xml';
	$fzip = get_temp_dir() . get_option('stm_layout') . '.zip';
	if( file_exists($fxml) ) @unlink($fxml);
	if( file_exists($fzip) ) @unlink($fzip);
}