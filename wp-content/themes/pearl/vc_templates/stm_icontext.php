<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$uniq = uniqid('stm_icontext');
$classes = array('stm_icontext clearfix');
$classes[] = 'stm_icontext_' . $style;
$classes[] = $uniq;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = 'text-' . $align;

$styles = '.' . $uniq . ' .stm_icontext__icon{';
$styles .= 'font-size:' . $icon_size . 'px;';
$styles .= 'margin-right:' . $icon_margin . 'px;';
if(!empty($icon_color)) {
	$styles .= 'color:' . $icon_color . ';';
}
$styles .= '}';
$styles .= '.' . $uniq . ' .stm_icontext__text span{';
$styles .= 'font-size:' . $font_size . 'px;';
$styles .= 'line-height:' . $line_height . 'px;';
$styles .= '}';
if(!empty($text_color)) {
	$styles .= '.stm_icontext.' . $uniq . ' a {';
	$styles .= 'color: ' . $text_color . ';';
	$styles .= '}';
}
$icon_class = "stm_icontext__icon {$icon} {$icon_class}";
$icon_class = (!empty($icon)) ? $icon_class : '';


pearl_add_element_style('icontext', $style, $styles);
$link = vc_build_link( $link );
if(empty($link['target'])) $link['target'] = '_self';

$tag = array_filter($link);
?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php if(!empty($tag)): ?>
        <a href="<?php echo esc_url($link['url']) ?>"
           class="main_font mtc_h"
           title="<?php echo esc_attr($text) ?>"
           target="<?php echo esc_attr($link['target']) ?>">
            <span class="stm_icontext__text <?php echo esc_attr($font_family . ' ' . $text_class); ?>">
                <i class="<?php echo esc_attr($icon_class); ?>"></i>
                <span><?php echo wp_kses_post($text); ?></span>
            </span>
        </a>
    <?php else: ?>
        <div class="main_font">
            <span class="stm_icontext__text <?php echo esc_attr($font_family . ' '. $text_class); ?>">
                <i class="<?php echo esc_attr($icon_class); ?>"></i>
                <span><?php echo sanitize_text_field($text); ?></span>
            </span>
        </div>
    <?php endif; ?>
</div>