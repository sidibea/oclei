<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_pricing-table');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = (!empty($label_text) ) ? 'has-label' : '';
$classes[] = 'stm_pricing-table_' . $style;

pearl_add_element_style('pricing_table', $style);

$button = vc_build_link( $button );

?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="stm_pricing-table__inner">
        <div class="stm_pricing-table__head">
            <?php if ( $title ) { ?>
                <h5><?php echo sanitize_text_field( $title ); ?></h5>
            <?php } ?>
            <div class="stm_pricing-table__pricing">
                <?php if(!empty($price_prefix)): ?>
                    <span class="stm_pricing-table__prefix"><?php echo sanitize_text_field($price_prefix); ?></span>
                <?php endif; ?>
                <?php if(!empty($price)): ?>
                    <span class="stm_pricing-table__price"><?php echo sanitize_text_field($price); ?></span>
                <?php endif; ?>
                <?php if(!empty($price_separator)): ?>
                    <span class="stm_pricing-table__separator"><?php echo sanitize_text_field($price_separator); ?></span>
                <?php endif; ?>
                <?php if(!empty($price_postfix)): ?>
                    <span class="stm_pricing-table__postfix"><?php echo sanitize_text_field($price_postfix); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="stm_pricing-table__content">
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </div>
        <div class="stm_pricing-table__footer">
            <?php if( $button['url'] != '' ) { ?>
                <a href="<?php echo esc_url( $button['url'] ); ?>"
                   class="btn btn_primary btn_solid"
                   target="<?php echo ( ( $button['target'] == '' ) ? '_self' : $button['target'] ); ?>">
                    <?php echo sanitize_text_field( $button['title'] ); ?>
                </a>
            <?php } ?>
        </div>
        <?php if( in_array('has-label', $classes) ) { ?>
            <span class="stm_pricing-table__label"><?php echo sanitize_text_field( $label_text ); ?></span>
        <?php } ?>
    </div>
</div>