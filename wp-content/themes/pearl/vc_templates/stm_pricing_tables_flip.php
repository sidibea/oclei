<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_pricing-table-flip stm_pricing-table-flip_' . $style . ' stm_flipbox');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = 'stm_pricing-table_' . $style;

pearl_add_element_style('pricing_table_flip', $style);

$button = vc_build_link( $button );

$bg = '';
if(!empty($image)) {
    $bg = pearl_get_image_url($image);
    $bg = "style=\"background-image: url('{$bg}')\"";
}

?>


<div class="<?php echo esc_attr(implode(' ', $classes)); ?> clearfix">
    <div class="stm_flipbox__front" <?php echo sanitize_text_field($bg); ?>>
        <div class="inner">

			<?php if ( $title ) { ?>
                <h5><?php echo sanitize_text_field( $title ); ?></h5>
			<?php } ?>

			<?php if(!empty($price)): ?>
                <h2 class="stm_pricing-table__price"><?php echo sanitize_text_field($price); ?></h2>
			<?php endif; ?>

			<?php if ( $subtitle ) { ?>
                <h5><?php echo sanitize_text_field( $subtitle ); ?></h5>
			<?php } ?>

        </div>
    </div>
    <div class="stm_flipbox__back mbc">
        <div class="inner">
            <?php if(!empty($icon)): ?>
                <i class="stm_back_bg_icon <?php echo esc_attr($icon); ?>"></i>
            <?php endif; ?>
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			<?php if( $button['url'] != '' ) { ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>"
                   class="btn btn_primary btn_outline btn_default btn_white"
                   target="<?php echo ( ( $button['target'] == '' ) ? '_self' : $button['target'] ); ?>">
                    <span><?php echo sanitize_text_field( $button['title'] ); ?></span>
                </a>
			<?php } ?>
        </div>
    </div>
</div>