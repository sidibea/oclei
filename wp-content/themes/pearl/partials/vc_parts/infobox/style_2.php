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

$image_size = (empty($image_size)) ? '500x335' : $image_size;
$image = pearl_get_VC_img($image, $image_size);
?>

<div  class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <div class="stm_infobox__image"><?php echo wp_kses_post($image); ?></div>

    <div class="stm_infobox__content_wrap">
        <div class="stm_infobox__content wtc mbc">
            <?php echo wpb_js_remove_wpautop($content, true);
            if(!empty($url)): ?>
                <p class="text-center">
                    <a href="<?php echo esc_url($url); ?>"
                    class="btn btn_solid btn_secondary btn_icon-right btn_left btn_default"
                    title="<?php if(!empty($link_title)): ?><?php echo sanitize_text_field($link_title); ?><?php else : ?><?php esc_html_e('Shop now', 'pearl'); ?><?php endif; ?>">
                    <?php if(!empty($link_title)): ?><?php echo sanitize_text_field($link_title); ?><?php else : ?><?php esc_html_e('Shop now', 'pearl'); ?><?php endif; ?> <span class="btn__icon stmicon-church-chevron-right"></span>
                    </a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>