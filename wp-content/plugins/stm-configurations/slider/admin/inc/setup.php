<?php

	// Do not allow directly accessing this file.
	if (!defined('ABSPATH')) {
		exit('Direct script access denied.');
	}

	define('STM_SLIDER_VERSION', '1.0');


	require_once 'screen.php';

	/*Create theme options item in WP menu*/
	add_action('admin_menu', 'pearl_add_slider_options_menu');
	function pearl_add_slider_options_menu()
	{
		/*Fix for ThemeCheck*/
		add_menu_page('Slider', 'STM slider', 'administrator', 'stm-slider-options', 'stm_slider_options', 'dashicons-images-alt2', '100.111111');
	}







