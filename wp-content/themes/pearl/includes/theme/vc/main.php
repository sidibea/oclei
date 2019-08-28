<?php
/*Add custom icons*/
add_filter('vc_iconpicker-type-fontawesome', 'pearl_vc_custom_icons');

if (!function_exists('pearl_vc_custom_icons')) {
    function pearl_vc_custom_icons($fonts)
    {

		$counts = 0;
		/*Manager fonts*/
		$fonts_manager = pearl_add_fonts_pack();
		if(!empty($fonts_manager)) {
			$fonts = $fonts + $fonts_manager;
		}

		$layout_fonts = pearl_add_fonts_pack('stm_fonts_layout');
		if(!empty($layout_fonts)) {
			$fonts = $fonts + $layout_fonts;
		}

        return $fonts;
    }

    function pearl_add_fonts_pack($option = 'stm_fonts') {

    	$fonts = array();

		$custom_fonts = get_option($option);
		global $wp_filesystem;

		if (empty($wp_filesystem)) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$wp_uploads = wp_upload_dir();
		$base_url = $wp_uploads['basedir'];

		if(!empty($custom_fonts)) {
			foreach ($custom_fonts as $font_name => $custom_font) {
				if($option == 'stm_fonts_layout' && empty($custom_font['enabled'])) continue;
				$json_file = $base_url . '/' . $custom_font['folder'] . '/selection.json';
				$custom_icons_json = json_decode($wp_filesystem->get_contents($json_file), true);
				if (!empty($custom_icons_json)) {
					if (!empty($custom_icons_json['icons'])) {
						$set_name = str_replace('stmicons', 'Pearl icons', $custom_icons_json['metadata']['name']);
						if($option == 'stm_fonts_layout') {
							$set_name = ucfirst(str_replace('stmicons_', 'Pearl - ', $font_name));
						}
						$set_prefix = $custom_icons_json['preferences']['fontPref']['prefix'];
						foreach ($custom_icons_json['icons'] as $icon) {
							$fonts[$set_name][] = array(
								$set_prefix . $icon['properties']['name'] => $set_prefix . $icon['properties']['name']
							);
						}
					}
				}
			}
		}

		return $fonts;
	}
}


//Set VC for default post types
//TODO Add all post types
if (function_exists('vc_set_default_editor_post_types')) {
    vc_set_default_editor_post_types(array(
        'page',
        'post',
        'product',
        'stm_sidebars',
        'stm_projects',
        'stm_services',
        'stm_vacancies',
        'stm_testimonials'
    ));
}


add_action('init', 'pearl_update_existing_shortcodes');

function pearl_update_existing_shortcodes()
{
    if (function_exists('vc_remove_element')) {
        vc_remove_element("vc_cta");
        vc_remove_element("vc_empty_space");
        //vc_remove_element("vc_icon");
        vc_remove_element("vc_separator");
    }
}