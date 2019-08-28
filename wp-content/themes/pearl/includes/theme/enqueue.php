<?php
/*Enqueue styles and scripts only for frontend*/
if (!is_admin()) {
	add_action('wp_enqueue_scripts', 'pearl_load_scripts_and_styles', 90);

	function pearl_load_scripts_and_styles()
	{
		$jquery = array('jquery');

		$upload_dir = wp_upload_dir();

		$theme_info = pearl_get_assets_path();
		$buttons_global_style = pearl_get_option('buttons_global_style', 'style_1') . '.css';
		$sidebar_global_style = pearl_get_option('sidebars_global_style', 'style_1') . '.css';

		$form_style = pearl_get_option('forms_global_style', 'style_1');
		$forms_global_style = $form_style . '.css';

		$google_api_key = pearl_get_option('google_api_key');

		$blockquote_global_style = pearl_get_option('blockquote_style', 'style_1') . '.css';

		$post_layout_style = pearl_get_option('post_layout', '1') . '.css';

		$pagination_style = pearl_get_option('pagination_style', 'style_1') . '.css';

		$list_style = pearl_get_option('list_style', 'style_1') . '.css';

		$tabs_style = pearl_get_option('tabs_style', 'style_1') . '.css';

		$tour_style = pearl_get_option('tour_style', 'style_1') . '.css';

		$accordions_style = pearl_get_option('accordions_style', 'style_1') . '.css';

		$header_style = pearl_get_option('main_header_style', 'style_1') . '.css';

		$footer_style = 'style_' . pearl_get_option('stm_footer_layout', 1) . '.css';

		$titlebox = pearl_get_option('page_title_box_style', 'style_1') . '.css';


        /*Font*/
		wp_enqueue_style('stm_default_google_font', pearl_google_fonts(), null, $theme_info['v'], 'all');

        /*Global CSS*/
		wp_enqueue_style('pearl-theme-styles', $theme_info['css'] . 'app.css', null, $theme_info['v']);
		wp_enqueue_style('pearl-theme-custom-styles', $upload_dir['baseurl'] . '/stm_uploads/skin-custom.css', null, get_option('stm_custom_styles_v', 1));
		wp_enqueue_style('fontawesome', $theme_info['vendors'] . 'font-awesome.min.css', null, $theme_info['v']);
		wp_enqueue_style('pearl-buttons-style', $theme_info['css'] . 'buttons/styles/' . $buttons_global_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-sidebars-style', $theme_info['css'] . 'sidebar/' . $sidebar_global_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-forms-style', $theme_info['css'] . 'form/' . $forms_global_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-blockquote-style', $theme_info['css'] . 'blockquote/' . $blockquote_global_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-post-style', $theme_info['css'] . 'post/style_' . $post_layout_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-pagination-style', $theme_info['css'] . 'pagination/' . $pagination_style, 'pearl-theme-styles', $theme_info['v']);
		wp_enqueue_style('pearl-list-style', $theme_info['css'] . 'lists/' . $list_style, 'pearl-list-styles', $theme_info['v']);
		wp_enqueue_style('pearl-tabs-style', $theme_info['css'] . 'tabs/' . $tabs_style, 'pearl-tabs-styles', $theme_info['v']);
		wp_enqueue_style('pearl-tour-style', $theme_info['css'] . 'tour/' . $tour_style, 'pearl-tour-styles', $theme_info['v']);
		wp_enqueue_style('pearl-accordions-style', $theme_info['css'] . 'accordion/' . $accordions_style, 'pearl-accordions-styles', $theme_info['v']);

		if (!pearl_stm_hb_enabled()) {
			wp_enqueue_style('pearl-header-style', $theme_info['css'] . 'header/' . $header_style, 'pearl-header-styles', $theme_info['v']);
		}

		wp_enqueue_style('pearl-footer-style', $theme_info['css'] . 'footer/' . $footer_style, 'pearl-footer-styles', $theme_info['v']);
		wp_enqueue_style('pearl-titlebox-style', $theme_info['css'] . 'titlebox/' . $titlebox, 'pearl-titlebox-styles', $theme_info['v']);

		if (is_post_type_archive('post') || is_singular('post')) {
			wp_enqueue_style('pearl-post-style', $theme_info['css'] . 'post/style_' . $post_layout_style, 'pearl-theme-styles', $theme_info['v']);
		}

        /* CSS */
		wp_register_style('owl-carousel2', $theme_info['css_vendor'] . 'owl.carousel.css', null, $theme_info['v']);
		wp_register_style('lightgallery', $theme_info['vendors'] . 'lightgallery.css', null, $theme_info['v']);

		wp_register_style('twentytwenty', $theme_info['vendors'] . 'twentytwenty.css', null, $theme_info['v']);
		wp_register_style('slick.js', $theme_info['vendors'] . 'slick.css', null, $theme_info['v']);

		wp_register_style('stm_slider', $theme_info['css_vendor'] . 'stm_slider.css', null, $theme_info['v']);
		wp_register_style('datepicker', $theme_info['vendors'] . 'datepicker.css', null, $theme_info['v']);
		wp_register_style('mediaelement', $theme_info['vendors'] . 'mediaelementplayer-legacy.min.css', 'null', $theme_info['v']);
		wp_register_style('stm_player.css', $theme_info['css'] . 'player/player.css', array('mediaelement'), $theme_info['v']);
		wp_register_style('stm_datepicker', $theme_info['css'] . 'datepicker/datepicker.css', array('datepicker'), $theme_info['v']);

		wp_register_style('timepicker.css', $theme_info['vendors'] . 'jquery.timepicker.css', null, $theme_info['v']);
		wp_register_style('stm_timepicker', $theme_info['css'] . 'timepicker/timepicker.css', array('timepicker.css'), $theme_info['v']);

		wp_register_style('stm_instagram', $theme_info['css_vendor'] . 'instagram.css', array('timepicker.css'), $theme_info['v']);

		wp_register_style('dragdealer', $theme_info['vendors'] . 'dragdealer.css', array('timepicker.css'), $theme_info['v']);
		wp_register_style('malihu-custom-scrollbar-plugin', $theme_info['vendors'] . 'jquery.mCustomScrollbar.min.css', array('timepicker.css'), $theme_info['v']);

		wp_register_style('animate.css', $theme_info['vendors'] . 'animate.min.css', null, $theme_info['v']);
		wp_register_style('flickity.css', $theme_info['vendors'] . 'flickity.min.css', null, $theme_info['v']);

        /* GLOBAL JS */
		wp_enqueue_script('bootstrap', $theme_info['vendors'] . 'bootstrap.min.js', $jquery, $theme_info['v'], true);
		wp_enqueue_script('SmoothScroll.js', $theme_info['vendors'] . 'SmoothScroll.js', $jquery, $theme_info['v'], true);

		if ($form_style == 'style_3') {
			wp_enqueue_script('autosize.js', $theme_info['vendors'] . 'autosize.min.js', $jquery, $theme_info['v'], false);
			wp_enqueue_script('pearl_material_form', $theme_info['js'] . 'materialForm.js', $jquery, $theme_info['v'], false);
		}

        /*Register JS*/
		wp_register_script('parallax', $theme_info['js'] . 'parallax.js', $jquery, $theme_info['v'], true);
		wp_register_script('stm_youtube_iframe_api_js', $theme_info['js'] . 'stm_youtube_row.js', $jquery, $theme_info['v'], true);
		wp_register_script('countUp.js', $theme_info['vendors'] . 'countUp.min.js', $jquery, $theme_info['v'], true);
		wp_register_script('lightgallery.js', $theme_info['vendors'] . 'lightgallery.min.js', $jquery, $theme_info['v'], true);
		wp_register_script('lg-video.js', $theme_info['vendors'] . 'lg-video.js', array('lightgallery.js'), $theme_info['v'], true);
		wp_register_script('isotope.js', $theme_info['vendors'] . 'isotope.pkgd.min.js', $jquery, $theme_info['v'], true);
		wp_register_script('Chart', $theme_info['vendors'] . 'Chart.min.js', $jquery, $theme_info['v'], true);
		wp_register_script('vivus.js', $theme_info['vendors'] . 'vivus.js', $jquery, $theme_info['v'], true);
		wp_register_script('circle-progress', $theme_info['vendors'] . 'circle-progress.js', $jquery, $theme_info['v'], true);
		wp_register_script('StmMarker.js', $theme_info['js'] . 'StmMarker.js', array('pearl-theme-scripts'), $theme_info['v'], true);
		wp_register_script('gmap', '//maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&callback=initGoogleScripts&v=3.31', array('pearl-theme-scripts'), $theme_info['v'], true);
		wp_register_script('stm_timeline_carousel', $theme_info['js'] . 'stm_timeline_carousel.js', array('pearl-theme-scripts'), $theme_info['v'], true);
		wp_register_script('animejs', $theme_info['vendors'] . 'anime.min.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('tilt.js', $theme_info['js'] . 'tilt.js', array('animejs'), $theme_info['v'], true);
		wp_register_script('flickity.js', $theme_info['vendors'] . 'flickity.pkgd.min.js', array('jquery'), $theme_info['v'], true);


		wp_register_script('jquery.move', $theme_info['vendors'] . 'jquery.event.move.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('jquery.timepicker', $theme_info['vendors'] . 'jquery.timepicker.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('twentytwenty', $theme_info['vendors'] . 'jquery.twentytwenty.js', array('jquery', 'jquery.move'), $theme_info['v'], true);
		wp_register_script('slick.js', $theme_info['vendors'] . 'slick.min.js', array('jquery', 'jquery.move'), $theme_info['v'], true);
		wp_register_script('three_hundred_sixty', $theme_info['js'] . 'three_hundred_sixty.js', $jquery, $theme_info['v'], true);
		wp_register_script('jquery.countdown', $theme_info['vendors'] . 'jquery.countdown.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('dragdealer', $theme_info['vendors'] . 'dragdealer.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('packery', $theme_info['vendors'] . 'packery-mode.pkgd.min.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('lazysizes', $theme_info['vendors'] . 'lazysizes-umd.min.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('malihu-custom-scrollbar-plugin', $theme_info['vendors'] . 'jquery.mCustomScrollbar.concat.min.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('paper', $theme_info['vendors'] . 'paper-full.js', array('jquery'), $theme_info['v'], false);

		if (pearl_check_string(pearl_get_option('enable_bubbles', ''))) {
			wp_enqueue_script('paper');
		}

		/*Player*/
		wp_register_script('mediaelement', $theme_info['vendors'] . 'mediaelementplayer.min.js', array('jquery'), $theme_info['v'], true);
		wp_register_script('pearl-audio-player', $theme_info['js'] . 'audio-player.js', array('mediaelement'), $theme_info['v'], true);
		wp_register_script('stm_donation_form_handler', $theme_info['js'] . 'stm_donation_form_handler.js', array('jquery'), $theme_info['v'], true);

		if (pearl_check_music_enabled()) {
			wp_enqueue_script('pearl-audio-player');
			wp_enqueue_style('stm_player.css');
		}

		if (pearl_get_option('header_sticky', '') !== '') {
			wp_enqueue_script('pearl-sticky-header', $theme_info['js'] . 'sticky.js', array('jquery'), $theme_info['v'], true);
		}


		wp_register_script('pearl-owl-carousel2', $theme_info['js'] . 'owl.carousel.js', $jquery, $theme_info['v'], true);
		wp_register_script('pearl-owl-linked', $theme_info['js'] . 'owl.linked.js', array('pearl-owl-carousel2'), $theme_info['v'], true);
		wp_register_script('pearl-owl-filter', $theme_info['js'] . 'owl.filter.js', array('pearl-owl-carousel2'), $theme_info['v'], true);

		wp_enqueue_script('sticky-kit', $theme_info['js'] . 'sticky-kit.js', $jquery, $theme_info['v'], true);
		wp_enqueue_script('jquery-touchswipe.js', $theme_info['vendors'] . 'jquery.touchSwipe.min.js', $jquery, $theme_info['v'], true);
		wp_enqueue_script('pearl-theme-scripts', $theme_info['js'] . 'app.js', $jquery, $theme_info['v'], true);
		wp_register_script('pearl-theme-modal', $theme_info['js'] . 'modal.js', $jquery, $theme_info['v'], true);


		/*Ajax page load*/
		if (pearl_check_string(pearl_get_option('enable_ajax', 'false'))) {
			wp_register_script('barba.js', $theme_info['js'] . 'barba.min.js', $jquery, $theme_info['v'], false);
			wp_enqueue_script('pearl-page-ajax', $theme_info['js'] . 'page_ajax.js', array('barba.js'), $theme_info['v'], true);
		}

		if (class_exists('booked_plugin')) {
			wp_enqueue_style('stm_booked', $theme_info['css_vendor'] . 'booked.css', null, $theme_info['v']);
		}
		if (class_exists('WooCommerce')) {
			wp_enqueue_style('stm_woo', $theme_info['css_vendor'] . 'woo.css', null, $theme_info['v']);
			wp_enqueue_script('stm_woo', $theme_info['js'] . 'woo.js', $jquery, $theme_info['v'], true);
			wp_enqueue_script('lightgallery.js');
			wp_enqueue_style('lightgallery');
		}

		if (function_exists('display_instagram')) {
			wp_enqueue_style('stm_instagram');
		}

		wp_dequeue_script('stm_hb_scripts');
		wp_dequeue_script('stm_hb_vendors');


		/*VC modules*/
		$vc_modules = array(
			'projects/style_2_carousel',
			'upcoming_event',
			'modal/album',
			'addtocalendar',
			'join_form',
			'vertical_carousel',
			'schedule',
			'stats_counter',
			'event_map',
			'three_hundred_sixty',
			'tilt_fn',
			'sliding_images',
			'sliding_images_vertical',
			'countdown',
			'row_svg_anim',
			'video_frame',
			'post_carousel/like_dislike',
			'post_carousel/style_2',
			'post_carousel/style_3',
			'post_carousel/style_4',
			'post_carousel/style_5',
			'categories_tabs',
			'image_posts_slider'
		);

		$vc_modules_path = $theme_info['js'] . 'vc_modules/';

		foreach ($vc_modules as $vc_module) {
			wp_register_script(
				'pearl_' . $vc_module,
				$vc_modules_path . $vc_module . '.js',
				$jquery,
				$theme_info['v'],
				true
			);
		}
	}
}

/*Get google font*/
// Default Google fonts enqueue
if (!function_exists('pearl_google_fonts')) {
	function pearl_google_fonts()
	{
		$fonts_url = '';
		$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		$headings_settings = array();
		$headings_font_families = array();

		foreach ($headings as $heading) {
			$headings_settings[] = pearl_get_option($heading . '_settings');
		}
		foreach ($headings_settings as $headings_setting) {
			if (!empty($headings_setting['name'])) {
				$ff = $headings_setting['name'];
				if (!in_array($ff, $headings_font_families)) {
					$headings_font_families[] = $ff;
				}
			}
		}

		$main_font = _x('on', 'Main font: on or off', 'pearl');
		$sec_font = _x('on', 'Secondary font: on or off', 'pearl');

		$fonts = pearl_get_font();

		$main_font = $fonts['main'];
		$secondary_font = $fonts['secondary'];

		$l_m_font = $main_font['name'];
		$l_s_font = $secondary_font['name'];

        //TODO get subsets from theme options;
		$subsets = apply_filters('pearl_font_subset', 'latin,latin-ext');

        //TODO make font-weight custom;
		$weights = apply_filters('pearl_font_weight', '300,400,400i,500,600,700,800,900');

		if ('off' !== $main_font || 'off' !== $sec_font) {
			$font_families = array();
			$web_safe = pearl_websafe_fonts();

			if ('off' !== $main_font and empty($web_safe[$l_m_font])) {
				$font_families[] = "{$l_m_font}:{$weights}";
			}

			if ('off' !== $sec_font and empty($web_safe[$l_s_font])) {
				$font_families[] = "{$l_s_font}:{$weights}";
			}

			if (!empty($headings_font_families)) {
				foreach ($headings_font_families as $headings_font_family) {
					$font_families[] = "{$headings_font_family}:{$weights}";
				}
			}

			$query_args = array(
				'family' => urlencode(implode('|', $font_families)),
				'subset' => urlencode($subsets)
			);

			$fonts_url = (!empty($font_families)) ? add_query_arg($query_args, 'https://fonts.googleapis.com/css') : '';
		}

		return esc_url($fonts_url);
	}
}

function pearl_enqueue_comment_reply()
{
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
// Hook into wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'pearl_enqueue_comment_reply');


add_filter('script_loader_tag', 'pearl_add_async_attribute', 10, 2);

function pearl_add_async_attribute($tag, $handle)
{
	$handles = array(
		'gmap'
	);

	if (!in_array($handle, $handles)) {
		return $tag;
	} else {
		return str_replace(array(' src', "type='text/javascript'"), array(' data-src', ''), $tag);
	}
}