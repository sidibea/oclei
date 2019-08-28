<?php
if (!defined('ABSPATH')) {
	die('-1');
}


/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * @var $show_bg_mobile
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

wp_enqueue_script('wpb_composer_front_js');

$el_class = $this->getExtraClass($el_class) . $this->getCSSAnimation($css_animation);

$css_classes = array(
	'vc_row',
	'wpb_row',
	'vc_row-fluid',
);

if ('yes' === $disable_element) {
	if (vc_is_page_editable()) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property($css, array(
		'border',
		'background',
	)) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if (!empty($el_id)) {
	$wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}

if (!empty($full_height)) {
	$css_classes[] = 'vc_row-o-full-height';
	if (!empty($columns_placement)) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ('stretch' === $columns_placement) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if (!empty($equal_height)) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if (!empty($content_placement)) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if (!empty($flex_row)) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = (!empty($video_bg) && !empty($video_bg_url) && vc_extract_youtube_id($video_bg_url));

$parallax_speed = $parallax_speed_bg;
if ($has_video_bg) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$wrapper_attributes['data-youtube-id'] = "data-youtube-id='" . vc_extract_youtube_id($video_bg_url) . "'";
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script('stm_youtube_iframe_api_js');
}

if (!empty($parallax)) {
	wp_enqueue_script('vc_jquery_skrollr_js');
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr($parallax_speed) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if (false !== strpos($parallax, 'fade')) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif (false !== strpos($parallax, 'fixed')) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if (!empty($parallax_image)) {
	if ($has_video_bg) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace('/[^\d]/', '', $parallax_image);
		$parallax_image_src = wp_get_attachment_image_src($parallax_image_id, 'full');
		if (!empty($parallax_image_src[0])) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr($parallax_image_src) . '"';
}
if (!$parallax && $has_video_bg) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr($video_bg_url) . '"';
}

//STM Ken Burns
if ($stm_kenburns === 'enable' && vc_shortcode_custom_css_has_property($css, array(
		'background-image',
    ))
)
{
    $wrapper_attributes[] = 'data-stm-kenburns="' . esc_attr__($stm_kenburns) . '"';
}

/*STM row divider*/
$divider_top = $divider_bottom = '';
$row_inline_styles = [];


if (!empty($stm_row_divider)) {
	$el_class .= ' overlap stm_row__divider_enabled stm_row__divider_' . $stm_row_divider . ' stm_row__divider_' . $stm_row_divider_style . '';
	if (vc_shortcode_custom_css_has_property($css, array('background-color'))) {

		$divider_color = pearl_vc_get_element_css_value($atts['css'], 'background-color');
		$divider_css = '.' . vc_shortcode_custom_css_class($css) . ' .stm_row__divider:after { 
		background: 
		linear-gradient(
      		45deg, transparent 33.333%,
      		#333333 33.333%, #333333 66.667%,
      		transparent 66.667%
    	),
    	linear-gradient(
      		-45deg, transparent 33.333%,
      		#333333 33.333%, #333333 66.667%,
      		transparent 66.667%
    	) !important;
    	background-repeat: repeat-x !important; background-size: 16px 32px !important;
    	filter: drop-shadow(' . $divider_color . ' 0px 1px 0px) !important;
    	}';
		wp_add_inline_style('pearl-row_style_1', $divider_css);

	}
	$divider = '<div class="stm_row__divider ' . $stm_row_divider . '"></div>';
}


/*STM row divider end*/


$css_class = preg_replace('/\s+/', ' ', apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter(array_unique($css_classes))), $this->settings['base'], $atts));


$wrapper_attributes[] = 'class="' . esc_attr(trim($css_class)) . '"';

/*STM custom code*/

/*Enqueue custom row style*/
pearl_add_element_style('row');

/*Parallax*/
$parallax_data = '';
$parallax = ($stm_parallax == 'enable') ? ' stm-parallax' : '';
$parallax_id = ($stm_parallax == 'enable') ? uniqid('stm-parallax') : '';
if (!empty($parallax)) {
	wp_enqueue_script('parallax');
	$parallax_data .= ' data-parallax="' . $parallax_id . '"';
}
/*Row Overlay*/
$transparent_bg = '';
if (!empty($stm_transparent_bg)) {
	$transparent_bg = '<div class="stm_row-opacity" style="background-color:' . $stm_transparent_bg . '; ?>"></div>';
	if (!empty($stm_transparent_bg_2)) {
		$transparent_bg_style = "linear-gradient(180deg, {$stm_transparent_bg}, {$stm_transparent_bg_2})";
		$transparent_bg = '<div class="stm_row-opacity" style="background:' . $transparent_bg_style . ';"></div>';;
	}
}


/*STM background position*/
$row_inline_style = array();

if (!empty($bg_pos)) {
	$row_inline_styles['background-position'] = $bg_pos;
}

$box_shadow = array(
	'x'      => intval($shadow_x_offset) . 'px',
	'y'      => intval($shadow_y_offset) . 'px',
	'blur'   => intval($shadow_blur) . 'px',
	'spread' => intval($shadow_spread) . 'px',
	'color'  => $shadow_color
);


if (!empty($box_shadow) && $box_shadow['color'] !== 'transparent') {
	$row_inline_styles['box-shadow'] = $box_shadow['x'] . ' ' . $box_shadow['y'] . ' ' . $box_shadow['blur'] . ' ' . $box_shadow['spread'] . ' ' . $box_shadow['color'];
}

if (!empty($row_inline_styles)) {
	$row_inline_style = '.' . vc_shortcode_custom_css_class($css) . '{' . pearl_array_to_style_string($row_inline_styles, true) . '}';

	$media_bg = '';



	if ($show_bg_mobile === 'disable' && $show_bg_mobile_xs == 'disable') {
		$media_bg = '(max-width: 1024px)';
	} elseif ($show_bg_mobile === 'enable' && $show_bg_mobile_xs == 'disable') {
		$media_bg = '(max-width: 767px)';
	} elseif ($show_bg_mobile === 'disable' && $show_bg_mobile_xs == 'enable') {
		$media_bg = '(max-width: 1024px) and (min-width: 767px)';
    }

    if(!empty($media_bg)) {
		$row_inline_style .= "\n @media {$media_bg} {
            ." . vc_shortcode_custom_css_class($css) . " {
			    background-image: none !important;
            }
        }";
	}
}

if (!empty(	$row_inline_style)) {
	wp_add_inline_style('pearl-row_style_1', $row_inline_style);
}

$main_classes = array(
	$el_class,
	vc_shortcode_custom_css_class($css),
	$parallax
);
$main_classes = implode(' ', $main_classes);

$wrapper_start = '<div class="container vc_container ' . $main_classes . '" ' . $parallax_data . '>';
$wrapper_end = '</div>';

$wrapper_inner_start = $wrapper_inner_end = '';

if (!empty($full_width)) {
	$wrapper_start = '<div class="container-fluid vc_container-fluid ' . $main_classes . '" ' . $parallax_data . '>';
	switch ($full_width) {
		case 'stretch_row' :
			$wrapper_inner_start = '<div class="container"><div class="row">';
			$wrapper_inner_end = '</div></div>';
			break;
		case 'stretch_row_content' :
			$wrapper_inner_start = '<div class="container-fluid"><div class="row">';
			$wrapper_inner_end = '</div></div>';
			break;
		case 'stretch_row_content_no_spaces' :
			$wrapper_inner_start = '<div class="container-fluid stm_no_side_pd"><div class="row">';
			$wrapper_inner_end = '</div></div>';
			break;
		default :
			break;
	}
}

if (!empty($bump)) {
	$bump_style = '';
	$bump_pos = (!empty($bump_pos)) ? $bump_pos : '';

	if ($bump_pos == 'bottom') $wrapper_start = str_replace('class="', 'class="overlap ', $wrapper_start);

	$styles = array();
	if (!empty($css)) {
		preg_match_all('/{(.*?)}/', $css, $styles);
		if (!empty($styles[1]) and !empty($styles[1][0])) {
			$styles = array_filter(explode(';', $styles[1][0]));

			if (!empty($styles)) {
				foreach ($styles as $key => $style) {
					if (strpos($style, 'background-color') !== false) {
						$bump_style = 'style="' . $styles[$key] . ';"';
					}
				}
			}
		}
	}
	$bump = "<div class='bump bump_{$bump} bump_{$bump_pos}' {$bump_style}></div>";
}

if (!empty($gradient_animation)) {
	$gradient_animation = "style='background: linear-gradient(-45deg, {$gradient_animation});'";
	$wrapper_start = str_replace('class="', $gradient_animation . ' class="stm_gradient_animation ', $wrapper_start);
}

if ($has_video_bg) {
	$wrapper_start = str_replace('class="', 'class="stm_container_has_video ', $wrapper_start);
}

/*STM custom code End*/

$output .= $wrapper_start;
$output .= $bump;


/*STM custom code*/
$output .= $transparent_bg;
/*STM custom code End*/
if (!empty($stm_row_divider) && ($stm_row_divider === 'top' || $stm_row_divider === 'both')) {
	$output .= $divider;
}
if (!empty($stm_row_divider) && ($stm_row_divider === 'bottom' || $stm_row_divider === 'both')) {
	$output .= $divider;
}

/*Canvas Row Effect*/
if (!empty($round_effect) and $round_effect == 'round' and !empty($round_effect_image)) {
	wp_enqueue_script('pearl_row_svg_anim');
	ob_start();
	?>
    <svg class="vc_row_canvas_anim" version="1.1" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <style>
                .cls-1 {
                    fill: #fff;
                    fill-rule: evenodd;
                }
            </style>
        </defs>
        <path fill="#fff" d="M0,170 C476.25,170 1428.75,170 1905,170 L1905,170 L0,170"/>


    </svg>

	<?php
	$output .= ob_get_clean();
}

$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';

$output .= $wrapper_inner_start;

$output .= wpb_js_remove_wpautop($content);
$output .= $wrapper_inner_end;


$output .= '</div>';

$output .= $wrapper_end;

echo $output;