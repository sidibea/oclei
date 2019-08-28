<?php
function pearl_pli()
{
	/***
	 * var $pearl_page
	 */
	$page = sanitize_title($_GET['page']);
	$layout = sanitize_title($_GET['layout']);

	$layouts_pages = pearl_pli_get_pages();

	if (!empty($layouts_pages[$layout])) {
		$pearl_page = $layouts_pages[$layout][$page];
	}

	$placeholder_id = pearl_pli_get_placeholder();

	$pearl_page['content'] = pearl_pli_replace_page_content(
		$pearl_page['content'],
		$placeholder_id,
		$layout,
		$page
	);

	$pearl_page['meta'] = pearl_pli_replace_meta(
		$pearl_page['meta'],
		$placeholder_id,
		$layout,
		$page
	);

	wp_send_json($pearl_page);
	exit;
}

add_action('wp_ajax_pearl_pli', 'pearl_pli');

function pearl_pli_get_placeholder()
{

	$placeholder_name = 'Pearl Page import placeholder';

	$args = array(
		'posts_per_page' => 1,
		'post_type'      => 'attachment',
		's'              => $placeholder_name,
		'post_status'    => 'any'
	);

	$get_attachment = new WP_Query($args);

	if ($get_attachment->posts[0]) {
		$placeholder = $get_attachment->posts[0]->ID;
	} else {
		$placeholder = pearl_pli_sideload_placeholder();
	}

	return $placeholder;
}

function pearl_pli_sideload_placeholder()
{
	// Need to require these files
	if (!function_exists('media_handle_upload')) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	}

	$url = "http://via.placeholder.com/1920x800?text=placeholder";
	$tmp = download_url($url);
	if (is_wp_error($tmp)) {
		// download failed, handle error
	}
	$post_id = 1;
	$desc = "Pearl Page import placeholder";
	$file_array = array();

	// Set variables for storage
	// fix file filename for query strings
	preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
	$file_array['name'] = 'pearl_pli_placeholder.jpg';
	$file_array['tmp_name'] = $tmp;


	// If error storing temporarily, unlink
	if (is_wp_error($tmp)) {
		@unlink($file_array['tmp_name']);
		$file_array['tmp_name'] = '';
	}

	// do the validation and storage stuff
	$id = media_handle_sideload($file_array, $post_id, $desc);

	// If error storing permanently, unlink
	if (is_wp_error($id)) {
		@unlink($file_array['tmp_name']);
		return $id;
	}

	return $id;
}

function pearl_pli_replace_page_content($content, $placeholder_id, $layout, $page)
{

	pearl_pli_enable_icons($layout);

	$content = pearl_pli_update_shortcodes($content, $placeholder_id);

	$content = pearl_pli_refresh_bg($content, $placeholder_id);

	$content = pearl_pli_refresh_sidebars($content, $placeholder_id, $layout, $page);

	$content = pearl_pli_refresh_forms($content, $layout, $page);

	return $content;
}

function pearl_pli_replace_meta($meta, $placeholder_id, $layout, $page)
{
	if (!empty($meta['stm_sidebar'])) {
		if (!empty($meta['stm_sidebar'][0])) {
			$current_sidebar_id = $meta['stm_sidebar'][0];
			$sidebar_id = pearl_pli_get_new_sidebar($current_sidebar_id, $placeholder_id, $layout, $page);

			if (!empty($sidebar_id)) {
				$meta['stm_sidebar'][0] = $sidebar_id;
			}
		}
	}


	return $meta;
}

function pearl_pli_refresh_bg($content, $placeholder_id)
{
	/*Refresh backgrounds*/
	preg_match_all('~\bbackground(-image)?\s*:(.*?)\(\s*(\'|")?(?<image>.*?)\3?\s*\)~i', $content, $matches);

	if (!empty($matches['image'])) {
		$replace_bgs = $matches['image'];
		$placeholder_bg = pearl_get_image_url($placeholder_id);

		$content = str_replace($replace_bgs, $placeholder_bg, $content);
	}

	return $content;
}

function pearl_pli_update_shortcodes($content, $placeholder_id)
{
	$vc_elements = WPBMap::getShortCodes();
	$vc_replaceable_params = array(
		'attach_image',
		'attach_images'
	);
	$vc_replaceable_el = array(
		array(
			'type'      => 'attach_image',
			'name'      => 'image',
			'shortcode' => 'vc_single_image'
		),
		array(
			'type'      => 'attach_image',
			'name'      => 'parallax_image',
			'shortcode' => 'vc_row'
		)
	);
	foreach ($vc_elements as $shortcode_name => $element) {
		if (!empty($element['params'])) {
			foreach ($element['params'] as $param) {
				if (in_array($param['type'], $vc_replaceable_params) && !in_array($param['param_name'], $vc_replaceable_el)) {
					$param_type = $param['type'];
					$vc_replaceable_el[] = array(
						'type'      => $param_type,
						'name'      => $param['param_name'],
						'shortcode' => $shortcode_name
					);
				}
			}
		}
	}

	$restricted_types = array(
		'marker'
	);

	foreach ($vc_replaceable_el as $element) {
		$shortcode_name = $element['shortcode'];
		$attr_name = $element['name'];

		//$pattern = "/\[".$shortcode_name."[^\]]*](.*)\[\/".$shortcode_name."[^\]]*]/uis";
		$pattern = "/\[" . $shortcode_name . "[^\]]*\]/uis";

		if (preg_match_all($pattern, $content, $matches)) {


			if (!empty($matches[0])) {
				foreach ($matches[0] as $old_shortcode) {
					$pattern_img = '/' . $attr_name . '=\"[^\"]+\"/';

					if (in_array($attr_name, $restricted_types)) {
						$img_pattern = '';
					} else {
						if ($element['type'] == 'attach_image') {
							$image = $placeholder_id;
						} else {
							$image = join(',', array_fill(0, 4, $placeholder_id));
						}

						$img_pattern = $attr_name . '="' . $image . '"';
					}

					$new_shortcode = preg_replace($pattern_img, $img_pattern, $old_shortcode);
					$content = str_replace($old_shortcode, $new_shortcode, $content);
				}
			}
		};
	}

	return $content;
}

function pearl_pli_refresh_sidebars($content, $placeholder_id, $layout, $page)
{
	$pattern = "/\[stm_sidebar[^\]]*\]/uis";

	if (preg_match_all($pattern, $content, $matches)) {
		if (!empty($matches[0])) {
			foreach ($matches[0] as $old_shortcode) {
				if (empty($old_shortcode)) continue;

				$s = array(
					'[stm_sidebar ',
					']',
					'"',
					"'",
					'sidebar='
				);


				$sidebar_id = intval(str_replace($s, '', $old_shortcode));
				if (!empty($sidebar_id)) {

					$sidebar_imported_id = pearl_pli_get_new_sidebar($sidebar_id, $placeholder_id, $layout, $page);

					if (!empty($sidebar_imported_id)) {
						$new_shortcode = str_replace($sidebar_id, $sidebar_imported_id, $old_shortcode);
						$content = str_replace($old_shortcode, $new_shortcode, $content);
					}
				}
			}
		}
	}

	return $content;
}

function pearl_pli_refresh_forms($content, $layout, $page)
{
	/*Shortcode => value*/
	$patterns = array(
		"/\[contact-form-7[^\]]*\]/uis"     => '/\[contact\-form\-7\sid=\"(\d+)/',
		"/\[stm_contact_form_7[^\]]*\]/uis" => '/\[stm\_contact\_form\_7\s+form=\"(\d+)/',
	);

	foreach ($patterns as $pattern => $shortcode_pattern) {

		if (preg_match_all($pattern, $content, $matches)) {

			if (!empty($matches[0])) {
				foreach ($matches[0] as $old_shortcode) {
					if (empty($old_shortcode)) continue;
					preg_match($shortcode_pattern, $old_shortcode, $matches);
					if (!empty($matches[1])) {

						$cf7_id = $matches[1];

						$form_title = "Pearl Page Import {$layout} {$page} Form";

						$args = array(
							'post_type'      => 'wpcf7_contact_form',
							'posts_per_page' => 1,
							'name'           => trim($form_title)
						);

						$get_attachment = new WP_Query($args);

						$cf7_imported_id = '';

						if (!empty($get_attachment->posts)) {
							$cf7_imported_id = $get_attachment->posts[0]->ID;
						} else {
							$cf7_path = get_template_directory() . "/includes/admin/page_importer/pages/{$layout}/forms.php";


							if (!file_exists($cf7_path)) continue;
							require_once $cf7_path;

							if (!empty($pearl_cf7) and !empty($pearl_cf7[$cf7_id])) {
								$wpc7_content = $pearl_cf7[$cf7_id];

								$wpcf7_form = array(
									'post_title'   => $form_title,
									'post_content' => $wpc7_content,
									'post_type'    => 'wpcf7_contact_form',
									'post_status'  => 'publish',
								);

								$cf7_imported_id = wp_insert_post($wpcf7_form);

								update_post_meta($cf7_imported_id, '_form', $wpc7_content);
							}
						}

						if (!empty($cf7_imported_id)) {
							$new_shortcode = str_replace($cf7_id, $cf7_imported_id, $old_shortcode);
							$content = str_replace($old_shortcode, $new_shortcode, $content);
						}
					}
				}
			}
		}
	}

	return $content;
}

function pearl_pli_enable_icons($layout)
{

	$fonts = get_option('stm_fonts_layout');
	if (!empty($fonts['stmicons_' . $layout])) {
		$fonts['stmicons_' . $layout]['enabled'] = 1;

		update_option('stm_fonts_layout', $fonts);
	}

}

function pearl_pli_get_pages()
{

	$layouts_pages = array();

	$layouts = pearl_layout_plugins('business', true);

	foreach ($layouts as $layout => $plugins) {
		$file_path = get_template_directory() . "/includes/admin/page_importer/pages/{$layout}/pages.php";
		if (file_exists($file_path)) {
			require_once $file_path;
			$layouts_pages[$layout] = ${"pearl_page_" . $layout};
		}
	}

	return $layouts_pages;
}

function pearl_pli_get_new_sidebar($sidebar_id, $placeholder_id, $layout, $page)
{
	$sidebar_title = "Pearl Page Import {$layout} {$page}";

	$args = array(
		'post_type'      => 'stm_sidebars',
		'posts_per_page' => 1,
		'name'           => trim($sidebar_title)
	);

	$get_attachment = new WP_Query($args);

	$sidebar_imported_id = '';

	if (!empty($get_attachment->posts)) {
		$sidebar_imported_id = $get_attachment->posts[0]->ID;
	} else {
		$sidebar_path = get_template_directory() . "/includes/admin/page_importer/pages/{$layout}/sidebars.php";

		if (file_exists($sidebar_path)) {
			require_once $sidebar_path;
			if (!empty($pearl_sidebars) and !empty($pearl_sidebars[$sidebar_id])) {
				$sidebar_content = $pearl_sidebars[$sidebar_id];
				$sidebar_content = pearl_pli_update_shortcodes($sidebar_content, $placeholder_id);
				$sidebar_content = pearl_pli_refresh_bg($sidebar_content, $placeholder_id);

				$sidebar = array(
					'post_title'   => $sidebar_title,
					'post_content' => $sidebar_content,
					'post_type'    => 'stm_sidebars',
					'post_status'  => 'publish',
				);

				$sidebar_imported_id = wp_insert_post($sidebar);

			}
		}
	}

	return $sidebar_imported_id;
}