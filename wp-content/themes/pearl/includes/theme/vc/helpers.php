<?php
add_action('vc_before_init', 'pearl_vc_set_as_theme');

function pearl_vc_set_as_theme()
{
	vc_set_as_theme(true);
}

function pearl_vc_colors()
{
	return array(
		esc_html__('Primary', 'pearl')   => 'mtc',
		esc_html__('Secondary', 'pearl') => 'stc',
		esc_html__('Third', 'pearl')     => 'ttc',
		esc_html__('Custom', 'pearl')    => 'custom',
	);
}

function pearl_vc_bg_colors()
{
	return array(
		esc_html__('Primary', 'pearl')   => 'mbc',
		esc_html__('Secondary', 'pearl') => 'sbc',
		esc_html__('Third', 'pearl')     => 'tbc',
		esc_html__('Custom', 'pearl')    => 'custom',
	);
}

function pearl_vc_align()
{
	return array(
		esc_html__('Left', 'pearl')   => 'left',
		esc_html__('Center', 'pearl') => 'center',
		esc_html__('Right', 'pearl')  => 'right',
	);
}

function pearl_vc_add_css_editor($name = 'css')
{
	$data = array(
		'type'       => 'css_editor',
		'heading'    => esc_html__('Css', 'pearl'),
		'param_name' => $name,
		'group'      => esc_html__('Design options', 'pearl')
	);
	return apply_filters('pearl_vc_add_css_editor', $data);
}

function pearl_vc_per_row($param_name = 'per_row', $dependency = array())
{
	$res = array(
		'type'       => 'dropdown',
		'heading'    => esc_html__('Items per row', 'pearl'),
		'param_name' => $param_name,
		'value'      => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
		'std'        => 3,
	);

	if (!empty($dependency)) {
		$res['dependency'] = $dependency;
	}

	return $res;
}

function pearl_vc_colorpicker($element_name)
{

	$el_param_name = "{$element_name}_class";
	$picker_param_name = "{$element_name}_color";

	$arrays = array(
		array(
			'type'        => 'dropdown',
			'heading'     => sprintf(esc_html__("%s Color", 'pearl'), $element_name),
			'param_name'  => $el_param_name,
			'value'       => array(
				esc_html__('Main color', 'pearl')      => 'mtc',
				esc_html__('Secondary color', 'pearl') => 'stc',
				esc_html__('Third color', 'pearl')     => 'ttc',
				esc_html__('Custom', 'pearl')          => 'custom'
			),
			'description' => esc_html__('Select icon color', 'pearl')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon Custom Color', 'pearl'),
			'param_name' => $picker_param_name,
			'value'      => '',
			'dependency' => array(
				'element' => 'icon_class',
				'value'   => 'custom'
			)
		)
	);

	return $arrays;

}

add_action('init', 'pearl_add_params');

function pearl_add_params()
{
	if (function_exists('vc_add_param')) {
		vc_add_param('vc_wp_categories', pearl_load_styles(3));
		vc_add_param('vc_wp_search', pearl_load_styles(3));
		vc_add_param('vc_progress_bar', pearl_load_styles(3));
	}

	if (function_exists('vc_add_params')) {

		vc_add_params('vc_line_chart',
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Legend Position', 'pearl'),
					'param_name' => 'stm_legend_position',
					'value'      => array(
						esc_html__('Bottom') => 'bottom',
						esc_html__('Right side') => 'right'
					),
					'std'        => 'bottom',
				),
			)
		);

		vc_add_params('vc_single_image',
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Hover Action', 'pearl'),
					'param_name' => 'stm_hover_action',
					'value'      => array(
						esc_html__('None') => '',
						esc_html__('Slide top') => 'top'
					),
					'std'        => '',
				),
			)
		);

		vc_add_params('vc_text_separator',
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Font family', 'pearl'),
					'param_name' => 'font_family',
					'value'      => array(
						esc_html__('Heading font', 'pearl')      => 'heading_font',
						esc_html__('Body font', 'pearl')         => 'main_font',
					),
					'std'        => 'heading_font',
					'group' => esc_html__('Typography Settings', 'pearl'),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title font-size', 'pearl'),
					'param_name' => 'title_size',
					'group' => esc_html__('Typography Settings', 'pearl'),
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__('Title font-weight', 'pearl'),
                    'param_name' => 'title_weight',
                    'group' => esc_html__('Typography Settings', 'pearl'),
                ),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Line-height', 'pearl'),
					'param_name' => 'line_height',
					'group' => esc_html__('Typography Settings', 'pearl'),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__('Title color', 'pearl'),
					'param_name' => 'title_color',
					'value'      => pearl_vc_colors(),
					'std'        => 'mtc',
					'group' => esc_html__('Typography Settings', 'pearl'),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__('Title Custom Color', 'pearl'),
					'param_name' => 'title_custom_color',
					'value'      => '',
					'dependency' => array(
						'element' => 'title_color',
						'value'   => 'custom'
					),
					'group' => esc_html__('Typography Settings', 'pearl'),
				),
			)
		);

		$vc_column_params = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Stretch column', 'pearl'),
				'param_name' => 'stretch',
				'value'      => array(
					esc_html__('Default', 'pearl')                  => '',
					esc_html__('Stretch out to the left', 'pearl')  => 'left',
					esc_html__('Stretch out to the right', 'pearl') => 'right',
				),
				'std'        => '',
				'weight'     => 2
			),
			array(
				'type' => 'checkbox',
				'heading'    => esc_html__('Stretch content', 'pearl'),
				'param_name' => 'content_stretch',
				'value' => '',
				'std' => '',
				'dependency' => array(
					'element' => 'stretch',
					'not_empty' => true
				),
				'weight' => 1
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Background position', 'pearl'),
				'param_name'  => 'bg_pos',
				'value'       => '',
				'description' => esc_html__('Enter background position in px or %. Ex.: 50% 50% or 100px 50px', 'pearl'),
				'group'       => esc_html__('Design Options', 'pearl')
			),
		);
		foreach (pearl_vc_add_shadow() as $shadow_param) {
			$vc_column_params[] = $shadow_param;
		}

		vc_add_params('vc_column', $vc_column_params);

		$vc_column_inner_params = array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Background position', 'pearl'),
				'param_name'  => 'bg_pos',
				'value'       => '',
				'description' => esc_html__('Enter background position (X, Y) in px or %. Ex.: 50% 50% or 100px 50px', 'pearl'),
				'group'       => esc_html__('Design Options', 'pearl')
			),
		);
		foreach (pearl_vc_add_shadow() as $shadow_param) {
			$vc_column_inner_params[] = $shadow_param;
		}

		vc_add_params('vc_column_inner', $vc_column_inner_params);

		vc_add_params('vc_custom_heading', array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Heading line', 'pearl'),
				'param_name' => 'heading_line',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => '',
					esc_html__('Disable', 'pearl') => 'no_line',
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Heading side line', 'pearl'),
				'param_name' => 'heading_side_line',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'disable',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__('Icon', 'pearl'),
				'param_name' => 'heading_icon',
				'value'      => '',
				'dependency' => array(
					'element' => 'heading_line',
					'value'   => 'no_line'
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Icon Position', 'pearl'),
				'param_name' => 'heading_icon_pos',
				'value'      => array(
					esc_html__('Top', 'pearl')    => '',
					esc_html__('Right', 'pearl') => 'right',
					esc_html__('Bottom', 'pearl') => 'bottom',
					esc_html__('Left', 'pearl') => 'left',
				),
				'dependency' => array(
					'element' => 'heading_line',
					'value'   => 'no_line'
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Icon Color', 'pearl'),
				'param_name' => 'heading_icon_color',
				'value'      => array(
					esc_html__('Primary', 'pearl')   => 'mtc',
					esc_html__('Secondary', 'pearl') => 'stc',
					esc_html__('Third', 'pearl')     => 'ttc',
					esc_html__('Custom', 'pearl')    => 'custom',
				),
				'dependency' => array(
					'element' => 'heading_line',
					'value'   => 'no_line'
				),
				'std'        => 'stc',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Icon Color', 'pearl'),
				'param_name' => 'heading_icon_custom_color',
				'std'        => '#909090',
				'dependency' => array(
					'element' => 'heading_icon_color',
					'value'   => 'custom'
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Text transform', 'pearl'),
				'param_name' => 'text_transform',
				'value'      => array(
					esc_html__('Default', 'pearl')   => '',
					esc_html__('Uppercase', 'pearl') => 'text-transform',
					esc_html__('Lowercase', 'pearl') => 'text-transform_lower',
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
		));

		$vc_row_params = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Row divider', 'pearl'),
				'param_name' => 'stm_row_divider',
				'value'      => array(
					esc_html__('None', 'pearl')   => '',
					esc_html__('Top', 'pearl')    => 'top',
					esc_html__('Bottom', 'pearl') => 'bottom',
					esc_html__('Both', 'pearl')   => 'both',
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Row divider style', 'pearl'),
				'param_name' => 'stm_row_divider_style',
				'value'      => array(
					esc_html__('Saw', 'pearl') => 'saw',
				),
				'std'        => 'saw',
				'dependency' => array(
					'element'   => 'stm_row_divider',
					'not_empty' => true
				),
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('STM Parallax', 'pearl'),
				'param_name' => 'stm_parallax',
				'value'      => array(
					esc_html__('Disable', 'pearl') => 'disable',
					esc_html__('Enable', 'pearl')  => 'enable',
				),
				'std'        => 'disable',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('STM Ken Burns', 'pearl'),
				'param_name' => 'stm_kenburns',
				'value'      => array(
					esc_html__('Disable', 'pearl') => 'disable',
					esc_html__('Enable', 'pearl')  => 'enable',
				),
				'std'        => 'disable',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'        => 'exploded_textarea',
				'heading'     => esc_html__('Animated gradient background', 'pearl'),
				'param_name'  => 'gradient_animation',
				'description' => esc_html__('Enter gradient colors on each line', 'pearl'),
				'group'       => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Row transparent first background color', 'pearl'),
				'param_name' => 'stm_transparent_bg',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Row transparent second background color', 'pearl'),
				'param_name' => 'stm_transparent_bg_2',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Background position', 'pearl'),
				'param_name'  => 'bg_pos',
				'value'       => '',
				'description' => esc_html__('Enter background position in px or %. Ex.: 50% 50% or 100px 50px', 'pearl'),
				'group'       => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show background on tablet', 'pearl'),
				'param_name' => 'show_bg_mobile',
				'value'      => array(
					esc_html__('Show', 'pearl') => 'enable',
					esc_html__('Hide', 'pearl') => 'disable',
				),
				'std'        => 'enable',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show background on mobile', 'pearl'),
				'param_name' => 'show_bg_mobile_xs',
				'value'      => array(
					esc_html__('Show', 'pearl') => 'enable',
					esc_html__('Hide', 'pearl') => 'disable',
				),
				'std'        => 'enable',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Row Top Bump', 'pearl'),
				'param_name' => 'bump',
				'value'      => array(
					esc_html__('Disable', 'pearl') => '',
					esc_html__('Enable', 'pearl')  => 'round',
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Bump position', 'pearl'),
				'param_name' => 'bump_pos',
				'value'      => array(
					esc_html__('Top', 'pearl')    => '',
					esc_html__('Bottom', 'pearl') => 'bottom',
				),
				'dependency' => array(
					'element' => 'bump',
					'value'   => 'round'
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Row Background Round', 'pearl'),
				'param_name' => 'round_effect',
				'value'      => array(
					esc_html__('Disable', 'pearl') => '',
					esc_html__('Enable', 'pearl')  => 'round',
				),
				'std'        => '',
				'group'      => esc_html__('Design Options', 'pearl')
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__('Background Image', 'pearl'),
				'param_name' => 'round_effect_image',
				'dependency' => array(
					'element' => 'round_effect',
					'value'   => 'round'
				),
				'group'      => esc_html__('Design Options', 'pearl')
			)
		);

		foreach (pearl_vc_add_shadow() as $shadow_param) {
			$vc_row_params[] = $shadow_param;
		}

		vc_add_params('vc_row', $vc_row_params);
		vc_add_params('vc_message', array(
			pearl_load_styles(3, 'skin'),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Icon', 'pearl'),
				'param_name' => 'show_icon',
				'value'      => array(
					esc_html__('Show', 'pearl') => 'enable',
					esc_html__('Hide', 'pearl') => 'disable',
				),
				'std'        => 'enable',
				'weight'     => 4
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Close button', 'pearl'),
				'param_name' => 'close_button',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'disable',
				'weight'     => 3
			)
		));
		vc_add_params('stm_slider', array(
			pearl_load_styles(10)
		));
	}

	if (function_exists('vc_remove_param')) {
		//Accordion
		vc_remove_param('vc_tta_accordion', 'color');
		vc_remove_param('vc_tta_accordion', 'shape');
		vc_remove_param('vc_tta_accordion', 'style');
		vc_remove_param('vc_tta_accordion', 'spacing');
		vc_remove_param('vc_tta_accordion', 'c_align');
		vc_remove_param('vc_tta_accordion', 'c_position');
		vc_remove_param('vc_tta_accordion', 'no_fill');
		vc_remove_param('vc_tta_accordion', 'gap');
		vc_remove_param('vc_tta_accordion', 'autoplay');

		//Tabs
		vc_remove_param('vc_tta_tabs', 'style');
		vc_remove_param('vc_tta_tabs', 'shape');
		vc_remove_param('vc_tta_tabs', 'color');
		vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
		vc_remove_param('vc_tta_tabs', 'spacing');
		vc_remove_param('vc_tta_tabs', 'gap');
		vc_remove_param('vc_tta_tabs', 'pagination_style');

		/*Tour*/
		vc_remove_param('vc_tta_tour', 'style');
		vc_remove_param('vc_tta_tour', 'shape');
		vc_remove_param('vc_tta_tour', 'color');
		vc_remove_param('vc_tta_tour', 'no_fill_content_area');
		vc_remove_param('vc_tta_tour', 'spacing');
		vc_remove_param('vc_tta_tour', 'gap');
		vc_remove_param('vc_tta_tour', 'pagination_style');
		vc_remove_param('vc_tta_tour', 'pagination_color');
	}
}

/**
 * @param $taxonomy
 * @return mixed
 */
function pearl_get_terms_vc($taxonomy, $include_all = true, $extended_label = false)
{
	$r = array();

	if($include_all) {
		$r[esc_html__('All', 'pearl')] = 'all';
	}

	if(is_admin()) {
		$args = array(
			'hide_empty' => false
		);
		if (!empty($taxonomy)) {
			$args['taxonomy'] = $taxonomy;
		}
		$terms = get_terms($args);

		if (!is_wp_error($terms) and !empty($terms)) {
			foreach ($terms as $term) {
				$name = !$extended_label ? $term->name : $term->name . ' - ' . $term->slug;
				$r[$name] = $term->term_id;
			}
		}
	}

	return apply_filters('pearl_get_terms_vc', $r);
}

function pearl_autocomplete_terms($taxonomy = '', $include_all = true, $extended_label = false) {
	$r = array();
	if(is_admin()) {
		$args = array(
			'hide_empty' => false
		);
		if (!empty($taxonomy)) {
			$args['taxonomy'] = $taxonomy;
		}
		$terms = get_terms($args);

		if (!is_wp_error($terms) and !empty($terms)) {
			foreach ($terms as $term) {
				$name = !$extended_label ? $term->name . '(Taxonomy: '. $term-> taxonomy.')' : $term->name . ' - ' . $term->slug;
				$r[] = array(
					'label' => $name,
					'value' => $term->term_id
				);
			}
		}
	}


	return apply_filters('pearl_autocomplete_terms', $r);
}

/**
 * Get image from visual composer cropped on the fly.
 *
 * @param $img_id integer
 * @param $img_size string
 * @param $url bool return image url only
 * @return mixed|string
 */
function pearl_get_VC_img($img_id, $img_size, $url = false)
{
	$image = '';
	if (!empty($img_id) and !empty($img_size)) {
		$img = wpb_getImageBySize(array(
			'attach_id'  => $img_id,
			'thumb_size' => $img_size,
		));

		if (!empty($img['thumbnail'])) {
			$image = $img['thumbnail'];

			if ($url) {
				$datas = array();
				preg_match( '/src="([^"]*)"/i', $image, $datas );
				if(!empty($datas[1])) {
					$image = $datas[1];
				} else {
					$image = '';
				}
			}
		}
	}

	return apply_filters('pearl_get_VC_img', $image);
}

add_filter('vc_wpb_getimagesize', 'pearl_vc_wpb_getimagesize', 100, 3);

/**
 * Hook in VC function and crop retina image then add it to the original img tag with retina data param
 *
 * @param $attachment
 * @param $id
 * @param $params
 * @return mixed
 */
function pearl_vc_wpb_getimagesize($attachment, $id, $params)
{
	/*Already cropped*/
	if (!empty($params['retined']) and $params['retined']) return $attachment;
	/*Empty thumbnail*/
	if (empty($attachment['thumbnail']) or empty($params['thumb_size'])) return $attachment;

	/*Get size as array width - height*/
	$img_size = $params['thumb_size'];
	$retina_size = explode('x', $img_size);

	/*If size is in wrong format*/
	if (!is_array($retina_size) or count($retina_size) != 2) return $attachment;
	$retina_width = $retina_size[0] * 2;
	$retina_height = $retina_size[1] * 2;

	$image_matadata = wp_get_attachment_metadata($id);
	$original_image_width = $image_matadata['width'];
	$original_image_height = $image_matadata['height'];

	$retina_size_available = $original_image_width > $retina_width && $original_image_height > $retina_height;

		$retina_size = $retina_width . 'x' . $retina_height;

	$retina_img = wpb_getImageBySize(array(
		'attach_id'  => $id,
		'thumb_size' => $retina_size,
		'retined'    => true
	));

	if (!empty($retina_img['thumbnail']) && $retina_size_available) {
		$retina = explode(" ", $retina_img['thumbnail']);
		$retina = (is_array($retina) and !empty($retina[2])) ? str_replace('src', 'srcset', $retina[2]) : '';
	}

	if (!empty($retina) && $retina_size_available) {
		$retina = substr($retina, 0, -1) . ' 2x"';
		$attachment['thumbnail'] = str_replace('<img', '<img ' . $retina, $attachment['thumbnail']);
	}

	return $attachment;
}

function pearl_vc_post_type($post_type)
{
	$choices = array(
		esc_html__('Select', 'pearl') => 0
	);
	if (is_admin()) {
		$posts = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1));
		if ($posts) {
			foreach ($posts as $val) {
				$choices[get_the_title($val)] = $val->ID;
			}
		}
	}

	return apply_filters('pearl_vc_post_type', $choices);
}

function pearl_get_post_data($post_type) {
	$pages_data = array();
	if (is_admin()) {
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => -1,
			'post_status'    => 'publish'
		);
		$pages = get_posts($args);
		foreach ($pages as $page) {
			$pages_data[] = array(
				'label' => $page->post_title,
				'value' => $page->ID
			);
		}
	}

	return apply_filters('pearl_get_post_data', $pages_data);
}

/**
 * Locate template in vc styles
 *
 * @param string|array $templates Single or array of template files
 *
 * @return string
 */
function pearl_locate_vc_element($templates, $template_name = '', $custom_path)
{
	$located = false;


	foreach ((array)$templates as $template) {

		$folder = $template;

		if (!empty($template_name)) {
			$template = $template_name;
		}

		if (substr($template, -4) !== '.php') {
			$template .= '.php';
		}


		if(empty($custom_path)) {
			if (!($located = locate_template('partials/vc_parts/' . $folder . '/' . $template))) {
				$located = get_template_directory() . '/partials/vc_parts/' . $folder . '/' . $template;
			}
		} else {
			if (!($located = locate_template($custom_path))) {
				$located = get_template_directory() . '/' . $custom_path . '.php';
			}
		}

		if (file_exists($template_name)) {
			break;
		}
	}

	return apply_filters('pearl_locate_vc_element', $located, $templates);
}

/**
 * Load template
 *
 * @param $__template
 * @param array $__vars
 */
function pearl_load_vc_element($__template, $__vars = array(), $__template_name = '', $custom_path = '')
{
	extract($__vars);
	$element = pearl_locate_vc_element($__template, $__template_name, $custom_path);
	if (!file_exists($element) && strpos($__template_name, 'style_') !== false) {
		$element = str_replace($__template_name, 'style_1', $element);
	}
	if (file_exists($element)) {
		include $element;
	} else {
		echo esc_html__('Element not found in ' . $element, 'pearl');
	}
}

function pearl_get_taxonomies_list($label = false)
{
	$tax = array();
	if (is_admin()) {
		$tax = get_taxonomies();
		if ($label) {
			$taxes = array();
			foreach ($tax as $tax_slug) {
				$taxes[] = array('label' => $tax_slug, 'value' => $tax_slug);
			}
			$tax = $taxes;
		}
	}
	return $tax;
}