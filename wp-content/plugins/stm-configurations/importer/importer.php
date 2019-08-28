<?php
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/content.php');
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/theme_options.php');
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/slider.php');
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/widgets.php');
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/set_content.php');
require_once(STM_CONFIGURATIONS_PATH . '/importer/helpers/megamenu/config.php');

function stm_demo_import_content()
{

    $layout = 'business';

    if(!empty($_GET['demo_template'])){
        $layout = sanitize_title($_GET['demo_template']);
    }

	update_option('stm_layout', $layout);

    /*Import content*/
    stm_theme_import_content($layout);

    /*Import theme options*/
    update_option('stm_theme_options', stm_get_layout_options($layout));

    /*Import sliders*/
    stm_theme_import_sliders($layout);

    /*Import Widgets*/
    stm_theme_import_widgets($layout);

    /*Set menu and pages*/
    stm_set_content_options($layout);

    do_action('pearl_importer_done');

	wp_send_json(array(
		'url' => get_home_url('/'),
		'title' => esc_html__('View site', 'stm_domain'),
		'theme_options_title' => esc_html__('Theme options', 'stm_domain'),
		'theme_options' => esc_url_raw(admin_url('admin.php?page=pearl-theme-options'))
	));
    die();

}

add_action('wp_ajax_stm_demo_import_content', 'stm_demo_import_content');