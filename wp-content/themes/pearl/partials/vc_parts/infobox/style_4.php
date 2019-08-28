<?php
$element = 'stm_infobox_' . $style;

$classes = array('stm_infobox', $element);
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*Default layout styles*/
$default = pearl_get_layout_config();
/*Colors*/
$m_color = pearl_get_option('main_color', $default['main_color']);

$inline_styles = ".{$element}:hover .stm_infobox__content {";
$inline_styles .= "background-color: {$m_color};";
$inline_styles .= "}";

pearl_add_element_style('infobox', $style, $inline_styles);

$url = (!empty($url)) ? $url : '';
$link_title = (!empty($link_title)) ? $link_title : '';
$tag = (empty($url)) ? 'div' : 'a';

$image_size = (empty($image_size)) ? '500x335' : $image_size;
$image = pearl_get_VC_img($image, $image_size, true);
$style = '';
if (!empty($image)) {
	$style = 'style="background-image:url('. $image .');"';
}
?>

<<?php echo esc_attr($tag) ?> href="<?php echo esc_url($url); ?>"
<?php echo sanitize_text_field($style); ?>
class="<?php echo esc_attr(implode(' ', $classes)) ?>"
title="<?php echo sanitize_text_field($link_title); ?>">
<div class="clearfix stm_infobox__content_wrapper">
    <div class="stm_infobox__content wtc mbc">
		<?php echo wpb_js_remove_wpautop($content, true);
		if(!empty($url)): ?>
            <span class=""><?php echo sanitize_text_field($link_title); ?></span>
		<?php endif; ?>
    </div>
</div>
</<?php echo esc_attr($tag) ?>>