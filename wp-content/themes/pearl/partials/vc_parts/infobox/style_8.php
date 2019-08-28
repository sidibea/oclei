<?php
$element = 'stm_infobox_' . $style;

$classes = array('stm_infobox', $element);
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

/*Default layout styles*/
$default = pearl_get_layout_config();

pearl_add_element_style('infobox', $style);

$url = (!empty($url)) ? $url : '';
$link_title = (!empty($link_title)) ? $link_title : '';
$tag = (empty($url)) ? 'div' : 'a';

$image_size = (empty($image_size)) ? '500x335' : $image_size;
$image = pearl_get_VC_img($image, $image_size);
?>

<<?php echo esc_attr($tag) ?> href="<?php echo esc_url($url); ?>"
class="<?php echo esc_attr(implode(' ', $classes)) ?>"
title="<?php echo sanitize_text_field($link_title); ?>">
<?php if(!empty($title)): ?>
    <div class="stm_infobox__title"><?php echo sanitize_text_field($title); ?></div>
<?php endif; ?>
<div class="stm_infobox__image"><?php echo wp_kses_post($image); ?></div>
<div class="clearfix">
    <div class="stm_infobox__content">
        <?php echo wpb_js_remove_wpautop($content, true);
        if(!empty($url)): ?>
            <span class="hidden"><?php echo sanitize_text_field($link_title); ?></span>
        <?php endif; ?>
    </div>
</div>
</<?php echo esc_attr($tag) ?>>