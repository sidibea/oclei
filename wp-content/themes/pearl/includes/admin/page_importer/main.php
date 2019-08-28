<?php
require_once($pearl_admin_includes_path . '/page_importer/helpers/export.php');
require_once($pearl_admin_includes_path . '/page_importer/helpers/import.php');


add_action('admin_enqueue_scripts', 'pearl_page_layouts_importer');

function pearl_page_layouts_importer()
{
	$assets_url = get_template_directory_uri() . '/includes/admin/page_importer/assets';

	wp_enqueue_script('pearl_pli_main', $assets_url . '/js/app.js');

	wp_enqueue_style('pearl_pli_main', $assets_url . '/css/app.css');
}


add_action('edit_form_after_title', 'add_content_before_editor');
function add_content_before_editor() {
	get_template_part('includes/admin/page_importer/tpl/button');
	get_template_part('includes/admin/page_importer/tpl/pages');
}