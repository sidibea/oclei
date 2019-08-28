<?php
function stm_theme_import_content($layout) {
    set_time_limit(0);

    if (!defined('WP_LOAD_IMPORTERS')) {
        define('WP_LOAD_IMPORTERS', true);
    }

    require_once(STM_CONFIGURATIONS_PATH . '/importer/wordpress-importer/wordpress-importer.php');

    $wp_import = new WP_Import();
    $wp_import->fetch_attachments = true;

    $ready = prepare_demo( $layout );

	if( $ready ){
		ob_start();
		$wp_import->import($ready);
		ob_end_clean();
	}
}
