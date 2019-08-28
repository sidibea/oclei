<?php
$uniq = uniqid('stm_iconbox');

$classes = array('stm_iconbox stm_flipbox clearfix');
$classes[] = 'stm_iconbox_' . $style;
$classes[] = $uniq;
$classes[] = 'text-' . $content_pos;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = 'stm_iconbox__icon-' . $icon_pos;

$inline_styles = '';
$title_styles = array();

$before_tpl = '';
$after_tpl = '';

if (!empty($box_link) && $box_link === 'enable' && !empty($box_link_url)) {
	$link = vc_build_link($box_link_url);
	if (!empty($link['url'])) {
		$link_url = $link['url'];
		$link_title = !empty($box_link_url['title']) ? $box_link_url['title'] : $title ? $title : '';
		$link_rel = !empty($box_link_url['rel']) ? $box_link_url['rel'] : '';
		$before_tpl .= "<a href='$link_url' title='$link_title' rel='$link_rel'>";

		$after_tpl .= "</a>";
	}
}

if (!empty($title_custom_color)) {
	$rgba = pearl_hex2rgb($title_custom_color, '0.25');

	$inline_styles .= ".{$uniq} h5 span {
        color: {$title_custom_color};
    }";

	$inline_styles .= ".{$uniq} {
        border-color: rgba({$rgba}) !important;
    }";
}

if (!empty($flip_title_color)) {
	$inline_styles .= ".{$uniq} .stm_flipbox__back h5 span {
        color: {$flip_title_color};
    }";
}

if (!empty($flip_content_color)) {
	$inline_styles .= ".{$uniq} .stm_flipbox__back .stm_iconbox__desc p {
        color: {$flip_content_color};
    }";
}

if (!empty($title_fsz)) {
	$title_styles['font-size'] = intval($title_fsz) . 'px';
}
if (!empty($title_styles)) {
	$title_styles = pearl_array_to_style_string($title_styles, true, true);
}

pearl_add_element_style('iconbox', $style, $inline_styles);

$h_class = $h_divider === 'true' ? 'line' : 'no_line';

$icon_style = 'font-size:' . esc_attr($icon_size) . 'px;';

if ($icon_class === 'custom' && !empty($icon_color)) {
	$icon_style .= 'color:' . esc_attr($icon_color) . ';';
}

if (!empty($icon_weight)) {
	$icon_style .= "font-weight: {$icon_weight};";
}

$icon_classes = array();
$icon_classes[] = $icon_class;
$icon_classes[] = $icon;

$styles = [];
if (!empty($icon_width)) {
	$styles[] = "width: {$icon_width}px;";
}

if (!empty($icon_height)) {
	$styles[] = "height: {$icon_height}px;";
}

echo wp_kses_post($before_tpl);
?>


    <div class="<?php echo esc_attr(implode(' ', $classes)); ?> clearfix">
        <div style="min-height: <?php echo intval($min_height); ?>px" class="stm_flipbox__front">
            <div class="inner">
				<?php if ($icon) { ?>
                    <div class="stm_iconbox__icon"
                         style="<?php echo esc_attr(implode(' ', $styles)); ?>">
                        <i style="<?php echo sanitize_text_field($icon_style); ?>"
                           class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>">
                        </i>
                    </div>
				<?php } ?>
                <div class="stm_iconbox__text">
					<?php if ($title) { ?>
                        <h5 <?php echo sanitize_text_field($title_styles); ?> class="<?php echo esc_attr($h_class) ?>"><span
                                    class="mtc_b"><?php echo sanitize_text_field($title); ?></span></h5>
					<?php } ?>
                    <div class="stm_iconbox__desc">
                    <span class="stm_iconbox__dots">
                        <span class="stm_iconbox__dot stm_iconbox__dot_first"></span>
                        <span class="stm_iconbox__dot stm_iconbox__dot_second"></span>
                        <span class="stm_iconbox__dot stm_iconbox__dot_third"></span>
                    </span>
						<?php echo wpb_js_remove_wpautop($content, true); ?>
                    </div>
                </div>
            </div>
        </div>
        <div style="min-height: <?php echo intval($min_height); ?>px" class="stm_flipbox__back">
            <div class="inner mbc">
                <div class="stm_iconbox__text">
					<?php if ($flip_title) { ?>
                        <h5 class="<?php echo esc_attr($h_class) ?>"><span
                                    class="mtc_b"><?php echo sanitize_text_field($flip_title); ?></span></h5>
					<?php } ?>
                    <div class="stm_iconbox__desc">
                    <span class="stm_iconbox__dots">
                        <span class="stm_iconbox__dot stm_iconbox__dot_first"></span>
                        <span class="stm_iconbox__dot stm_iconbox__dot_second"></span>
                        <span class="stm_iconbox__dot stm_iconbox__dot_third"></span>
                    </span>
						<?php echo wpb_js_remove_wpautop($flip_content, true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
echo wp_kses_post($after_tpl);

