<?php

/**
 * @var $content
 * @var $link
 * @var $button_color
 * @var $button_custom_color
 * @var $button_custom_color_hover
 * @var $button_style
 * @var $button_icon_pos
 * @var $button_icon
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_cta');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $style;

$icon_classes = array(
        'btn__icon mtc icon_' . intval($button_icon_size) . 'px ' . $button_icon
);



$button_unique_class = uniqid('btn_');
$button_global_style = !empty(pearl_get_option('buttons_global_style')) ? 'stm_buttons_' . pearl_get_option('buttons_global_style') : '';


$style_array = array();
$style_array_hover = array();
$style_string = '';
$icon_style_array = array();
$icon_style_array_hover = array();

$link = vc_build_link($link);


$button_classes = array(
	'btn',
	'btn_' . $button_style,
	$button_size,
	$button_unique_class
);

if (!empty($button_icon_pos)) {
    $button_classes[] = 'btn_icon btn_icon-' .$button_icon_pos;
}

if ($button_color !== 'custom') {
	$button_classes[] = 'btn_' . $button_color;
} else {
	$style_array[$button_unique_class] = array();
	$style_array_hover[$button_unique_class] = array();

	if (!empty($button_custom_color)) {
		$style_array[$button_unique_class]['background-color'] = $button_custom_color;
	}
	if (!empty($button_custom_border_color)) {
		$style_array[$button_unique_class]['border-color'] = $button_custom_border_color;
	}
	if (!empty($button_custom_color_hover)) {
		$style_array_hover[$button_unique_class]['background-color'] = $button_custom_color_hover;
	}
	if (!empty($button_custom_border_color_hover)) {
		$style_array_hover[$button_unique_class]['border-color'] = $button_custom_border_color_hover;
	}

	if (!empty($icon_custom_color)) {
	    $icon_style_array['color'] = $icon_custom_color;
    }

    if (!empty($icon_custom_color_hover)) {
	    $icon_style_array_hover['color'] = $icon_custom_color_hover;
    }

	if (!empty($button_custom_text_color)) {
		$style_array[$button_unique_class]['color'] = $button_custom_text_color;
	}

	if (!empty($button_custom_text_color_hover)) {
		$style_array_hover[$button_unique_class]['color'] = $button_custom_text_color_hover;
	}
}

if (!empty($style_array)) {
	foreach ($style_array as $el => $css) {
		$style_string .= 'body.' . $button_global_style . ' .' . $el . ':not(.btn_white) {';
		$style_string .= pearl_array_to_style_string($css, true);
		$style_string .= '}';
	}
}
if (!empty($style_array_hover)) {
	foreach ($style_array_hover as $el => $css) {
		$style_string .= 'body.' . $button_global_style . ' .btn.' . $el . ':hover{';
		$style_string .= pearl_array_to_style_string($css, true);
		$style_string .= '}';
	}
}

if (!empty($icon_style_array)) {
	$style_string .= 'body.' . $button_global_style . ' .btn i {';
	$style_string .= pearl_array_to_style_string($icon_style_array, true);
	$style_string .= '}';
}
if (!empty($icon_style_array_hover)) {
	$style_string .= 'body.' . $button_global_style . ' .btn:hover i {';
	$style_string .= pearl_array_to_style_string($icon_style_array_hover, true);
	$style_string .= '}';
}



pearl_add_element_style('cta', $style, $style_string);


?>
<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<?php if (!empty($content)): ?>
		<div class="stm_cta__content">
			<?php echo wpb_js_remove_wpautop($content, true); ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($link)):
		$target = (empty($link['target'])) ? '_self' : $link['target']; ?>
		<div class="stm_cta__link">
			<a href="<?php echo esc_url($link['url']); ?>"
			   class="<?php echo esc_attr(implode(' ', $button_classes)); ?>"
			   title="<?php echo esc_attr($link['title']); ?>"
			   target="<?php echo esc_attr($target); ?>">
                <?php
                if(!empty($button_icon_pos)) : ?>
				<i class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i>
				<?php endif; ?>
                <?php echo sanitize_text_field($link['title']); ?>
			</a>
		</div>
	<?php endif; ?>
</div>

