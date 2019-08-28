<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
/**
 * @var $link
 * @var $button_style
 * @var $button_color
 * @var $button_size
 * @var $button_pos
 * @var $button_color_scheme
 *
 * ICON SETTINGS
 * @var $button_icon_pos
 * @var $button_icon
 * @var $button_icon_class
 * @var $button_icon_color
 * @var $button_icon_color_hover
 * @var $button_icon_bg
 * @var $button_icon_bg_hover
 * @var $button_icon_size string xs, sm, lg, empty - default
 *
 * ADVANCED
 * @var $subtitle
 * @var $button_divider
 * @var $c_class
 *
 * CUSTOM COLORS
 * @var $button_border_color
 * @var $button_border_color_hover
 * @var $button_bg_color
 * @var $button_bg_color_hover
 * @var $button_text_color
 * @var $button_text_color_hover
 */
extract($atts);

$classes = array('stm-button');
$classes[] = 'stm-button_' . $button_pos;
$classes[] = (!empty($c_class)) ? $c_class : '';
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

$link = vc_build_link($link);

$button_unique_class = uniqid('stm-button_');

$button_classes = array(
	'btn',
	'btn_' . $button_style,
	'btn_' . $button_color,
	'btn_' . $button_pos,
	'btn_' . $button_color_scheme,
	$button_unique_class
);

$button_classes[] = (!empty($button_size)) ? "btn_{$button_size}" : "";
$button_classes[] = (!empty($subtitle)) ? "btn_subtitle" : "";
$button_classes[] = (!empty($button_icon_bg)) ? "btn_icon-bg" : "";
$button_classes[] = (!empty($button_icon_pos)) ? "btn_icon-{$button_icon_pos}" : "";
$button_classes[] = (!empty($button_divider)) ? "btn_{$button_divider}" : "";

$icon_classes = array(
	"btn__icon",
	$button_icon,
	//$button_icon_class,
	"icon_{$button_icon_size}px"
);

if (!empty($button_icon_bg)
	or !empty($button_icon_bg_hover)
	or !empty($button_icon_color)
	or !empty($button_icon_color_hover)
	or !empty($button_icon_size)
) {
	$button_el = ".btn.{$button_unique_class}";
	$inline_styles = '';

	$width = 35;
	$padding = 35;

	$button_style = pearl_get_option('buttons_global_style', 'style_1');

	switch ($button_style) {
		case 'style_4':
			$width = 30;
			$padding = 35;
			break;
	}



	$inline_styles .= "{$button_el} .btn__icon {";
	if (!empty($button_icon_bg)) {
		$width = 35;
		$padding = 50;

		$inline_styles .= "background-color: {$button_icon_bg};";
	}
	if (!empty($button_icon_color)) {
		$inline_styles .= "color: {$button_icon_color} !important;";
	}

	$inline_styles .= "width:" . ($button_icon_size + $width) . "px;";

	$inline_styles .= "}";

	/*Button Hover icon styles*/
	if (!empty($button_icon_color_hover) or !empty($button_icon_bg_hover)) {
		$inline_styles .= "{$button_el}:hover .btn__icon {";
		if (!empty($button_icon_bg_hover)) {
			$inline_styles .= "background-color: {$button_icon_bg_hover};";
		}
		if (!empty($button_icon_color_hover)) {
			$inline_styles .= "color: {$button_icon_color_hover} !important;";
		}
		$inline_styles .= "}";
	}

	/*Button padding*/
	if (!empty($button_icon_pos)) {
		$inline_styles .= "{$button_el} {";
		$inline_styles .= "padding-{$button_icon_pos}:" . ($button_icon_size + $padding) . "px !important;";
		$inline_styles .= "}";
	}


	/*custom colors*/

	if (!empty($button_border_color)) {
		$inline_styles .= "{$button_el} {";
		$inline_styles .= "border-color: {$button_border_color} !important";
		$inline_styles .= "}";
	}

	if (!empty($button_border_color_hover)) {
		$inline_styles .= "{$button_el}:hover {";
		$inline_styles .= "border-color: {$button_border_color_hover} !important";
		$inline_styles .= "}";
	}

	if (!empty($button_bg_color)) {
		$inline_styles .= "body.stm_buttons_{$button_style} {$button_el} {";
		$inline_styles .= "background-color: {$button_bg_color} !important";
		$inline_styles .= "}";
	}

	if (!empty($button_bg_color_hover)) {
		$inline_styles .= "body.stm_buttons_{$button_style} {$button_el}:hover {";
		$inline_styles .= "background-color: {$button_bg_color_hover} !important";
		$inline_styles .= "}";
	}


	if (!empty($button_text_color)) {
		$inline_styles .= "
		body.stm_buttons_{$button_style} {$button_el}.btn_outline.btn_gradient,
        body.stm_buttons_{$button_style} {$button_el}.btn_solid.btn_gradient,
		body.stm_buttons_{$button_style} {$button_el} {";
		$inline_styles .= "color: {$button_text_color} !important";
		$inline_styles .= "}";
	}

	if (!empty($button_text_color_hover)) {
		$inline_styles .= "
		body.stm_buttons_{$button_style} {$button_el}.btn_outline.btn_gradient:hover,
        body.stm_buttons_{$button_style} {$button_el}.btn_solid.btn_gradient:hover,
		body.stm_buttons_{$button_style} {$button_el}:hover {";
		$inline_styles .= "color: {$button_text_color_hover} !important";
		$inline_styles .= "}";
	}

	/*Gradient*/
	if (!empty($button_border_color_gradient_first)) {
        $inline_styles .= "
        body.stm_buttons_{$button_style} {$button_el}.btn_outline.btn_gradient,
        body.stm_buttons_{$button_style} {$button_el}.btn_solid.btn_gradient {";
        $inline_styles .= "border-left-color: {$button_border_color_gradient_first} !important";
        $inline_styles .= "}";
    }

    if (!empty($button_border_color_gradient_second)) {
        $inline_styles .= "
        body.stm_buttons_{$button_style} {$button_el}.btn_outline.btn_gradient,
        body.stm_buttons_{$button_style} {$button_el}.btn_solid.btn_gradient {";
        $inline_styles .= "border-right-color: {$button_border_color_gradient_second} !important";
        $inline_styles .= "}";
    }

    if (!empty($button_border_color_gradient_first) || !empty($button_border_color_gradient_second)) {
        $inline_styles .= "{$button_el}:before, {$button_el}:after {";
        $inline_styles .= "background: -webkit-linear-gradient(left,  {$button_border_color_gradient_first} 0%,{$button_border_color_gradient_second} 100%) !important";
        $inline_styles .= "}";
    }

    if (!empty($button_background_color_gradient_first) || !empty($button_background_color_gradient_second)) {
        $inline_styles .= "{$button_el} span:before, {$button_el} span:after {";
        $inline_styles .= "background: -webkit-linear-gradient(left,  {$button_background_color_gradient_first} 0%,{$button_background_color_gradient_second} 100%) !important";
        $inline_styles .= "}";
    }

	wp_add_inline_style('pearl-row_style_1', $inline_styles);
}


/*This template also renders post button from grid builder*/
if (!empty($button_link) and $button_link == 'post_link') {
	$link = (!empty($link)) ? $link : array();
	$link['url'] = esc_url(home_url('/')) . '?p={{post_data:ID}}';
	$link['title'] = (!empty($link['title'])) ? $link['title'] : $button_text;
	$link['target'] = '_self';
} else {
	if (!empty($button_text)) {
		$link['title'] = sanitize_text_field($button_text);
	}
}


if (!empty($link)):
	$target = (empty($link['target'])) ? '_self' : $link['target']; ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<a href="<?php echo sanitize_text_field($link['url']) ?>"
		   class="<?php echo esc_attr(implode(' ', $button_classes)); ?>"
		   title="<?php echo esc_attr($link['title']) ?>"
		   target="<?php echo esc_attr($target); ?>">
			<?php if (!empty($button_icon)): ?>
				<i class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i>
			<?php endif; ?>
			<span class="btn__label"><?php echo sanitize_text_field($link['title']); ?></span>
			<?php if (!empty($subtitle)): ?>
				<span class="btn_subtitle_label"><?php echo sanitize_text_field($subtitle); ?></span>
			<?php endif; ?>
		</a>
	</div>
<?php endif;