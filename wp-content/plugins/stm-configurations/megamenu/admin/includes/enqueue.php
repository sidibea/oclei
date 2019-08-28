<?php
add_action('admin_enqueue_scripts', 'stm_megamenu_admin_scripts_method');
function stm_megamenu_admin_scripts_method($hook)
{
    if ($hook == 'nav-menus.php') {
        $admin_css = STM_CONFIGURATIONS_URL . 'megamenu/admin/assets/css/';
        $admin_js = STM_CONFIGURATIONS_URL . 'megamenu/admin/assets/js/';
        wp_enqueue_style('stm_megamenu', $admin_css . 'admin.css');
        wp_enqueue_script('stm_megamenu', $admin_js . 'admin.js', array('jquery'));

        wp_enqueue_script(
            'fonticonpicker.js',
            $admin_js . 'jquery.fonticonpicker.min.js',
            array('jquery')
        );
        wp_enqueue_style(
            'fonticonpicker',
            $admin_css . 'jquery.fonticonpicker.min.css'
        );
        wp_enqueue_style(
            'fonticonpicker-inverted',
            $admin_css . 'jquery.fonticonpicker.inverted.min.css'
        );

        wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        $icons = stm_get_icon_sets();
        wp_add_inline_script('stm_megamenu', $icons);
    }
}

function stm_get_icon_sets()
{
	$icon_set = array();
	$default_set = stm_get_icon_sets_by_name();
	$icon_set += $default_set;
	$layout_sets = stm_get_icon_sets_by_name('stm_fonts_layout');
	if(!empty($layout_sets)) {
		$icon_set += $layout_sets;
	}

    if(function_exists('pearl_fontawesome_list')) {
        $fa = pearl_fontawesome_list();
        foreach($fa as $icon => $name) {
            $icon_set['FontAwesome'][] = $icon;
        }
    }

    ob_start(); ?>
    <script type="text/javascript">
        var stmIconsSet = <?php echo json_encode($icon_set); ?>;
    </script>
    <?php
    $r = ob_get_clean();
    $remove = array('<script type="text/javascript">', '</script>');
    $r = str_replace($remove, '', $r);
    return $r;
}


function stm_get_icon_sets_by_name($option_name = 'stm_fonts') {
	$fonts = get_option($option_name);
	$icon_set_name = array();
	if(!empty($fonts)) {
		foreach ($fonts as $font => $info) {
			if ($option_name == 'stm_fonts_layout' && empty($info['enabled'])) continue;

			$upload_dir = wp_upload_dir();
			$url = trailingslashit($upload_dir['basedir']);

			/*Read json and get fontprefix*/
			global $wp_filesystem;

			if (empty($wp_filesystem)) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}

			$json_file = $url . $info['include'] . '/' . 'selection.json';
			$json_file = json_decode($wp_filesystem->get_contents($json_file), true);

			$set_name = $json_file['metadata']['name'];
			$font_prefix = $json_file['preferences']['fontPref']['prefix'];

			if ($option_name == 'stm_fonts_layout') {
				$set_name = $font;
			}

			foreach ($json_file['icons'] as $icon) {
				$icon_set_name[$set_name][] = $font_prefix . $icon['properties']['name'];
			}
		}
	}

	return $icon_set_name;
}