<?php
	/*
	Plugin Name: STM Configurations
	Plugin URI: https://stylemixthemes.com/
	Description: STM Configurations
	Author: Stylemix Themes
	Author URI: https://stylemixthemes.com/
	Text Domain: stm-configurations
	Version: 2.3.4
	*/

	$is_stm_theme = !empty(get_option('stm_theme_version'));

	if (!$is_stm_theme) {
		return false;
	}

	define('STM_CONFIGURATIONS_PATH', dirname(__FILE__));
	define('STM_CONFIGURATIONS_URL', plugin_dir_url(__FILE__));
	define('STM_IMAGES', STM_CONFIGURATIONS_URL . 'post-types/metaboxes/butterbean/images/');


	//slider constants
	define('STM_SLIDER_VERSION', '1.0');
	define('STM_SLIDER_PLUGIN_NAME', 'slider');
	define('STM_SLIDER_ROOT_PATH', STM_CONFIGURATIONS_PATH . '/slider');
	define('STM_SLIDER_URL', STM_CONFIGURATIONS_URL . 'slider');
	define('STM_SLIDER_PAGE_URL', get_admin_url() . 'admin.php?page=stm-slider-options');
	define('STM_SLIDER_POST_TYPE', 'stm_slider');
	define('STM_SLIDER_META_NAME', 'stm_slider_settings');
	define('STM_SLIDER_SLIDE_META_NAME', 'stm_slider_slide_settings');


	if (!is_textdomain_loaded('stm-configurations')) {
		load_plugin_textdomain('stm-configurations', false, 'stm-configurations/languages');
	}

	require_once STM_CONFIGURATIONS_PATH . '/helpers/includes.php';

	/*Custom icons*/
	require_once STM_CONFIGURATIONS_PATH . '/iconloader/stm-custom-icons.php';

	/*Post types*/
	require_once STM_CONFIGURATIONS_PATH . '/post-types/post_types.php';

    /*Megamenu*/
    require_once STM_CONFIGURATIONS_PATH . '/megamenu/main.php';

	require_once STM_CONFIGURATIONS_PATH . '/slider/vc_register.php';

	if (is_admin()) {
        require_once  STM_CONFIGURATIONS_PATH . '/helpers/enqueue.php';

		require_once STM_CONFIGURATIONS_PATH . '/slider/admin/slider.php';

        /*Demo import*/
		require_once STM_CONFIGURATIONS_PATH . '/importer/importer.php';

		/*Metaboxes*/
		require_once STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/butterbean_metaboxes.php';

	} else {
		require_once STM_CONFIGURATIONS_PATH . '/slider/slider.php';
	}
